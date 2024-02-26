<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_category', function (Blueprint $table) {
            $table->id();
            $table->uuid("uuid");
            $table->integer("parent_id")->nullable();
            $table->string("name");
            $table->boolean("open_submission")->default(false); //true=able to submit,false=forbid to submit
            $table->boolean("active")->default(false); //true=show,false=hidden
            $table->integer("order")->default(1);
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
        Schema::dropIfExists('request_category');
    }
}
