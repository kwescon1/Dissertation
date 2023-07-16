<?php

namespace App\Services\Chatbot\Appointment;

use App\Services\Chatbot\Constants;

class InitAppointmentService extends BookAppointmentService
{
    public function initAppointmentQuestion(array $data)
    {
        return match ($data['body']) {
            '1' => $response = $this->saveAnswer($data, Constants::APPOINTMENT_TYPE),
            '2' => $response = $this->saveAnswer($data, Constants::PREVIOUS_APPOINTMENT), //previous appointment,
            '3' => $response = $this->saveAnswer($data, Constants::FUTURE_APPOINTMENT), //future appointments,
            '4' => $this->saveAnswer($data, Constants::REGISTERED_USER_START_QUESTION_ID), //back to main menu

            default => Constants::CHOOSE_FROM_AVAILABLE_OPTIONS,
        };
    }
}
