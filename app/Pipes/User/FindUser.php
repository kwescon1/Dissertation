<?php

namespace App\Pipes\User;

use Closure;
use App\Pipes\Pipe;
use App\Models\User;
use App\Services\Api\CoreService;
use App\Services\Api\User\UserServiceInterface;

class FindUser implements Pipe
{

    private $coreService, $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->coreService = new CoreService;
        $this->userService = $userService;
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe

        $user = User::whereId($content['id'])->whereFacilityId($content['facility_id'])->first();

        if (!$user) {
            $this->coreService->throwNotFoundException('User', $content['id']);
        }

        $content['user'] = $user;

        return $next($content);
    }
}
