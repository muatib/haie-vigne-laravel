<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FormSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:forms,phone',
            'file_upload' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'total' => 'required|numeric',
            'courses' => 'required|array|min:1',
            'payment_method' => 'required|in:cheque,virement,carte,paypal',
        ];

        if (!Auth::check()) {
            $rules['email'] .= '|unique:users,email';
            $rules['password'] = 'required|min:8|confirmed';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email address is already in use.',
            'phone.unique' => 'This phone number is already in use.',
            'courses.required' => 'Please select at least one course.',
            'courses.min' => 'Please select at least one course.',
            'payment_method.required' => 'Please select a payment method.',
            'payment_method.in' => 'The selected payment method is invalid.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $allQuestionsAnswered = true;
            for ($i = 1; $i <= 9; $i++) {
                $questionKey = "question{$i}";
                if (!$this->has("health_questions.{$questionKey}") || count($this->input("health_questions.{$questionKey}")) != 1) {
                    $allQuestionsAnswered = false;
                    break;
                }
            }
            if (!$allQuestionsAnswered) {
                $validator->errors()->add('health_questions', 'Please answer all health questions.');
            }
        });
    }
}
