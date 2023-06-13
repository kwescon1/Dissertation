<?php

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        DB::table('questions')->insert([
            "question" => "Would you🧍 like to provide any additional details for your appointment booking❓",
            "options" => "*1.Yes👍* \n*2.No👎* \n*3.⬅️Back*",
            "method" => "appoitnmentDetailAsk"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('appoitnmentDetailAsk')->delete();
    }
};
