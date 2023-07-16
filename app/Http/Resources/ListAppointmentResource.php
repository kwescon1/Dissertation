<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListAppointmentResource extends JsonResource
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
            'appointment_type' => $this->type->resolveDisplayableValue(),
            'appointment_time' => $this->scheduled_at->format('h:ia'),
            'appointment_status' => $this->status->resolveDisplayableValue(),
            'client' => $this->whenLoaded('client')
        ];
    }
}
