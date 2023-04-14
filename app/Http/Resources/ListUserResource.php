<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public function toArray($request)
    {

        $role = $this->userAccounts->flatMap(function ($userAccount) {
            return count($userAccount->roles) > 0 ? $userAccount->roles->first()->only(['id', 'name']) : NULL;
        });

        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'status' => $this->status,
            'role' => $role,
        ];
    }
}
