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
            $table->increments('id');
            $table->string('idn', 20)->unique()->nullable();
            $table->string('name', 100);
            $table->string('image', 100)->nullable();
            $table->string('image_path', 100)->default('default.jpg');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken('rememberToken');
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
        Schema::dropIfExists('users');
    }
}
