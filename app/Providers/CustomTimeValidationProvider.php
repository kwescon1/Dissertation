<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class CustomTimeValidationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return Validator::extend('appointment_time', function ($attributes, $value) {
            // Convert the input value to a DateTime object
            $appointmentTime = \DateTime::createFromFormat('H:i a', $value);

            // Check if the value is a valid time
            if (!$appointmentTime instanceof \DateTime) {
                return false;
            }

            // Set the minimum and maximum allowed appointment times
            $minTime = \DateTime::createFromFormat('H:i a', '8:00 am');
            $maxTime = \DateTime::createFromFormat('H:i a', '8:30 pm');

            // Check if the appointment time is within the valid range
            if ($appointmentTime < $minTime || $appointmentTime > $maxTime) {
                return false;
            }

            // Check if the appointment time is in 15-minute intervals
            $minute = intval($appointmentTime->format('i'));
            if ($minute % 15 !== 0) {
                return false;
            }

            return true;
        }, 'Invalid :attribute. Please select a valid time within the allowed range(*8:00am to 8:30pm*) and in 15-minute intervals.');
    }
}
