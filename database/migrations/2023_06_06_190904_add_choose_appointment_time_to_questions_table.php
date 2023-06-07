<?php

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('questions')->insert([
            "question" => "Please type in your preferred appointment time. \n\nTime must be in the 12-hour format - *(eg: 12:15pm)* and must be 15 mins interval apart\n\n*NB: Maximun time for appointment booking is 08:30pm - Minimum time is 08:00am*",
            "options" => "",
            "method" => "selectAppointmentTime"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('selectAppointmentTime')->delete();
    }
};
