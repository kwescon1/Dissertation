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
            "question" => "Please type in your preferred appointment date. \n\nDate must be in the format - *(YYYY-MM-DD)*\n\n*NB: Maximun date can be 3 months from today - Minimum appointment date can be tomorrow*",
            "options" => "",
            "method" => "selectAppointmentDate"
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Question::whereMethod('selectAppointmentDate')->delete();
    }
};
