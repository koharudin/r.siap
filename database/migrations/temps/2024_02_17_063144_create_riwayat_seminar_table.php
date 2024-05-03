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
        Schema::create('riwayat_seminar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('simpeg_id')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->timestamps(6);
            $table->string('nama')->nullable();
            $table->string('tempat')->nullable();
            $table->string('penyelenggara')->nullable();
            $table->smallInteger('angkatan')->nullable();
            $table->date('tgl_mulai')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('no_piagam')->nullable();
            $table->date('tgl_piagam')->nullable();
            $table->string('status')->nullable();
            $table->string('peran')->nullable();
            $table->smallInteger('jenis_piagam')->nullable()->default(2);
            $table->integer('tahun')->nullable();
            $table->integer('jumlah_jam')->nullable();
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
        Schema::dropIfExists('riwayat_seminar');
    }
};
