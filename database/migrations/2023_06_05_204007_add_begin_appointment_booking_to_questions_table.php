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
            "question" => "Please select appointment type",
            "options" => "*1.Review⏳* \n*2.Change of Spectacles👓* \n*3.⬅️Back* \n*4.Quit❌*",
            "method" => "selectAppointmentType"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('selectAppointmentType')->delete();
    }
};
