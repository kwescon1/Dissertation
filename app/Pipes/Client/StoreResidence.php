<?php

namespace App\Pipes\Client;

use App\Models\Residence;
use Closure;
use App\Pipes\Pipe;

class StoreResidence implements Pipe
{
    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe


        $residence = Residence::create($this->residenceData($content));


        $content['residential_address_id'] = $residence->id;

        return $next($content);
    }


    private function residenceData($content)
    {
        return [
            'first_address_line' => $content['first_address_line'],
            'second_address_line' => isset($content['second_address_line']) ? $content['second_address_line'] : NULL,
            'third_address_line' => isset($content['third_address_line']) ? $content['third_address_line'] : NULL,
            'town' => $content['town'],
            'county' => $content['county'],
            'postcode' => $content['postcode']
        ];
    }
}
