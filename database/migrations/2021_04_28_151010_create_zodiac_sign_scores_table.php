<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZodiacSignScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zodiac_sign_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zodiac_sign_id');
            $table->integer('score');
            $table->date('score_date');
            $table->string('score_year');
            $table->string('score_month');
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
        Schema::dropIfExists('zodiac_sign_scores');
    }
}
