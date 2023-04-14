<?php

namespace App\Pipes\Role;

use Closure;
use App\Pipes\Pipe;
use App\Models\Role;
use App\Services\Api\CoreService;
use Illuminate\Support\Facades\Gate;

class UpdateRole implements Pipe
{
    private $coreService, $update;

    public function __construct()
    {
        $this->coreService = new CoreService;
        $this->update = 'update';
    }

    public function handle($content, Closure $next)
    {
        // Here you perform the task and return the updated $content
        // to the next pipe

        Gate::authorize($this->update, $content['role']);

        $data = $this->filterRoleData($content);

        $role = $content['role'];

        $role->update($data);

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
