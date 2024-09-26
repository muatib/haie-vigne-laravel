<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Storage;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:forms,email',
            'address' => 'required',
            'phone' => 'required|unique:forms,phone',
            'file_upload' => 'nullable|file|max:2048',
            'total' => 'required|numeric',
        ], [
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
        ]);

        $formData = $request->except(['_token', 'courses']);
        $formData['courses'] = json_encode($request->input('courses', []));
        $formData['total'] = $request->input('total');


        // Handle health questionnaire responses
        for ($i = 1; $i <= 9; $i++) {
            $questionKey = "question{$i}";
            $formData[$questionKey] = $request->has($questionKey) ? $request->input($questionKey)[0] : null;
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
