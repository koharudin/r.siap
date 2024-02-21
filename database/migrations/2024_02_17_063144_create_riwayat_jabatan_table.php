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
        Schema::create('riwayat_jabatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('tgl_sk')->nullable();
            $table->date('tmt_jabatan')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->string('eselon')->nullable();
            $table->date('tmt_eselon')->nullable();
            $table->string('nama_jabatan')->nullable();
            $table->string('fungsional_id', 100)->nullable();
            $table->string('no_pelantikan')->nullable();
            $table->date('tgl_pelantikan')->nullable();
            $table->string('tunjangan')->nullable();
            $table->string('kredit')->nullable();
            $table->string('bln_dibayar')->nullable();
            $table->bigInteger('pejabat_penetap_id')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->bigInteger('tipe_jabatan_id')->nullable();
            $table->bigInteger('unit_id')->nullable();
            $table->string('unit_text')->nullable();
            $table->smallInteger('status_jabatan_id')->nullable();
            $table->string('jabatan_id_old')->nullable();
            $table->bigInteger('jabatan_id')->nullable();
            $table->integer('status_riwayat')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_jabatan');
    }
};
