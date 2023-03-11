<?php

namespace App\Pipes\Client;

use Closure;
use App\Pipes\Pipe;

class RemoveEmergencyContact implements Pipe
{
    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe
        $content = $this->unsetContactData($content);

        return $next($content);
    }


    private function unsetContactData($content)
    {
        $data = [
            'emergency_contact_name', 'emergency_contact_phone',
        ];

        foreach ($data as $d) {
            if (isset($content[$d])) {
                unset($content[$d]);
            }
        }

        return $content;
    }
}
