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
            "question" => "Welcome to our Help Desk. How may we help you❓",
            "media" => "helpdesk.jpg",
            "options" => "*1.General eye health question👁️‍🗨️* \n*2.FAQs⁉️*\n*3.⬅️Back* \n*4.Quit❌*",
            "method" => "initHelpQuestion"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('initHelpQuestion')->delete();
    }
};
