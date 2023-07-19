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
        Schema::create('jenis_bahasa', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->smallIncrements('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_bahasa');
    }
};
