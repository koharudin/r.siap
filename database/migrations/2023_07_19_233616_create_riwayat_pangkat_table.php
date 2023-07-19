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
        Schema::create('riwayat_pangkat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('simpeg_id', 100)->nullable();
            $table->string('stlud')->nullable();
            $table->string('no_stlud')->nullable();
            $table->date('tgl_stlud')->nullable();
            $table->string('no_nota')->nullable();
            $table->date('tgl_nota')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('tmt_pangkat')->nullable();
            $table->decimal('kredit', 255, 0)->nullable();
            $table->string('pangkat_id', 2)->nullable();
            $table->string('jenis_kp')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->string('jenis_ket')->nullable();
            $table->date('tmt_pak')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->smallInteger('masakerja_thn')->nullable();
            $table->smallInteger('masakerja_bln')->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->string('pejabat_penetap_id', 100)->nullable();
            $table->string('dokumen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pangkat');
    }
};
