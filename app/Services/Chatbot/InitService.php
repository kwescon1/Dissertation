<?php

namespace App\Services\Chatbot;

use Carbon\Carbon;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\URL;

class InitService extends CoreService
{
    public function ON_WELCOME_MESSAGE_PROVIDED($data)
    { //TODO check if its possible to get the whatsapp number that is sending the response and use to get the facility branch... if its not there add it to the parameters inside data

        switch ($data['body']) {
            case '1':

                //generate expiry URL

                /**
                 * we assume the current whatsapp number in use belongs to one facility branch. Get that facility branch's id
                 */

                // $url = URL::temporarySignedRoute(
                //     'client/new/register',
                //     Carbon::now()->addMinutes(10),['branch' => $branchId]),
                //     [
                //         'id' => $notifiable->getKey(),
                //         'hash' => sha1($notifiable->getEmailForVerification()), false
                //     ]
                // );

                // str_replace(env('API_URL'), env('FRONT_URL'), $url);

                // $this->sendReply();

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

    public function ON_COMPLIANCE_MESSAGE_PROVIDED($data)
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
