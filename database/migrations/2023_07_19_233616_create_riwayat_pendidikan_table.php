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
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->bigInteger('pendidikan_id')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('tempat_sekolah')->nullable();
            $table->string('no_sttb')->nullable();
            $table->date('tgl_sttb')->nullable();
            $table->string('tahun')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('kepala_sekolah')->nullable();
            $table->string('akreditasi', 10)->nullable();
            $table->float('ipk', 0, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pendidikan');
    }
};
