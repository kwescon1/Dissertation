<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'username' => 'required|max:255|regex:/^[0-9a-zA-Z._]+$/',
            'password' => 'required|min:6',
            'facility_branch_id' => 'nullable', // add this field to the login form when necessary
        ];
    }
}
