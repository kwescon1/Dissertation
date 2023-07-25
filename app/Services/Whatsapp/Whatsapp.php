<?php

namespace  App\Services\Whatsapp;

use Twilio\Rest\Client as CLi;
use Illuminate\Support\Facades\Log;

class Whatsapp
{

    protected $twilio;

    public function __construct(protected string $accountSID, protected string $authToken, protected string $twilioNumber)
    {
        $this->twilio = $this->configureTwilio();
    }

    /**
     * 
     * configure twilio messaging
     */
    private function configureTwilio(): CLi
    {
        return new CLi($this->accountSID, $this->authToken);
    }



    /**
     * @param string $from
     * @param string $message
     * @param string $media
     * 
     * send message replies
     */

    public function messageClient(string $from, string $message, string $media = NULL)
    {
        logger("chatbot message body is\n $message \nand media is $media\n");

        $twilio_number = config('twilio.twilio_number');

        $twilio = $this->configureTwilio();

        return  $this->twilio->messages->create($from, $this->checkMedia($message, $twilio_number, $media));
    }

    /**
     * @param string $message
     * @param string $number
     * @param $media
     * 
     * @return array
     * 
     * adds media to returned array if media exists
     */
    private function checkMedia(string $message, string $number, $media = NULL): array
    {
        return !isset($media) ? $this->hasNoImage($message, $number)
            : $this->hasImage($message, $number, $media);
    }


    private function hasImage(string $message, string $number, $media)
    {
        //verify image
        $isImage = $this->verifyIsImage($media);

        return $isImage ? array(
            "body" => $message,
            "from" => $number,
            "MediaUrl" =>  asset("media/$media"),
            "statusCallback" => url("/api/status")
        ) : $this->hasNoImage($message, $number);
    }

    private function hasNoImage(string $message, string $number)
    {
        return array(
            "body" => $message,
            "from" => $number,
            "statusCallback" => url("/api/status")
        );
    }

    private function verifyIsImage($media): bool
    {
        $image = asset("storage/media/$media");

        return rescue(function () use ($image) {
            // Read the contents of the file into a string
            $file_contents = file_get_contents($image);

            // Get the image size from the string
            $image_size = getimagesizefromstring($file_contents);

            // Check if the image size was successfully retrieved and the file is an image
            return $image_size !== false && strpos($image_size['mime'], 'image') === 0 ? true : false;
        }, function ($e) {
            Log::error($e->getMessage());
            Log::info("Failed to read file");
            return false;
        }, false);
    }
}
