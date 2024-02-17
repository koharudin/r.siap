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
        Schema::create('penempatan_pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('unit_id');
            $table->string('nama_unitkerja')->nullable();
            $table->bigInteger('jabatan_id');
            $table->string('nama_jabatan')->nullable();
            $table->bigInteger('kebutuhan')->default(0);
            $table->bigInteger('existing_pegawai')->default(0);
            $table->bigInteger('kelebihan_kekurangan')->default(0);
            $table->smallInteger('bulan');
            $table->smallInteger('tahun');
            $table->timestamps(6);

            $table->primary(['id', 'unit_id', 'jabatan_id', 'bulan', 'tahun']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penempatan_pegawai');
    }
};
