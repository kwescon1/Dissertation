<?php

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWelcomeQuestionToQuestionsTable extends Migration
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
            "question" => "Welcome to the Future of Healthcare\n\nOur AI chatbot is revolutionizing the way we provide healthcare services. With our state-of-the-art technology, you can receive personalized, fast, and accurate medical assistance anytime, anywhere. \n\nSelect *Option 2* to know more about the provided services\n\n\nType *start again* or *startagain* to begin a new session by cancelling current session",
            "media" => "welcome.jpg",
            "options" => "*1.Register* \n*2.Services Provided* \n*3.Quit*",
            "method" => "ON_WELCOME_MESSAGE_PROVIDED"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            //
        });
    }
}
