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
            "question" => "Welcome to our 👁️ Eye Health Appointment Section! With our user-friendly application, you can easily schedule and manage your eye care appointments🔖.\n\nFrom comprehensive eye🧿 exams to specialized treatments, our app provides a seamless experience for booking and tracking your eye health appointments.\n\nTake control of your visual well-being and ensure your eye👀 receive the attention they deserve. Say goodbye to long wait times and hello to convenient and efficient eye care. \n\nSchedule your appointment today and prioritize the health of your precious 👀.",
            "media" => "eye.jpg",
            "options" => "*1.Book Appointment🔖* \n*2.Previous Appointments⬅🔖* \n*3.Future Appointments➡️🔖* \n*4.⬅️Back* \n*5.Quit❌*",
            "method" => "initAppointmentQuestion"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('initAppointmentQuestion')->delete();
    }
};
