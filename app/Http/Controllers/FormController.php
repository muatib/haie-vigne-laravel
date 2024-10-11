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

/**
 * Controller for handling form-related operations.
 */
class FormController extends Controller
{
    /**
     * Display the form view.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('form');
    }

    /**
     * Delete selected forms.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSelected(Request $request)
    {
        $selectedForms = $request->input('selected_forms', []);

        if (empty($selectedForms)) {
            return redirect()->back()->with('warning', 'No forms were selected for deletion.');
        }

        $deletedCount = Form::whereIn('id', $selectedForms)->delete();

        if ($deletedCount > 0) {
            $message = $deletedCount === 1 ? 'One form has been deleted.' : "$deletedCount forms have been deleted.";
            return redirect()->back()->with('success', $message);
        } else {
            return redirect()->back()->with('warning', 'No forms could be deleted.');
        }
    }

    /**
     * Download a file associated with a form.
     *
     * @param Form $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function downloadFile(Form $form)
    {
        if (!$form->file_upload) {
            abort(404, 'File not found');
        }

        $fileName = $form->file_name ?? 'document.pdf';
        $fileContent = $form->file_upload;

        return Response::make($fileContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ]);
    }

    /**
     * Handle form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForm(Request $request)
    {
        $currentDate = now();
        $startDate = Carbon::create($currentDate->year, 9, 1);
        $endDate = Carbon::create($currentDate->year, 6, 30);

        if ($currentDate->month >= 7 && $currentDate->month <= 8) {
            return redirect()->back()->with('error', 'Registration is closed in July and August.');
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
            'email.unique' => 'This email address is already in use.',
            'phone.unique' => 'This phone number is already in use.',
            'courses.required' => 'Please select at least one course.',
            'courses.min' => 'Please select at least one course.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'The selected payment method is invalid.',
            'password.confirmed' => 'The password confirmation does not match.',
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
                $validator->errors()->add('health_questions', 'Please answer all health questions.');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if (!Auth::check()) {
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

            return redirect()->route('payment')->with('success', 'Form submitted successfully. Proceeding to payment.');
        } catch (\Exception $e) {
            Log::error('Error submitting form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while submitting the form. Please try again.');
        }
    }
}
