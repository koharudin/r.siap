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
        Schema::create('riwayat_rekammedis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->date('tgl_periksa')->nullable();
            $table->text('keluhan')->nullable();
            $table->text('diagnosa')->nullable();
            $table->string('jenis_pemeriksaan')->nullable();
            $table->text('tindakan')->nullable();
            $table->string('dokter')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_rekammedis');
    }
};
