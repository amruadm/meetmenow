<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MainEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_events', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->timestamp("begin");
            $table->timestamp("end");
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
            $table->double('google_longitude', 10, 10);
            $table->double('google_latitude', 10, 10);
            $table->double('yandex_longitude', 10, 10);
            $table->double('yandex_latitude', 10, 10);
            $table->integer('place_id');
            $table->text('description');
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
        Schema::dropIfExists('main_events');
    }
}
