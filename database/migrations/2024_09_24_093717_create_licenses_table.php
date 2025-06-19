<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\requests; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('emp_id'); 

            $table->string('title'); 
            $table->string('type');
            $table->date('date_obtained');
            $table->string('attachment'); 
            $table-> string('status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
