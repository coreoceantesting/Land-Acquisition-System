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
            $table->integer('divisional_officer_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('law');
            $table->text('divisional_officer_remark')->nullable()->after('divisional_officer_status');

            $table->integer('acquisition_officer_status')->default(0)->comment('0 => Pending, 1 => Approve, 2 => Reject')->after('divisional_officer_remark');
            $table->text('acquisition_officer_remark')->nullable()->after('acquisition_officer_status');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
