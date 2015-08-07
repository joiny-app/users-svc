<?php

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
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email', 255)->unique();
            $table->string('password', 60);
            $table->string('confirmed', 1);
            $table->string('name');
            $table->string('surname');
            $table->date('birth_date');
            $table->string('image_url')->nullable();
            $table->boolean('notifications')->nullable();
            $table->string('about_me')->nullable();
            $table->json('interests');
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
        Schema::drop('users');
    }
}
