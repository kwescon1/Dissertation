<?php

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenAiPromptToQuestionsTable extends Migration
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
            "question" => "Hi there, I am Clinton, your personal AI assistant. I answer any question asked relating to health issues.\n\nYour session with me would be terminated after 5️⃣ minutes of inactivity⏳.\n\nShould you want to end this chat session, type *end*. How may I help you❓",
            "options" => " ",
            "method" => "onAskQuestionProvided"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('onAskQuestionProvided')->delete();
    }
}
