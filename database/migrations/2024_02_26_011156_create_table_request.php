<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->integer("creator");
            $table->integer("employee_id");
            $table->integer("category_id");
            $table->integer("status_id"); //1=DRAFT, 2=SUBMIT/Inbox Verifikator, 3=Proses Verifikasi, 4=Revisi,5=Terima, 6=Tolak
            $table->dateTime("date_created");
            $table->json("old_data");
            $table->json("request_data");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
