<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('helper_id')->nullable();
            $table->unsignedInteger('last_editor_id')->nullable();
            $table->tinyInteger("helper_gender");
            $table->json('skill');
            $table->string('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->String('status')->default('unverified');
            $table->integer('fee');
            $table->tinyInteger('service_type')->default(1);                //0: định kỳ, 1:lẻ
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
        Schema::dropIfExists('contract');
    }
}
