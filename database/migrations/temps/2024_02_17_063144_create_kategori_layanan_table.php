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
        Schema::create('kategori_layanan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('name')->nullable();
            $table->timestamps(6);
            $table->smallInteger('order')->nullable()->default(1);
            $table->string('form_request_class')->nullable();
            $table->smallInteger('enabled')->nullable()->default(1);
            $table->string('form_request_model')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_layanan');
    }
};
