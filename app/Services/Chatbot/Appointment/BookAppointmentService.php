<?php

namespace App\Services\Chatbot\Appointment;

use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\DTOs\AppointmentDTO;
use App\Services\Chatbot\Constants;
use Illuminate\Support\Facades\Log;
use App\Models\Enums\AppointmentType;
use App\Services\Chatbot\CoreService;
use App\Models\Enums\AppointmentStatus;
use Illuminate\Support\Facades\Validator;


class BookAppointmentService extends CoreService
{
    private $clientNumber;
    private $branchNumber;

    public function selectAppointmentType(array $data)
    {
        switch ($data['body']) {
            case '1':

                return $this->saveAnswer($data, Constants::APPOINTMENT_DATE); //
                break;

            case '2':

                return $this->saveAnswer($data, Constants::APPOINTMENT_DATE); //
                break;

            case '3':

                return $this->saveAnswer($data, Constants::APPOINTMENTS);

                break;

            case '4':
                return $this->saveAnswer($data, Constants::DONE);
                break;

            default:
                //choose from options
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }

    public function selectAppointmentDate($data)
    {
        $endDate = Carbon::now()->addMonths(3)->format('Y-m-d');

        $attributes = [
            'body' => 'appointment date'
        ];

        $validator = Validator::make($data, [
            'body' => 'date_format:Y-m-d|after:today|before_or_equal:' . $endDate
        ], [], $attributes);


        if (!$validator->fails()) {
            return $this->saveAnswer($data, Constants::APPOINTMENT_TIME);
        }

        collect($validator->errors()->get('body'))->each(function ($msg) use ($data) {
            $this->sendReply($data['from'], $msg);
        });
    }

    public function selectAppointmentTime($data)
    {
        $attributes = [
            'body' => 'appointment time'
        ];

        $validator = Validator::make($data, [
            'body' => 'appointment_time'
        ], [], $attributes);

        if (!$validator->fails()) {
            return $this->saveAnswer($data, Constants::APPOINTMENT_DETAIL_ASK);
        }

        collect($validator->errors()->get('body'))->each(function ($msg) use ($data) {
            $this->sendReply($data['from'], $msg);
        });
    }

    public function appoitnmentDetailAsk($data)
    {

        switch ($data['body']) {
            case '1':
                // yes
                return $this->saveAnswer($data, Constants::APPOINTMENT_NOTE);
                break;

            case '2':
                //grab user appointment data and save
                $client = $this->clientDetails($this->getActualWhatsappNumber($data['to']), $this->getActualWhatsappNumber($data['from']));

                $appointmentDTO = $this->prepData(Null, $data['mediaUrl'], $data['from'], $client);

                $appointment = Appointment::create($appointmentDTO->toArray());

                $this->successfulBookingDetails($appointment, $data['from']);

                return $this->saveAnswer($data, Constants::APPOINTMENT_BOOKING_DONE);
                break;

            case '3':
                // back
                return $this->saveAnswer($data, Constants::APPOINTMENT_TIME);

                break;

            default:
                // default option
                return Constants::CHOOSE_FROM_AVAILABLE_OPTIONS;
                break;
        }
    }

    public function additionalAppointmentNote($data)
    {

        $client = $this->clientDetails($this->getActualWhatsappNumber($data['to']), $this->getActualWhatsappNumber($data['from']));

        $appointmentDTO = $this->prepData($data['body'], $data['mediaUrl'], $data['from'], $client);

        $appointment = Appointment::create($appointmentDTO->toArray());

        $this->successfulBookingDetails($appointment, $data['from']);

        return $this->saveAnswer($data, Constants::APPOINTMENT_BOOKING_DONE);
    }


    private function prepData($appointmentNote = NULL, $media = NULL, $from, $client)
    {
        $appointmentType = $this->grabAnswerByQuestionId(Constants::APPOINTMENT_TYPE, $from);

        $appointmentDateTime = Carbon::createFromFormat('Y-m-d h:ia', $this->grabAnswerByQuestionId(Constants::APPOINTMENT_DATE, $from) . ' ' . $this->grabAnswerByQuestionId(Constants::APPOINTMENT_TIME, $from));

        return new AppointmentDTO($client->clientAccount->facility_branch_id, $client->id, $appointmentDateTime, $media, $appointmentNote, $appointmentType, AppointmentStatus::SCHEDULED);
    }

    private function clientDetails($branchNumber, $clientNumber)
    {
        return $this->getClient($branchNumber, $clientNumber);
    }

    private function successfulBookingDetails(Appointment $appointment, $from)
    {

        return $this->sendReply($from, $appointment->getAppointmentDetails());
    }
}
