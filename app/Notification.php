<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'track_notifications';

    protected $fillable = [
        'name', 'type', 'track_type', 'track_format', 'track_urls',
        'display_format', 'display_urls', 'msg_title', 'msg_text',
        'msg_img', 'msg_lang', 'msg_align', 'msg_text_align',
        'notify_position', 'notify_title_color', 'notify_title_bg_color',
        'notify_text_color', 'notify_box_color', 'notify_box_design',
        'notify_close_button', 'notify_clickable', 'notify_link',
        'notify_new_tab', 'notify_utm_params', 'time_rule', 'time_rule_type',
        'show_all_time_events', 'hide_exact_time', 'ignore_events',
        'ignore_time_type', 'ignore_time', 'display_conversion_time',
        'show_one_per_session', 'hide_mobile', 'min_display', 'display_time',
        'hide_max_event', 'hide_max_event_number', 'max_show', 'show_anonymous',
        'hide_anonymous', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
