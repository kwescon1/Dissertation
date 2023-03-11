<?php

namespace App\Pipes\Client;

use App\Models\EmergencyContact;
use Closure;
use App\Pipes\Pipe;

class StoreEmergencyContact implements Pipe
{
    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe


        $contact = EmergencyContact::create($this->contactData($content));


        $content['emergency_contact_id'] = $contact->id;

        return $next($content);
    }


    private function contactData($content)
    {
        return [
            'emergency_contact_name' => $content['emergency_contact_name'],
            'emergency_contact_phone' => $content['emergency_contact_phone'],
        ];
    }
}
