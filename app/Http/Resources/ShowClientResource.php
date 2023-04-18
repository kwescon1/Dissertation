<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nhs_number' => $this->nhs_number,
            'title' => $this->title,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'othernames' => $this->othernames,
            'date_of_birth' => $this->date_of_birth,
            'sex' => $this->sex,
            'phone' => $this->phone,
            'email' => $this->email,
            'emergency_contact' => $this->emergencyContact ? $this->emergencyContact->map(function ($contact) {
                return collect(['name' => $contact->emergency_contact_name, 'phone' => $contact->emergency_contact_phone]);
            }) : null,
            'residence' => $this->residence ? $this->residence->map(function ($residence) {
                return collect(['address' => $residence->first_address_line . "\n" . $residence->second_address_line . "\n" . $residence->thrid_address_line . "\n" . $residence->town . "\n" . $residence->county . "\n" . $residence->postcode]);
            }) : null,

            'date_registered' => $this->created_at,
        ];
    }
}
