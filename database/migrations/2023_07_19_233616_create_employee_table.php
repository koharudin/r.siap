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
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->smallInteger('agama_id')->nullable();
            $table->timestamp('created_at', 6)->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('simpeg_id', 100)->nullable();
            $table->string('nip_baru', 100)->nullable();
            $table->string('gelar_depan')->nullable();
            $table->string('gelar_belakang')->nullable();
            $table->string('birth_place')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('sex', 1)->nullable();
            $table->string('status_kawin', 1)->nullable();
            $table->string('golongan_darah', 2)->nullable();
            $table->string('email_kantor')->nullable();
            $table->string('email')->nullable();
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->string('karpeg')->nullable();
            $table->string('taspen')->nullable();
            $table->string('npwp')->nullable();
            $table->string('askes')->nullable();
            $table->string('nik')->nullable();
            $table->string('no_hp')->nullable();
            $table->bigInteger('unit_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee');
    }
};
