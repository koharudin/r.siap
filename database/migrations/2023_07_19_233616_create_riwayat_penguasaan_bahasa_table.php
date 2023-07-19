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
        Schema::create('riwayat_penguasaan_bahasa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->smallInteger('jenis_bahasa')->nullable();
            $table->string('nama_bahasa')->nullable();
            $table->string('kemampuan_bicara', 1)->nullable();
            $table->string('jenis_sertifikasi')->nullable();
            $table->string('lembaga_sertifikasi')->nullable();
            $table->string('skor')->nullable();
            $table->date('tgl_expired')->nullable();
            $table->string('simpeg_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_penguasaan_bahasa');
    }
};
