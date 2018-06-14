<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MainEventsAddFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_events_add_from_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_event_id');
            $table->text('user_whatsapp');
            $table->text('user_telegram');
            $table->text('user_youtube_stream');
            $table->text('user_instagram_stream');
            $table->integer('like');
            $table->integer('dislike');
            $table->integer('user_id');
            $table->integer('moderator_id');
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
        Schema::dropIfExists('main_events_add_from_users');
    }
}
