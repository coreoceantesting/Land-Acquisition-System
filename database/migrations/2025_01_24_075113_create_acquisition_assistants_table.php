<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('acquisition_assistants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->unsignedBigInteger('taluka_id')->nullable();
            $table->foreign('taluka_id')->references('id')->on('talukas');
            $table->unsignedBigInteger('village_id')->nullable();
            $table->foreign('village_id')->references('id')->on('villages');
            $table->unsignedBigInteger('sr_no_id')->nullable();
            $table->foreign('sr_no_id')->references('id')->on('sr_nos');
            $table->unsignedBigInteger('land_acquisition_id')->nullable();
            $table->foreign('land_acquisition_id')->references('id')->on('land_acquisitions');
            $table->string('project_name')->nullable();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->foreign('year_id')->references('id')->on('years');
            $table->string('acquisition_board_name')->nullable();
            $table->text('description')->nullable();
            $table->string('designation')->nullable();
            $table->string('acquisition_proposal')->nullable();
            $table->string('law')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acquisition_assistants');
    }
};
