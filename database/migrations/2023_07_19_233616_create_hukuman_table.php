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
        Schema::create('hukuman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('simpeg_id')->nullable();
            $table->string('name')->nullable();
            $table->decimal('jenis', 255, 0)->nullable();
            $table->decimal('jumlah_min', 255, 0)->nullable();
            $table->decimal('jumlah_max', 255, 0)->nullable();
            $table->decimal('jenis_efek', 255, 0)->nullable();
            $table->decimal('durasi_efek', 255, 0)->nullable();
            $table->decimal('proses', 255, 0)->nullable();
            $table->decimal('rentang', 255, 0)->nullable();
            $table->decimal('efek', 255, 0)->nullable();
            $table->decimal('tingkat', 255, 0)->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->smallInteger('order')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hukuman');
    }
};
