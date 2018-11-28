<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 256);
            $table->string('type', 15);

//          Track rule
            $table->string('track_type', 15)->nullable();
            $table->string('track_format', 15)->nullable();
            $table->mediumText('track_urls')->nullable();

//          Display
            $table->string('display_format', 15)->nullable();
            $table->mediumText('display_urls')->nullable();

//          Message
            $table->string('msg_title', 256)->nullable();
            $table->string('msg_text', 500)->nullable();
            $table->string('msg_img', 256)->nullable();
            $table->string('msg_lang', 10)->nullable();
            $table->string('msg_align', 10)->nullable();
            $table->string('msg_text_align', 10)->nullable(); // No need

//          Design
            $table->string('notify_position', 10)->nullable();
            $table->string('notify_title_color', 10)->nullable();
            $table->string('notify_title_bg_color', 10)->nullable();
            $table->string('notify_text_color', 10)->nullable();
            $table->string('notify_box_color', 10)->nullable();
            $table->string('notify_box_design', 25)->nullable();

//          Behavior
            $table->tinyInteger('notify_close_button')->nullable();
            $table->tinyInteger('notify_clickable')->nullable();
            $table->string('notify_link', 256)->nullable();
            $table->tinyInteger('notify_new_tab')->nullable();
            $table->tinyInteger('notify_utm_params')->nullable();

//          Time rule
            $table->tinyInteger('time_rule')->nullable();
            $table->string('time_rule_type', 10)->nullable();
            $table->tinyInteger('show_all_time_events')->nullable();
            $table->tinyInteger('hide_exact_time')->nullable();
            $table->tinyInteger('ignore_events')->nullable();
            $table->string('ignore_time_type', 10)->nullable();
            $table->unsignedInteger('ignore_time')->nullable();
            $table->string('display_conversion_time', 25)->nullable();

//          Display rule
            $table->tinyInteger('show_one_per_session')->nullable();
            $table->tinyInteger('hide_mobile')->nullable();
            $table->unsignedInteger('min_display')->nullable();
            $table->unsignedInteger('display_time')->nullable(); //seconds
            $table->tinyInteger('hide_max_event')->nullable();
            $table->unsignedInteger('hide_max_event_number')->nullable();
            $table->unsignedInteger('max_show')->nullable();
            $table->tinyInteger('show_anonymous')->nullable();
            $table->tinyInteger('hide_anonymous')->nullable();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('track_notifications');
    }
}
