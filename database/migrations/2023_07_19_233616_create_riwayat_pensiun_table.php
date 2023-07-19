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
        Schema::create('riwayat_pensiun', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('no_bkn')->nullable();
            $table->string('tgl_bkn')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_pensiun')->nullable();
            $table->date('tmt_pensiun')->nullable();
            $table->smallInteger('masa_kerja_tahun')->nullable();
            $table->smallInteger('masa_kerja_bulan')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->smallInteger('jenis_pensiun_id')->nullable();
            $table->smallInteger('pangkat_id')->nullable();
            $table->bigInteger('unit_kerja_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pensiun');
    }
};
