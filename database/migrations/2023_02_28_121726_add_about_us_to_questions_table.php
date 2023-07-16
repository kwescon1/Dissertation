<?php

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAboutUsToQuestionsTable extends Migration
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
            "question" => "*Our AI chatbot is HIPAA-compliant, meaning all your medical data is secure and protected.*\n\n```Experience the convenience of healthcare like never before. Try our AI chatbot today and see the difference for yourself!```",
            "options" => "*1.Back* \n*2.Quit*",
            "method" => "onComplianceMessageProvided"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('onComplianceMessageProvided')->delete();
    }
}
