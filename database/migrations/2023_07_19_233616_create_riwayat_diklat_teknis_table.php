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
        Schema::create('riwayat_diklat_teknis', function (Blueprint $table) {
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
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->smallInteger('jumlah_jam')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_diklat_teknis');
    }
};
