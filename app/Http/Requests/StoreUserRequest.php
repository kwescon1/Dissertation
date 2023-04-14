<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'facility_id' => 'required|string',
            'facility_branch_id' => 'required|string',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|max:16',
            'email' => 'nullable|max:255|regex:/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}/',
            'username' => 'required|max:255|regex:/^[0-9a-z._]+$/',
            'password' => 'required|min:6',
            'position' => 'nullable|string',
            'role' => 'required|string'
        ];
    }
    //find all users is working
    public function messages(): array
    {
        return [
            'facility_id.required' => ' is required',
            'firstname.required' => 'Provide user first name',
            'lastname.required' => 'Provide user last name',
            'phone.required' => 'Provide user phone number',
            'email.regex' => 'Provide a valid email address for user',
            'phone.max' => 'Provide only one valid phone number for user',
            'username.required' => 'Provide a valid username for user',
            'username.regex' => "Provide a valid username for user: only lowercase letters, numbers period can underscore can be used",
            'password.required' => 'Generate a one time password for user',
            'passsword.min' => 'user password should be at least 6 characters',
        ];
    }
}
