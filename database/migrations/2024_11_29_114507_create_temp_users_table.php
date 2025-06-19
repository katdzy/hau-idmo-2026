<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('temp_users', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('emp_fname')->nullable();
            $table->string('emp_mname')->nullable();
            $table->string('emp_lname')->nullable();
            $table->string('emp_dept')->nullable();
            $table->string('emp_gender')->nullable();
            $table->string('email_address_1')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('role')->nullable();
            // Add other fields as necessary
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('temp_users');
    }
}
