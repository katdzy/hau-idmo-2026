<?php

use App\Models\semconfig;
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
        Schema::create('semconfigs', function (Blueprint $table) {
            $table->id();
            $table->string('category'); 
            $table->string( 'current_sy'); 
            $table->string( 'current_sem');
            $table->timestamps();
        });


    
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semconfigs');
    }
};
