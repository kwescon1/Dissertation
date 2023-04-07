<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('facility_id')->constrained('facilities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nhs_number', 15);
            $table->index('nhs_number');
            $table->string('title', 5)->nullable();
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('othernames', 50)->nullable();
            $table->date('date_of_birth');
            $table->char('sex', 1);
            $table->string('phone', 15)->unique();
            $table->string('email')->nullable();
            $table->uuid('residential_address_id');
            $table->uuid('emergency_contact_id');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['facility_id', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
