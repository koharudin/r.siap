<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_kursus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('simpeg_id')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('nama')->nullable();
            $table->string('tempat')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->smallInteger('angkatan')->nullable();
            $table->integer('tahun')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('no_sttpp')->nullable();
            $table->date('tgl_sttpp')->nullable();
            $table->integer('lama_jam')->nullable();
            $table->string('id_diklat_siasn', 40)->nullable();
            $table->smallInteger('jenis_diklat_siasn')->nullable();
            $table->smallInteger('flag_integrasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_kursus');
    }
};
