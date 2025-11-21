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
        Schema::create('iso_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('originating_section', 255);
            $table->text('sharepoint_link');
            $table->text('message_to_idc');
            $table->string('status',50)->default('submitted_to_idc');
            $table->unsignedInteger('created_by');
            $table->timestamps();

            // // Foregin key to link to tbl_login
            // $table->foreign('created_by')->references('id')->on('tbl_login')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iso_tickets');
    }
};
