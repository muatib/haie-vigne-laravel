<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Form;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

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
        if (!$form->file_upload) {
            abort(404, 'Fichier non trouvé');
        }

        $fileName = $form->file_name ?? 'document.pdf';
        $fileContent = $form->file_upload;

        return Response::make($fileContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ]);
    }

    public function submitForm(Request $request)
    {
        $currentDate = now();
        $startDate = Carbon::create($currentDate->year, 9, 1);
        $endDate = Carbon::create($currentDate->year, 6, 30);

        if ($currentDate->month >= 7 && $currentDate->month <= 8) {
            return redirect()->back()->with('error', 'Les inscriptions sont fermées en juillet et août.');
        }

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required|unique:forms,phone',
            'file_upload' => 'nullable|file|max:2048',
            'total' => 'required|numeric',
            'courses' => 'required|array|min:1',
            'payment_method' => 'required|in:cheque,virement,carte,paypal',
        ];

        if (!Auth::check()) {
            $rules['email'] .= '|unique:users,email';
            $rules['password'] = 'required|min:8|confirmed';
        }

        $validator = Validator::make($request->all(), $rules, [
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'courses.required' => 'Veuillez sélectionner au moins un cours.',
            'courses.min' => 'Veuillez sélectionner au moins un cours.',
            'payment_method.required' => 'Veuillez sélectionner une méthode de paiement.',
            'payment_method.in' => 'La méthode de paiement sélectionnée n\'est pas valide.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
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

        if (!Auth::check()) {
            // Créer l'utilisateur
            $user = User::create([
                'firstname' => $request->first_name,
                'lastname' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);
        } else {
            $user = Auth::user();
        }

        $formData = $request->except(['_token', 'courses', 'health_questions', 'password', 'password_confirmation']);
        $formData['courses'] = json_encode($request->input('courses', []));
        $formData['total'] = $request->input('total');
        $formData['payment_method'] = $request->input('payment_method');
        $formData['user_id'] = $user->id;

        // Handle health questionnaire responses
        for ($i = 1; $i <= 9; $i++) {
            $questionKey = "question{$i}";
            $formData[$questionKey] = $request->input("health_questions.{$questionKey}")[0] ?? null;
        }

        // Handle file upload (if applicable)
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getRealPath());
            $formData['file_upload'] = $fileContent;
            $formData['file_name'] = $fileName;
        }

        // Create the form record
        Form::create($formData);

        return redirect()->route('payment');
    }



}
