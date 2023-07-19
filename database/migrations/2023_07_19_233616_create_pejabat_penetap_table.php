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
        Schema::create('pejabat_penetap', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('golongan')->nullable();
            $table->string('pangkat')->nullable();
            $table->integer('tahun_awal')->nullable();
            $table->integer('tahun_akhir')->nullable();
            $table->string('satker_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('jabatan')->nullable();
            $table->bigInteger('unit_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pejabat_penetap');
    }
};
