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
        Schema::create('riwayat_dp3', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->float('kesetiaan', 0, 0)->nullable();
            $table->float('prestasi', 0, 0)->nullable();
            $table->float('tanggung_jawab', 0, 0)->nullable();
            $table->float('ketaatan', 0, 0)->nullable();
            $table->float('kejujuran', 0, 0)->nullable();
            $table->float('kerjasama', 0, 0)->nullable();
            $table->float('prakarsa', 0, 0)->nullable();
            $table->float('kepemimpinan', 0, 0)->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('tahun')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_dp3');
    }
};
