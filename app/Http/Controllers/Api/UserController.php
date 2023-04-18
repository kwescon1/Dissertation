<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\ListUserResource;
use App\Http\Resources\ShowUserResource;
use App\Http\Resources\SaveModelResource;
use App\Services\Api\User\UserServiceInterface;

class UserController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
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

        return response()->success(ListUserResource::collection($this->userService->users($authUser['facility_id'], $authUser['facility_branch_id'])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
        $data = $request->validated();

        return response()->created(new SaveModelResource($this->userService->createUser($data)));
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
        $authUser = cache()->get(auth()->id());

        return response()->success(new ShowUserResource($this->userService->user($id, $authUser['facility_id'], $authUser['facility_branch_id'])));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //
        $data = $request->validated();
        $authUser = cache()->get(auth()->id());

        return response()->success(new SaveModelResource($this->userService->updateUser($data, $id, $authUser['facility_id'], $authUser['facility_branch_id'])));
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

        return response()->success($this->userService->destroyUser($id, $authUser['facility_id']));
    }
}
