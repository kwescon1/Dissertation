<?php

namespace App\Pipes\Role;

use Closure;
use App\Pipes\Pipe;
use App\Models\Role;
use App\Services\Api\CoreService;

class CreateNewRole implements Pipe
{

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe
        $data = $this->filterRoleData($content);

        //TODO try the restore or create method

        // $role =  Role::restoreOrCreate([])
        $role = Role::create($data);

        //assign permissions to role
        $role->syncPermissions($content['permissions']);

        return $next($role);
    }

    private function filterRoleData($content)
    {
        return [
            'name' => $content['name'],
            'description' => $content['description'],
            'facility_branch_id' => $content['facility_branch_id']
        ];
    }
}
