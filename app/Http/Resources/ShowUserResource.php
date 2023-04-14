<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowUserResource extends JsonResource
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

        $last_login_at = $this->userAccounts ? $this->userAccounts[0]->last_login_at : NULL;

        return [
            'id' => (string)$this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'status' => $this->status,
            'role' => $role,
            'phone' => $this->phone,
            'email' => $this->email,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'last_login' => $last_login_at
        ];
    }
}
