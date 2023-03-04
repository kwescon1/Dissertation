<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFacilityBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_facility_branches', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('facility_id')->constrained('facilities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('facility_branch_id')->constrained('facility_branches')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('current_login_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
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
        Schema::dropIfExists('user_facility_branches');
    }
}
