<?php

namespace App\Services\Chatbot\Appointment;

use App\Services\Chatbot\Constants;

class InitAppointmentService extends BookAppointmentService
{
    public function initAppointmentQuestion(array $data)
    {
        switch ($data['body']) {
            case '1':

                return $this->saveAnswer($data, Constants::APPOINTMENT_TYPE); // booking appointment
                break;

            case '2':

                return $this->saveAnswer($data, Constants::PREVIOUS_APPOINTMENT); //previous appointment
                break;

            case '3':

                return $this->saveAnswer($data, Constants::FUTURE_APPOINTMENT); //future appointments

                break;

            case '4':
                return $this->saveAnswer($data, Constants::REGISTERED_USER_START_QUESTION_ID); //back to main menu
                break;

            case '5':
                return $this->saveAnswer($data, Constants::DONE); // Quit
                break;

            default:
                //choose from options
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }
}
