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

        //table for login credentials
        Schema::create('tbl_login', function (Blueprint $table) {
            $table-> integer('id') -> primary(); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role'); 
                // ---- Profile Picture -----//
           
            $table->integer('terminated')->nullable(); 
            $table->rememberToken();
            $table->timestamps();
        });


        // table for personal info
        Schema::create('tbl_info', function (Blueprint $table) { 
            $table-> integer('emp_id') -> primary(); 
      
            // ------- FULL NAME -----------///
            $table->string('emp_fname', 50)->notNullable(); //first name 
            $table-> string('emp_mname', 50)-> nullable(); //middlename   
            $table-> string('emp_lname',50)->notNullable(); //last name

            $table-> string('profile_picture', 100)-> nullable(); 


            $table-> string('emp_dept', 100)-> notNullable(); 
            $table-> string('emp_gender', 10)-> nullable() ; //gender
            $table-> string('emp_maiden_name', 20)-> nullable(); //maiden name
            $table-> date('emp_dob')-> nullable();  //date of birth
            $table-> string('emp_pob')-> nullable(); //place of birth 
            $table-> string('emp_cStatus', 10)-> nullable(); //civil status
            $table-> string('emp_religion',50)-> nullable(); //religion 
            $table-> string('emp_blood_type', 10)-> nullable(); //blood type 

            // --------- ADDRESS -----/ 
            $table->  string('emp_houseno', 50)-> nullable(); 
            $table-> string('street', 50) -> nullable();
            $table-> string('brgy', 50 )-> nullable(); 
            $table-> string('city', 50)-> nullable(); 
            $table -> string('province', 50)-> nullable();  
            $table-> string('postal_code',20)-> nullable();
            
            $table-> string('info_status', 20) -> nullable(); 


            // ------- personal contact ----------/ 
            $table-> string('home_phone',20)-> nullable(); 
            $table-> string('mobile_phone',20)-> nullable(); 
            $table-> string('email_address_1', 50)-> nullable(); 
            $table-> string('email_address_2' ,50)-> nullable(); 

            //hiring information
            $table-> timestamps(); 


        });


        
        Schema::create('tbl_accounting_details',function(Blueprint $table) { 
            $table-> integer('emp_id')-> primary(); 
            $table-> string('sss_no')-> nullable(); 
            $table-> string('tax_no')-> nullable(); 
            $table-> string('pagibig_no')-> nullable();
            $table-> string('philhealth_no')-> nullable(); 
            $table->timestamps(); 
        }); 


        //// SESSSSIONS ///////////

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_login');
        Schema::dropIfExists('tbl_info'); 
        Schema::dropIfExists('tbl_accounting_details'); 
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('users');
    }
};
