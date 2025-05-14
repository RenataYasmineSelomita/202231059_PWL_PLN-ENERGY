<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                                     // Name of the user
            $table->string('username')->unique();                        // Unique username
            $table->string('email')->unique();                            // Unique email
            $table->string('password');                                 // Password field
            $table->text('penugasan')->nullable();                       //  Use text for potentially long arrays, and make it nullable
            $table->string('position');                                 // Position of the user
            $table->enum('status', ['sudah ditugaskan', 'belum ditugaskan'])->default('belum ditugaskan'); // Status field
            $table->timestamps();                                         // Timestamps for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');                           // Drop the users table if rollback happens
    }
}
