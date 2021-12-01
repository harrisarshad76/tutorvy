<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_messages', function (Blueprint $table) {
            $table->id();
            $table->longText('message')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->string('type')->nullable();
            $table->integer('is_seen')->nullable()->default('1');
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
        Schema::dropIfExists('class_messages');
    }
}
