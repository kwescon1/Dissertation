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
            'id' => $this->id,
            'nhs_number' => $this->nhs_number,
            'title' => $this->title,
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'othernames' => $this->othernames,
            'date_of_birth' => $this->date_of_birth,
            'sex' => $this->sex,
            'phone' => $this->phone,
            'email' => $this->email,
            'emergency_contact' => $this->emergencyContact,
            'residence' => $this->residence,
            'date_registered' => $this->created_at,
        ];
    }
}
