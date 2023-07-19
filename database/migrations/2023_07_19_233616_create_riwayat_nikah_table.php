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
        Schema::create('riwayat_nikah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('buku_nikah')->nullable();
            $table->string('no_karis')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->date('tgl_kawin')->nullable();
            $table->smallInteger('jenis_pekerjaan')->nullable();
            $table->string('nip')->nullable();
            $table->smallInteger('urutan_nikah')->nullable();
            $table->smallInteger('urutan_pasangan')->nullable();
            $table->string('tempat_pekerjaan')->nullable();
            $table->smallInteger('status')->nullable();
            $table->string('no_sk_cerai')->nullable();
            $table->date('tmt_sk_cerai')->nullable();
            $table->date('tgl_sk_cerai')->nullable();
            $table->smallInteger('sdh_dibayar')->nullable();
            $table->smallInteger('status_tunjangan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->date('bulan_dibayar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_nikah');
    }
};
