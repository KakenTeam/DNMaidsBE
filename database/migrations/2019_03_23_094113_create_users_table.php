<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->text('image')->nullable();
            $table->tinyInteger('gender')->default(0);    //0:nu 1:nam
            $table->date('birthday')->nullable();
            $table->tinyInteger('status')->default(1);    //0: disable, 1:active
            $table->tinyInteger('role')->default(2);                        //0:admin, 1:helper, 2:customer
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
