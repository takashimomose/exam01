<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id'); // bigint unsigned and PRIMARY KEY
            $table->string('name', 255)->nullable(false); // varchar(255) and NOT NULL
            $table->string('email', 255)->nullable(false); // varchar(255) and NOT NULL
            $table->string('password', 255)->nullable(false); // varchar(255) and NOT NULL
            $table->timestamps(); // created_at and updated_at as timestamp
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
