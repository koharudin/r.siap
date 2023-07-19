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
        Schema::create('diklat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('simpeg_id')->nullable();
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
        Schema::dropIfExists('diklat');
    }
};
