<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }
    public function deleteSelected(Request $request)
    {
        $selectedForms = $request->input('selected_forms', []);

        if (empty($selectedForms)) {
            return redirect()->back()->with('warning', 'Aucun formulaire n\'a été sélectionné pour la suppression.');
        }

        $deletedCount = Form::whereIn('id', $selectedForms)->delete();

        if ($deletedCount > 0) {
            $message = $deletedCount === 1 ? 'Un formulaire a été supprimé.' : "$deletedCount formulaires ont été supprimés.";
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('warning', 'Aucun formulaire n\'a pu être supprimé.');
        }
    }
    public function downloadFile(Form $form)
    {
        Log::info('Tentative de téléchargement', ['form_id' => $form->id, 'file_upload' => $form->file_upload]);

        if (!$form->file_upload) {
            Log::warning('file_upload est vide', ['form_id' => $form->id]);
            abort(404, 'Formulaire non trouvé');
        }

        // Générez le contenu du fichier basé sur les données du formulaire
        $content = $this->generateFormContent($form);

        $fileName = 'formulaire_' . $form->id . '.txt'; // ou .txt si vous préférez un format texte
        $headers = [
            'Content-type'        => 'text/plain', // ou 'text/plain' pour un fichier texte
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return Response::make($content, 200, $headers);
    }

    private function generateFormContent(Form $form)
    {
        // Ici, générez le contenu du fichier basé sur les données du formulaire
        // Par exemple, pour un fichier texte simple :
        $content = "Formulaire ID: " . $form->id . "\n";
        $content .= "Prénom: " . $form->first_name . "\n";
        $content .= "Nom: " . $form->last_name . "\n";
        $content .= "Email: " . $form->email . "\n";
        // Ajoutez d'autres champs selon votre structure de formulaire

        return $content;
    }
    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:forms,email',
            'address' => 'required',
            'phone' => 'required|unique:forms,phone',
            'file_upload' => 'nullable|file|max:2048',
            'total' => 'required|numeric',
            'courses' => 'required|array|min:1',
            'payment_method' => 'required|in:cheque,virement,carte,paypal',
        ], [
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'courses.required' => 'Veuillez sélectionner au moins un cours.',
            'courses.min' => 'Veuillez sélectionner au moins un cours.',
            'payment_method.required' => 'Veuillez sélectionner une méthode de paiement.',
            'payment_method.in' => 'La méthode de paiement sélectionnée n\'est pas valide.',
        ]);

        $validator->after(function ($validator) use ($request) {
            $allQuestionsAnswered = true;
            for ($i = 1; $i <= 9; $i++) {
                $questionKey = "question{$i}";
                if (!$request->has("health_questions.{$questionKey}") || count($request->input("health_questions.{$questionKey}")) != 1) {
                    $allQuestionsAnswered = false;
                    break;
                }
            }
            if (!$allQuestionsAnswered) {
                $validator->errors()->add('health_questions', 'Veuillez répondre à toutes les questions de santé.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $formData = $request->except(['_token', 'courses', 'health_questions']);
        $formData['courses'] = json_encode($request->input('courses', []));
        $formData['total'] = $request->input('total');
        $formData['payment_method'] = $request->input('payment_method');

        $formData['user_id'] = Auth::id();

        // Handle health questionnaire responses
        for ($i = 1; $i <= 9; $i++) {
            $questionKey = "question{$i}";
            $formData[$questionKey] = $request->input("health_questions.{$questionKey}")[0] ?? null;
        }

        // Handle file upload (if applicable)
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);
            $formData['file_upload'] = $filename;
        }

        // Create the form record
        Form::create($formData);

        return redirect()->route('payment');
    }
 }
