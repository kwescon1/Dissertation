<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('facility_branch_id')->unsigned()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignUuid('client_id')->unsigned()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('scheduled_at');
            $table->text('media')->nullable();
            $table->text('notes')->nullable();
            $table->enum('type', [1, 2])->index();
            $table->enum('status', [1, 2, 3, 4, 5])->index();
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
        Schema::dropIfExists('appointments');
    }
};
