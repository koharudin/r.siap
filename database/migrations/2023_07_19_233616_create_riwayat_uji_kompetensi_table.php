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
        Schema::create('riwayat_uji_kompetensi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('satker')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal')->nullable();
            $table->bigInteger('satker_id')->nullable();
            $table->bigInteger('jabatan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_uji_kompetensi');
    }
};
