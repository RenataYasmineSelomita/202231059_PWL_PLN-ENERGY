<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id(); // id dengan auto increment
            $table->string('nama'); // nama varchar(255)
            $table->date('tanggal_mulai'); // tanggal_mulai date
            $table->date('tanggal_selesai'); // tanggal_selesai date
            $table->timestamps(); // created_at, updated_at timestamps
            $table->string('email')->nullable(); // email varchar(255) nullable
            $table->unsignedBigInteger('user_id')->nullable(); // user_id bigint(20) nullable
            $table->string('deskripsi')->nullable(); // deskripsi varchar(255) nullable
            $table->string('lokasi')->nullable(); // lokasi varchar(255) nullable
            $table->string('waktu_mulai')->nullable(); // waktu_mulai varchar(255) nullable
            $table->string('waktu_selesai')->nullable(); // waktu_selesai varchar(255) nullable
            $table->enum('status_tugas', ['baru', 'dikerjakan', 'selesai', 'pending'])->default('baru'); // status_tugas enum
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tugas');
    }
}
