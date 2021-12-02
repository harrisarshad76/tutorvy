<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorSlots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutor_slots', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('day')->nullable();
            $table->string('wrk_from')->nullable();
            $table->string('wrk_to')->nullable();
            $table->string('day_off')->nullable();
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
        Schema::dropIfExists('tutor_slots');
    }
}
