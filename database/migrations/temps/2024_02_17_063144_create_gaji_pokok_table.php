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
        Schema::create('gaji_pokok', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->bigInteger('pangkat_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->smallInteger('masa_kerja')->nullable();
            $table->smallInteger('tahun')->nullable();
            $table->string('regulasi')->nullable();
            $table->timestamps(6);
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
        Schema::dropIfExists('gaji_pokok');
    }
};
