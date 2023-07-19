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
        Schema::create('riwayat_angkakredit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('dt_awal_penilaian')->nullable();
            $table->date('dt_akhir_penilaian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('pangkat_id', 2)->nullable();
            $table->decimal('ak_lama', 255, 0)->nullable();
            $table->decimal('ak_baru', 255, 0)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->date('tmt_pak')->nullable();
            $table->bigInteger('unit_kerja_id')->nullable();
            $table->smallInteger('jabatan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_angkakredit');
    }
};
