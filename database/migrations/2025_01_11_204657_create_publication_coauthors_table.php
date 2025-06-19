<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationCoauthorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('publication_coauthors', function (Blueprint $table) {
            $table->id();
            $table->string('publication_id');   // references the 'id' in 'publications' table
            $table->string('coauthor_name')->nullable();
            $table->integer('coauthor_participation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_coauthors');
    }
}
