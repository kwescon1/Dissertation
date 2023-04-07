<?php

namespace App\Pipes\Role;

use Closure;
use App\Pipes\Pipe;
use App\Models\Permission;
use App\Services\Api\CoreService;

class FetchPermissions implements Pipe
{
    private $coreService;

    public function __construct()
    {
        $this->coreService = new CoreService;
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe
        $tempArray = [];
        foreach ($content['permissions'] as $permissionId) {
            $permission = Permission::find($permissionId);

            if (!$permission) {
                $this->coreService->throwNotFoundException('Permission', $permissionId);
            }

            array_push($tempArray, $permission);
        }

        $content['permissions'] = $tempArray;

        return $next($content);
    }
}
