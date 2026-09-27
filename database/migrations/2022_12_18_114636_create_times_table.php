<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {

           $table->id();
           $table->foreignId('expert_id')->constrained('experts')->default(0);
           $table->string('name');
           $table->string('email');
           $table->string('photo')->nullable();
           $table->string('phone');
           $table->dateTime('start_datetime')->default('1970-01-01 00:00:00');
           $table->dateTime('end_datetime')->default('1970-01-01 00:00:00');
           $table->integer('money_transferred')->nullable();
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
        Schema::dropIfExists('times');
    }
};
