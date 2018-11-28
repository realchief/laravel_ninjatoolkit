<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Auth;
use Alert;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['user_id' => Auth::user()->id]);
        $this->validate($request,[
            'name' => 'required|max:100',
            'type' => 'required|max:100',

            'track_format' => 'required|max:15',
            'track_urls' => 'required|max:100',

            'display_format' => 'required|max:15',
            'display_urls' => 'nullable|max:1000',

            'msg_title' => 'required|max:50',
            'msg_text' => 'required|max:100',
            'msg_img' => 'required|max:256',
            'msg_lang' => 'required|max:10',
            'msg_align' => 'nullable|max:10',

            'notify_position' => 'required|max:10',
            'notify_title_color' => 'required|max:10',
            'notify_title_bg_color' => 'required|max:10',
            'notify_text_color' => 'required|max:10',
            'notify_box_color' => 'required|max:10',
            'notify_box_design' => 'nullable|max:25',

            'notify_link' => 'nullable|max:256',

            'time_rule_type' => 'nullable|max:10',
            'ignore_time_type' => 'nullable|max:10',
            'display_conversion_time' => 'nullable|max:25',
        ]);

        Notification::create($request->all());

        return redirect('/notifications/')->with('success', 'Notification created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        return view('notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        $this->validate($request,[
            'name' => 'required|max:100',
            'url' => 'required|max:100'
        ]);

        $notification->update($request->all());

        Alert::success('Saved', 'Your settings were saved successfully.');
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Destroy $request
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Notification $notification)
    {
        if ($notification->delete()) {
            Alert::success('Saved', 'Notification successfully deleted.');
            return redirect('/');
        }
    }
}
