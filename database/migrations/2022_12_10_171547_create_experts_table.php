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
        Schema::create('experts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('photo');
            $table->integer('phone');
            $table->string('address');
            $table->time('time1')->default('0:0:0');
            $table->time('time2')->default('0:0:0');
            $table->integer('money')->default(0);
            $table->integer('fee')->default(100);
            $table->string('experience');
            $table->string('consultation_type');
            $table->integer('type');
            $table->float('rate')->default(3);
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
        Schema::dropIfExists('experts');
    }
};
