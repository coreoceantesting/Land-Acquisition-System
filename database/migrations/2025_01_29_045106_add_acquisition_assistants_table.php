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
        Schema::table('acquisition_assistants', function (Blueprint $table) {
            $table->date('updated_date')->after('acquisition_officer_remark')->nullable();
            $table->integer('is_userdiff')->after('acquisition_officer_remark')->nullable();
            $table->integer('user_id')->after('acquisition_officer_remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acquisition_assistants', function (Blueprint $table) {
            $table->dropColumn('updated_date');
            $table->dropColumn('is_userdiff');
            $table->dropColumn('user_id');
        });
    }
};
