<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_branches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('facility_id')->constrained('facilities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('code', 2);
            $table->tinyInteger('is_head_branch')->default(0);
            $table->string('email')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->tinyInteger('status');
            $table->string('address');
            $table->string('country');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_branches');
    }
}
