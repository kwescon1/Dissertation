<?php

namespace App\Pipes\Client;

use Closure;
use App\Pipes\Pipe;

class RemoveResidence implements Pipe
{
    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe
        $content = $this->unsetResidenceData($content);

        return $next($content);
    }


    private function unsetResidenceData($content)
    {
        $data = [
            'first_address_line', 'second_address_line', 'third_address_line',
            'town', 'county', 'postcode'
        ];

        foreach ($data as $d) {
            if (isset($content[$d])) {
                unset($content[$d]);
            }
        }

        return $content;
    }
}
