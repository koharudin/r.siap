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
        Schema::create('riwayat_gaji', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('tmt_sk')->nullable();
            $table->string('pejabat_penetap_id')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->integer('masakerja_tahun')->nullable();
            $table->integer('masakerja_bulan')->nullable();
            $table->string('jenis_kenaikan')->nullable();
            $table->string('pangkat_id', 2)->nullable();
            $table->bigInteger('riwayat_pangkat_id')->nullable();
            $table->decimal('gaji_pokok', 255, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_gaji');
    }
};
