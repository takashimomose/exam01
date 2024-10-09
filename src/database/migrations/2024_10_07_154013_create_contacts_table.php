<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');  // PRIMARY KEY, bigint unsigned

            $table->unsignedBigInteger('category_id');  // FOREIGN KEY
            $table->string('first_name', 255);  // NOT NULL, varchar(255)
            $table->string('last_name', 255);  // NOT NULL, varchar(255)
            $table->tinyInteger('gender');  // NOT NULL, tinyint (1:男性, 2:女性, 3:その他)
            $table->string('email', 255);  // NOT NULL, varchar(255)
            $table->string('tel', 255);  // NOT NULL, varchar(255)
            $table->string('address', 255);  // NOT NULL, varchar(255)
            $table->string('building', 255)->nullable();  // varchar(255), NULL許可
            $table->text('detail');  // NOT NULL, text

            // created_at, updated_at
            $table->timestamps();

            // Foreign Key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
