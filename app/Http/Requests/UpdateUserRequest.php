<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'firstname' => 'sometimes|max:255',
            'lastname' => 'sometimes|max:255',
            'phone' => 'sometimes',
            'status' => 'sometimes',
            'email' => 'sometimes|max:255|regex:/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}/',
            'position' => 'nullable|string',
            'role' => 'required|string'
        ];
    }
}
