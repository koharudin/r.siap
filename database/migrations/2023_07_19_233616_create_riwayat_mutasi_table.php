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
        Schema::create('riwayat_mutasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('satker_lama')->nullable();
            $table->string('satker_baru')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('tmt_sk')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->string('pejabat_penetap_id')->nullable();
            $table->bigInteger('satker_id_lama')->nullable();
            $table->bigInteger('satker_id_baru')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_mutasi');
    }
};
