<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListClientResource extends JsonResource
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
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'othernames' => $this->othernames,
            'sex' => $this->sex,
            'date_registered' => $this->created_at,
        ];
    }
}
