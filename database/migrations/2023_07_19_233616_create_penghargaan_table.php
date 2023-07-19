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
        Schema::create('penghargaan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->string('name')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('penghargaan');
    }
};
