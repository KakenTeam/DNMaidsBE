<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('emp_id');
            $table->tinyInteger('duration');          // đơn vị: tháng
            $table->date('valid_date');
            $table->date('expired_date');
            $table->integer('salary');
            $table->text('image')->nullable();
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
        Schema::dropIfExists('employee_contracts');
    }
}
