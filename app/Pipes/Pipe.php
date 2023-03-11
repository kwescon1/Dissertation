<?php

namespace App\Pipes;

use Closure;

interface Pipe
{

    const CACHE_KEY_UNIQUE_CLIENT_NUMBER = 'UniqueClientNum::';
    const CACHE_SECONDS = 300;

    public function handle($content, Closure $next);
}
