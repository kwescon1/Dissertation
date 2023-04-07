<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'title' => 'nullable',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'othernames' => 'nullable|max:255',
            'date_of_birth' => 'date',
            'sex' => 'required|string|max:1',
            'phone' => 'required|max:20',
            'facility_id' => 'required',
            'facility_branch_id' => 'required',
            'email' => 'nullable|max:255|regex:/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}/',


            'emergency_contact_name' => 'string|required',
            'emergency_contact_phone' => 'max:20|required',


            //residence
            'first_address_line' => 'string|required',
            'second_address_line' => 'string|nullable',
            'third_address_line' => 'string|nullable',
            'town' => 'string|required',
            'county' => 'string|required',
            'postcode' => 'string|required',
        ];
    }
}
