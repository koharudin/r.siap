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
        Schema::create('riwayat_skpns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('tmt_pns')->nullable();
            $table->bigInteger('pejabat_penetap_id')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->smallInteger('pangkat_id')->nullable();
            $table->smallInteger('sumpah')->nullable();
            $table->string('no_ujikes')->nullable();
            $table->date('tgl_ujikes')->nullable();
            $table->string('no_prajab')->nullable();
            $table->date('tgl_prajab')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_skpns');
    }
};
