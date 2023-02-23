<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Twilio Account SID
    |--------------------------------------------------------------------------
    |
    | This value is the security identifier of the twilio account
    |
    */

    'twilio_sid' => env('TWILIO_ACC_SID', ''),

    /*
    |--------------------------------------------------------------------------
    | Twilio Account SID
    |--------------------------------------------------------------------------
    |
    | This value is the authentication token of the twilio account
    |
    */

    'twilio_auth_token' => env('TWILIO_ACC_AUTH_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Twilio Account SID
    |--------------------------------------------------------------------------
    |
    | This value is the twilio whatsapp number. The system can be assessed through this number on whatsapp.
    |
    */

    'twilio_number' => env('TWILIO_NUMBER', ''),

];
