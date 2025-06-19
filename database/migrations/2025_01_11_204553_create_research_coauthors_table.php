<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchCoauthorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('research_coauthors', function (Blueprint $table) {
            $table->id();
            $table->string('research_id');      // references the 'id' in 'researches' table
            $table->string('coauthor_name')->nullable();
            $table->integer('coauthor_participation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research_coauthors');
    }
}
