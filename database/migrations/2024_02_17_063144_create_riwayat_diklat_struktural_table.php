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
        Schema::create('riwayat_diklat_struktural', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->string('jenis_diklat', 1)->nullable();
            $table->string('nama_diklat')->nullable();
            $table->string('tempat')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->string('angkatan')->nullable();
            $table->integer('tahun')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('no_sttpp')->nullable();
            $table->date('tgl_sttpp')->nullable();
            $table->string('diklat_id', 100)->nullable();
            $table->timestamps(6);
            $table->smallInteger('jumlah_jam')->nullable();
            $table->string('diklat')->nullable();
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
        Schema::dropIfExists('riwayat_diklat_struktural');
    }
};
