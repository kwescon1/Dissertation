<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ListClientResource;
use App\Http\Resources\ShowClientResource;
use App\Http\Resources\StoreClientResource;
use App\Services\Api\Client\ClientServiceInterface;

class ClientController extends Controller
{

    private $clientService;

    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;

        $this->middleware(['auth:sanctum', 'client'])->except(['verifyClientRegistrationLink', 'store']);
    }

    public function verifyClientRegistrationLink(Request $request)
    {
        return response()->success($this->clientService->verifyRegistrationLink($request));
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

        return response()->success(ListClientResource::collection($this->clientService->clients($authUser['facility_id'], $authUser['facility_branch_id'])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        //
        $data = $request->validated();

        return response()->success(new StoreClientResource($this->clientService->storeClient($data)));
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

        return response()->success(new ShowClientResource($this->clientService->client($id, $authUser['facility_id'], $authUser['facility_branch_id'])));
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
        $authUser = cache()->get(auth()->id());

        return response()->success($this->clientService->destroyClient($id, $authUser['facility_id'], $authUser['facility_branch_id']));
    }
}
