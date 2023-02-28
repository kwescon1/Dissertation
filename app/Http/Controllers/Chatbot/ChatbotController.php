<?php

namespace App\Http\Controllers\Chatbot;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\Chatbot\AppService;

class ChatbotController extends Controller
{
    //
    private $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    /**
     * @param Request $request
     * 
     * chatbot entry point
     */
    public function onMessageReceived(Request $request)
    {


        Log::info("chatbot request is \n", $request->all());

        return $this->appService->messageReceived($request);
    }

    public function status(Request $request)
    {
        return Log::info($request->all());
    }
}
