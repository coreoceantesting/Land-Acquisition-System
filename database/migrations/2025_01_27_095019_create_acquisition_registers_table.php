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

            Schema::create('acquisition_registers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('district_id')->nullable();
                $table->foreign('district_id')->references('id')->on('districts');
                $table->unsignedBigInteger('taluka_id')->nullable();
                $table->foreign('taluka_id')->references('id')->on('talukas');
                $table->unsignedBigInteger('village_id')->nullable();
                $table->foreign('village_id')->references('id')->on('villages');
                $table->integer('sr_no')->nullable();
                $table->unsignedBigInteger('land_acquisition_id')->nullable();
                $table->foreign('land_acquisition_id')->references('id')->on('land_acquisitions');
                $table->string('bundle')->nullable();
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
        Schema::dropIfExists('acquisition_registers');
    }
};
