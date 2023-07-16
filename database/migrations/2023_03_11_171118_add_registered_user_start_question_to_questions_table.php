<?php

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegisteredUserStartQuestionToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });

        DB::table('questions')->insert([
            "question" => "Welcome \$name 😊,\n\nHow may we be of assitance to you today❓\n\nType *restart* to begin a new session by cancelling current session",
            "media" => "welcome.jpg",
            "options" => "*1.Appointments📕🕰️* \n*2.Medical Records🏥📕* \n*3.❓Help* \n*4.Quit❌*",
            "method" => "registeredClientStartQuestion"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('registeredClientStartQuestion')->delete();
    }
}
