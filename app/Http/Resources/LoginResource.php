<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'facility_id' => $this->facility_id,
            'facility_name' => $this->facility_name,
            'facility_branch_id' => $this->facility_branch_id,
            'facility_branch_name' => strtoupper($this->facility_branch_name),
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'status' => $this->status,
            'position' => $this->position,
            'token' => $this->token
        ];
    }
}
