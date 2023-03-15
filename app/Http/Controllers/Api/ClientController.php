<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Exceptions\BadRequestException;
use App\Exceptions\ValidationException;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Auth\Access\AuthorizationException;
use App\Services\Api\Client\ClientServiceInterface;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

class ClientController extends Controller
{

    private $clientService;

    public function __construct(ClientServiceInterface $clientService)
    {
        $this->clientService = $clientService;
        $this->middleware('auth', ['except' => [
            'verifyClientRegistrationLink', 'store'
        ]]);
    }

    public function verifyClientRegistrationLink(Request $request)
    {
        try {
            return response()->success($this->clientService->verifyRegistrationLink($request));
        } catch (InvalidSignatureException $e) {
            return response()->error($e->getMessage(), \Illuminate\Http\Response::HTTP_FORBIDDEN);
        } catch (ValidationException $e) {
            return response()->error($e->getMessage(), \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return response()->error($e->getMessage());
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


        try {
            return response()->success($this->clientService->storeClient($data));
        } catch (NotFoundException $e) {
            return response()->notfound($e->getMessage());
        } catch (BadRequestException $e) {
            return response()->error($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (AuthorizationException $e) {
            return response()->error($e->getMessage(), Response::HTTP_UNAUTHORIZED, 102);
        } catch (Exception $e) {
            Log::error($e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->error($e->getMessage());
        }
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
