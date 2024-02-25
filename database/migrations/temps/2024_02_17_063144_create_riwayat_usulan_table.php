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
        Schema::create('riwayat_usulan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('employee_id')->nullable();
            $table->timestamps(6);
            $table->text('old_data')->nullable();
            $table->text('new_data')->nullable();
            $table->smallInteger('status_id')->nullable();
            $table->smallInteger('kategori_layanan_id')->nullable();
            $table->bigInteger('ref_id')->nullable();
            $table->bigInteger('requestor')->nullable();
            $table->softDeletes('deleted_at', 6);
            $table->text('keterangan')->nullable();
            $table->smallInteger('action')->nullable();
            $table->string('dokumen_pendukung')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_usulan');
    }
};
