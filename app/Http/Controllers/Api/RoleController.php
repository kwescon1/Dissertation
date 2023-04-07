<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Exceptions\NotFoundException;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ValidationException;
use App\Http\Resources\ListRoleResource;
use App\Http\Resources\SaveModelResource;
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
    public function store(RoleRequest $request)
    {
        //
        $authUser = cache()->get(auth()->id());
        $data = $request->validated();
        try {
            return response()->created(new SaveModelResource($this->roleService->createRole($data, $authUser['facility_branch_id'])));
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (ValidationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (AuthorizationException | ForbiddenException $e) {
            return response()->error($e->getMessage());
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
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

        try {
            return response()->success(new RoleResource($this->roleService->role($id, $authUser['facility_branch_id'])));
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (AuthorizationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_FORBIDDEN);
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
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

        try {
            return response()->success(new SaveModelResource($this->roleService->updateRole($data, $id, $authUser['facility_branch_id'])));
        } catch (ValidationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (AuthorizationException $e) {
            return response()->error($e->getMessage());
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage(), 500);
        }
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
        try {
            return response()->success($this->roleService->destroyRole($id, $authUser['facility_branch_id']));
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (ForbiddenException | AuthorizationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_FORBIDDEN);
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
    }
}
