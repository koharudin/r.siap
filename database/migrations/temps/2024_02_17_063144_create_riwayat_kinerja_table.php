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
        Schema::create('riwayat_kinerja', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('tahun')->nullable();
            $table->string('nilai')->nullable();
            $table->date('tgl_penilaian')->nullable();
            $table->string('satuan_kerja')->nullable();
            $table->string('jabatan')->nullable();
            $table->float('nilai_skp', 0, 0)->nullable();
            $table->float('nilai_perilaku', 0, 0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_kinerja');
    }
};
