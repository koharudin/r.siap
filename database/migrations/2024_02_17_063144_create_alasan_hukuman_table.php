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
        Schema::create('alasan_hukuman', function (Blueprint $table) {
            $table->string('id_hukuman', 40)->primary();
            $table->string('nama_hukuman', 512)->nullable();
            $table->string('keterangan_hukuman', 16)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alasan_hukuman');
    }
};
