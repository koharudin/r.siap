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
        Schema::create('riwayat_skcpns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('no_nota')->nullable();
            $table->date('tgl_nota')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('tmt_cpns')->nullable();
            $table->bigInteger('pejabat_penetap_id')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->smallInteger('pangkat_id')->nullable();
            $table->date('tgl_tugas')->nullable();
            $table->smallInteger('masa_kerja_tahun')->nullable();
            $table->smallInteger('masa_kerja_bulan')->nullable();
            $table->smallInteger('tambahan_tahun')->nullable();
            $table->smallInteger('tambahan_bulan')->nullable();
            $table->smallInteger('total_tahun')->nullable();
            $table->smallInteger('total_bulan')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->string('no_sk_penyesuaian_mk')->nullable();
            $table->date('tgl_sk_penyesuaian_mk')->nullable();
            $table->date('tmt_sk_penyesuaian_mk')->nullable();
            $table->string('pejabat_penetap_sk_penyesuaian_mk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_skcpns');
    }
};
