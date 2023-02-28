<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('facility_id')->constrained('facilities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone', 15);
            $table->string('email')->nullable();
            $table->string('username');
            $table->string('password');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['facility_id', 'firstname', 'lastname']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
