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
        Schema::create('riwayat_orangtua', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('simpeg_id')->nullable();
            $table->string('name')->nullable();
            $table->string('status', 1)->nullable();
            $table->bigInteger('employee_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_orangtua');
    }
};
