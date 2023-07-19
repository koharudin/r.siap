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
        Schema::create('riwayat_hukuman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->text('pelanggaran')->nullable();
            $table->date('tmt_sk')->nullable();
            $table->bigInteger('pejabat_penetap_id')->nullable();
            $table->string('pejabat_penetap_jabatan')->nullable();
            $table->string('pejabat_penetap_nip')->nullable();
            $table->string('pejabat_penetap_nama')->nullable();
            $table->date('tmt_akhir')->nullable();
            $table->bigInteger('pejabat_penetap_akhir_id')->nullable();
            $table->string('pejabat_penetap_akhir_jabatan')->nullable();
            $table->string('pejabat_penetap_akhir_nip')->nullable();
            $table->string('pejabat_penetap_akhir_nama')->nullable();
            $table->string('sk_akhir')->nullable();
            $table->date('tgl_sk_akhir')->nullable();
            $table->bigInteger('hukuman_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_hukuman');
    }
};
