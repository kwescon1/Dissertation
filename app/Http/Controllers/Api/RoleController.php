<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListRoleResource;
use App\Services\Api\Role\RoleServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;

class RoleController extends Controller
{

    private $roleService;

    public function __construct(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authUser = cache()->get(auth()->id());
        try {
            return response()->success(ListRoleResource::collection($this->roleService->listRoles($authUser['facility_branch_id'])));
        } catch (AuthorizationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_FORBIDDEN);
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
