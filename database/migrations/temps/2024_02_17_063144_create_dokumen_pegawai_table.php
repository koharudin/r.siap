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
        Schema::create('dokumen_pegawai', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('klasifikasi_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('file')->nullable();
            $table->string('pk1')->nullable();
            $table->string('pk2')->nullable();
            $table->bigInteger('ref_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('simpeg_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen_pegawai');
    }
};
