<?php

namespace App\Services\Chatbot;

use Carbon\Carbon;
use App\Models\FacilityBranch;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class InitService extends RegisteredClientInitService
{
    public function onWelcomeMessageProvided($data)
    {
        switch ($data['body']) {
            case '1':

                /**
                 * we assume the current whatsapp number in use belongs to one facility branch. Get that facility branch's id to generate an expiry URL
                 */
                $branch = FacilityBranch::wherePhone($this->getActualWhatsappNumber($data['to']))->first();

                if (!$branch) {
                    $str = "Oops😬! I'm sorry, I am unable to help at this time due to issues beyond my control. Please try again next time😊";

                    //TODO try creating a different log file for this purpose.
                    Log::emergency("Facility Branch with phone number " . $this->getActualWhatsappNumber($data['to']) . " does not exist");

                    $this->sendReply($data['from'], $str);

                    $this->setToDone($data['from']);
                    die;
                }

                $url = URL::temporarySignedRoute(
                    'client.registration.verify',
                    Carbon::now()->addMinutes(20),
                    [
                        'facilityId' => $branch->facility_id,
                        'branchId' => $branch->id,
                        'client' => $this->getActualWhatsappNumber($data['from']),
                        'hash' => sha1(`{$branch->id}{$data['to']}{$data['from']}`), false
                    ]
                );

                $url = str_replace(env('APP_URL') . '/api', env('APP_URL'), $url);

                $str = "Please use the below link🔗 to register®. \n\n‼️The link would be available for 2️⃣0️⃣ minutes.\n\n$url";

                $this->sendReply($data['from'], $str);
                $this->setToDone($data['from']);

                break;

            case '2':

                $about =  $this->aboutUs();

                foreach ($about as $d) {
                    $this->sendReply($data['from'], $d);

                    sleep(2);
                }

                return Constants::ABOUT_US;
                break;

            case '3':
                return Constants::DONE;
                break;

            default:
                //choose from options
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }

    public function onComplianceMessageProvided($data)
    {
        switch ($data['body']) {
            case '1':
                return Constants::INIT;
                break;

            case '2':

                return Constants::DONE;
                break;

            default:
                //choose from options
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }




    //what the chatbot can do
    private function aboutUs()
    {
        return [
            "*How can our chatbot assist you?*\n\nGet medical advice: Our chatbot is programmed to provide you with instant medical advice for your symptoms. Our AI algorithms have been trained on vast medical datasets, enabling them to give accurate medical guidance.",

            "*Book an appointment:*\n\nYou can easily book an appointment with one of our doctors through our chatbot. No more waiting on hold or going through lengthy processes to get an appointment.",

            "*Check your medical reports:*\n\nOur chatbot can retrieve your medical reports from our database and share them with you in real-time. You can also request your reports to be shared with your doctor directly.",

            "*Get reminders and follow-ups:*\n\nOur chatbot can send you reminders for medication, upcoming appointments, and even follow-up appointments. This way, you never have to worry about forgetting any essential healthcare tasks."

        ];
    }
}
