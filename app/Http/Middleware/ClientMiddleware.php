<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\Api\Constants\Permissions;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $permissions = [Permissions::EDIT_CLIENT, Permissions::VIEW_CLIENT, Permissions::DELETE_CLIENT];

        $user = auth()->user()->loggedInBranch;

        if ($user->roles[0]->hasAnyDirectPermission($permissions)) {
            return $next($request);
        } else {
            return response()->error("Unauthorized Access", Response::HTTP_FORBIDDEN);
        }
    }
}
