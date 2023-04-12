<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ListRoleResource;
use App\Http\Resources\SaveModelResource;
use App\Services\Api\Role\RoleServiceInterface;

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

        return response()->success(ListRoleResource::collection($this->roleService->listRoles($authUser['facility_branch_id'])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        //
        $authUser = cache()->get(auth()->id());
        $data = $request->validated();

        return response()->created(new SaveModelResource($this->roleService->createRole($data, $authUser['facility_branch_id'])));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $authUser = cache()->get(auth()->id());

        return response()->success(new RoleResource($this->roleService->role($id, $authUser['facility_branch_id'])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        //
        $data = $request->validated();
        $authUser = cache()->get(auth()->id());

        return response()->success(new SaveModelResource($this->roleService->updateRole($data, $id, $authUser['facility_branch_id'])));
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
        $authUser = cache()->get(auth()->id());

        return response()->success($this->roleService->destroyRole($id, $authUser['facility_branch_id']));
    }
}
