<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        $rules= [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telegram' => 'nullable|string|max:255',
            'viber' => 'nullable|string|max:255',
            'fb_profile_link' => 'nullable|string|max:255',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            // $user = $this->route()->parameter('user');
            $rules['email'] = ['required', 'email', 'lowercase', 'max:255', Rule::unique('users', 'email')->ignore($this->route('user'))];
            $rules['password'] = ['nullable', 'confirmed', Password::default()];
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'dob' => Carbon::parse($this->dob)->format('Y-m-d'),
        ]);
    }
}
