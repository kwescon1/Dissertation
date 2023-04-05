<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'permissions' => $this->permissions->map(function ($permission) {
                return $permission->only(['label']);
            }),
            'users' => $this->users->map(function ($user) {
                return collect(['id' => $user->user->id, 'firstname' => $user->user->firstname, 'lastname' => $user->user->lastname, 'status' => $user->user->status, 'email' => $user->user->email, 'position' => $user->user->position]);
            })
        ];
    }
}
