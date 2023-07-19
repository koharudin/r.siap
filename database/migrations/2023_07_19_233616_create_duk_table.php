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
        Schema::create('duk', function (Blueprint $table) {
            $table->string('employee_id')->nullable();
            $table->string('periode')->nullable();
            $table->string('jenis')->nullable();
            $table->string('noduk')->nullable();
            $table->smallInteger('pangkat_id')->nullable();
            $table->date('tmt_pangkat')->nullable();
            $table->smallInteger('jabatan_id')->nullable();
            $table->string('jabatan')->nullable();
            $table->date('tmt_jabatan')->nullable();
            $table->smallInteger('eselon')->nullable();
            $table->date('tmt_eselon')->nullable();
            $table->smallInteger('masakerja_tahun')->nullable();
            $table->smallInteger('masakerja_bulan')->nullable();
            $table->bigInteger('diklat_id')->nullable();
            $table->smallInteger('tahun_diklat')->nullable();
            $table->smallInteger('jml_diklat_struktural')->nullable();
            $table->smallInteger('jml_diklat_nonstruktural')->nullable();
            $table->smallInteger('pendidikan_id')->nullable();
            $table->smallInteger('usia_tahun')->nullable();
            $table->smallInteger('usia_bulan')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->bigIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duk');
    }
};
