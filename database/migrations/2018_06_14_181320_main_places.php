<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MainPlaces extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_places', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->integer('category_id');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('street_id');
            $table->integer('house_id');
            $table->text('whatsapp');
            $table->text('telegram');
            $table->text('youtube');
            $table->text('instagram');
            $table->text('youtube_stream');
            $table->text('instagram_stream');
            $table->integer('user_id');
            $table->integer('moderator_id');
            $table->float('latitude');
            $table->float('longitude');
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
        Schema::dropIfExists('main_places');
    }
}
