@extends('layouts.app')

@section('title', ' | Notifications | Create')

@section('styles')
    <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
    <link href="/css/create-notification.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container" id="vue-element">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header navbar-purple text-white">
                        <h1>Create Notification</h1>
                    </div>
                    <div class="card-body notification-card-body">
                        <div id="preloader" v-if="settings.show_preloader"><div class="preloader-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <form method="POST" action="{{ url('notifications') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-3">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link disabled" :class="{ 'active show': settings.step == 1}" id="v-pills-type-tab" data-toggle="pill" href="#v-pills-type" role="tab" aria-controls="v-pills-type" aria-selected="true"><span class="badge badge-light">1</span> <span>Type</span></a>
                                                <a class="nav-link disabled" :class="{ 'active show': settings.step == 2}" id="v-pills-track-tab" data-toggle="pill" href="#v-pills-track" role="tab" aria-controls="v-pills-track" aria-selected="false"><span class="badge badge-light">2</span> <span>Track</span></a>
                                                <a class="nav-link disabled" :class="{ 'active show': settings.step == 3}" id="v-pills-display-tab" data-toggle="pill" href="#v-pills-display" role="tab" aria-controls="v-pills-display" aria-selected="false"><span class="badge badge-light">3</span> <span>Display</span></a>
                                                <a class="nav-link disabled" :class="{ 'active show': settings.step == 4}" id="v-pills-message-tab" data-toggle="pill" href="#v-pills-message" role="tab" aria-controls="v-pills-message" aria-selected="false"><span class="badge badge-light">4</span> <span>Message</span></a>
                                                <a class="nav-link disabled" :class="{ 'active show': settings.step == 5}" id="v-pills-customize-tab" data-toggle="pill" href="#v-pills-customize" role="tab" aria-controls="v-pills-customize" aria-selected="false"><span class="badge badge-light">5</span> <span>Customize</span></a>
                                                <a class="nav-link disabled" :class="{ 'active show': settings.step == 6}" id="v-pills-launch-tab" data-toggle="pill" href="#v-pills-launch" role="tab" aria-controls="v-pills-launch" aria-selected="false"><span class="badge badge-light">6</span> <span>Launch</span></a>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                            <div class="tab-content" id="v-pills-tabContent">

                                                {{--Tab Type--}}
                                                <div class="tab-pane fade" :class="{ 'active show': settings.step == 1}" id="v-pills-type" role="tabpanel" aria-labelledby="v-pills-type-tab">
                                                    <input type="hidden" name="type" v-model="type.notification_type" required />
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="card type-card" @click="pageVisits">
                                                                <div class="card-body text-center">
                                                                    <h5 class="align-middle">Page Visits & Conversations</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card type-card">
                                                                <div class="card-body text-center">
                                                                    <h5>Live Visitors</h5>
                                                                    <span class="small">Comming Soon</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="card type-card">
                                                                <div class="card-body text-center">
                                                                    <h5>Conversion Feed</h5>
                                                                    <span class="small">Comming Soon</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--/Tab Type--}}

                                                {{--Tab Track--}}
                                                <div class="tab-pane fade" :class="{ 'active show': settings.step == 2}" id="v-pills-track" role="tabpanel" aria-labelledby="v-pills-track-tab">
                                                    <div class="card">
                                                        <div class="card-header lead">Track Visits</div>
                                                        <div class="card-body" >
                                                            <input type="hidden" name="track_format" v-model="track.track_format" />
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p class="description mb-0 mt-2">Select URL match type <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you will need to select url(s) match type">i</button> </p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="item float-right">
                                                                        <div class="btn-group" role="group">
                                                                            <button type="button" class="btn" :class="getTrackTypeClass('simple')" @click="trackType('simple')"><i class="fa" :class="{ 'fa-check' : track.track_format == 'simple' }"></i> Simple</button>
                                                                            <button type="button" class="btn" :class="getTrackTypeClass('contains')" @click="trackType('contains')"><i class="fa" :class="{ 'fa-check' : track.track_format == 'contains' }"></i> Contains</button>
                                                                            <button type="button" class="btn" :class="getTrackTypeClass('regex')" @click="trackType('regex')"><i class="fa" :class="{ 'fa-check' : track.track_format == 'regex' }"></i> Regex</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <div v-if="track.track_format == 'simple'">
                                                                <input type="hidden" name="track_urls" v-model="track.simple_track_urls">
                                                                <div >
                                                                    <div>Which pages would you like us to track?</div>
                                                                    <div>Add one or more page URLs or copy them directly from your web browser.</div>
                                                                    <div class="alert alert-warning" role="alert">
                                                                        We treat http://, https://, www and non-www as separate versions of the URL and page.
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group input-group-lg">
                                                                        <input type="text" class="form-control" :class="{'bg-danger': track.invalid_track_url}" name="add_track_urls" id="add_track_urls" placeholder="Page URL(s)" v-model="track.add_track_url">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-primary" type="button" @click="addTrackUrl"><i class="fa fa-plus"></i> </button>
                                                                        </div>
                                                                    </div>
                                                                    <p v-if="track.invalid_track_url" class="text-danger">You must add at least one URL <br/> URL is invalid.</p>
                                                                </div>
                                                                <span v-for="track_url in track.urls" class="track-url-links"><i class="fa fa-trash" @click="deleteTrackUrl(track_url.id)"></i> @{{ track_url.url }}</span>
                                                            </div>
                                                            <div v-else>
                                                                <p v-if="track.track_format == 'contains'" >Track all page URLs that contain the following expression:</p>
                                                                <p v-else>Track all page URLs that match the following RegEx expression:</p>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="track_urls" id="track_urls" v-model="track.expression_track_urls" placeholder="Expression">
                                                                </div>
                                                            </div>
                                                            <div v-if="track.show_track_error" class="text-danger">You must add at least one URL</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--/Tab Track--}}

                                                {{--Tab display--}}
                                                <div class="tab-pane fade" :class="{ 'active show': settings.step == 3}" id="v-pills-display" role="tabpanel" aria-labelledby="v-pills-display-tab">
                                                    <div class="card">
                                                        <div class="card-header lead">Display Activity</div>
                                                        <div class="card-body">
                                                            <input type="hidden" name="display_format" v-model="display.display_format" />
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <p class="description mb-0 mt-2">Select URL match type <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you will need to select url(s) match type">i</button> </p>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="item float-right">
                                                                        <div class="btn-group" role="group">
                                                                            <button type="button" class="btn" :class="getDisplayTypeClass('simple')" @click="displayType('simple')"><i class="fa" :class="{ 'fa-check' : display.display_format == 'simple' }"></i> Simple</button>
                                                                            <button type="button" class="btn" :class="getDisplayTypeClass('contains')" @click="displayType('contains')"><i class="fa" :class="{ 'fa-check' : display.display_format == 'contains' }"></i> Contains</button>
                                                                            <button type="button" class="btn" :class="getDisplayTypeClass('regex')" @click="displayType('regex')"><i class="fa" :class="{ 'fa-check' : display.display_format == 'regex' }"></i> Regex</button>
                                                                            <button type="button" class="btn" :class="getDisplayTypeClass('all')" @click="displayType('all')"><i class="fa" :class="{ 'fa-check' : display.display_format == 'all' }"></i> All Pages</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <div v-if="display.display_format == 'simple'">
                                                                <input type="hidden" name="display_urls" v-model="display.simple_display_urls">
                                                                <div >
                                                                    <div>Where would you like to display your captured conversions?</div>
                                                                    <div>Add one or more page URLs or copy them directly from your web browser.</div>
                                                                    <div>We will start displaying your conversions when we capture some.</div>
                                                                    <div class="alert alert-warning" role="alert">
                                                                        We treat http://, https://, www and non-www as separate versions of the URL and page.
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group input-group-lg">
                                                                        <input type="text" class="form-control" :class="{'bg-danger': display.invalid_display_url}" name="add_display_urls" id="add_display_urls" placeholder="Page URL(s)" v-model="display.add_display_url">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-primary" type="button" @click="addDisplayUrl"><i class="fa fa-plus"></i> </button>
                                                                        </div>
                                                                    </div>
                                                                    <p v-if="display.invalid_display_url" class="text-danger">You must add at least one URL <br/> URL is invalid.</p>
                                                                </div>
                                                                <span v-for="display_url in display.urls" class="display-url-links"><i class="fa fa-trash" @click="deleteDisplayUrl(display_url.id)"></i> @{{ display_url.url }}</span>
                                                            </div>
                                                            <div v-else-if="display.display_format == 'contains' || display.display_format == 'regex'">
                                                                <p v-if="display.display_format == 'contains'" >Display on all page URLs that contain the following expression. <br/> We will start displaying your conversions when we capture some.</p>
                                                                <p v-else>Display on all page URLs that match the following RegEx expression. <br/> We will start displaying your conversions when we capture some.</p>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="display_urls" id="display_urls" v-model="display.expression_display_urls" placeholder="Expression">
                                                                </div>
                                                            </div>
                                                            <div v-else>
                                                                <div class="alert alert-success" role="alert">
                                                                    This notification will be shown on every page of your websites.
                                                                </div>
                                                            </div>

                                                            <div v-if="display.show_display_error" class="text-danger">You must add at least one URL</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--/Tab display--}}

                                                {{--Tab message--}}
                                                <div class="tab-pane fade" :class="{ 'active show': settings.step == 4}" id="v-pills-message" role="tabpanel" aria-labelledby="v-pills-message-tab">

                                                    <div class="card">
                                                        <div class="card-header lead">Notification & Language Settings</div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">Notification Language</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <select class="form-control" name="msg_lang" v-model="message.msg_lang" @change="setLocale">
                                                                            <option value="en">English</option>
                                                                            <option value="fr">French</option>
                                                                            <option value="es">Spanish</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Text Right to Left</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="msg_align" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr/>
                                                            <div class="form-group">
                                                                <label for="msg_title">Message Title</label>
                                                                <input type="text" class="form-control" name="msg_title" placeholder="Visitors" v-model="message.msg_title" @input="checkMsgTitle">
                                                                <span class="text-danger">@{{ message.msg_title_error }}</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="msg_text">Message Text</label>
                                                                <input type="text" class="form-control" name="msg_text" placeholder="" v-model="message.msg_text" @input="checkMsgText">
                                                                <span class="text-danger">@{{ message.msg_text_error }}</span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="msg_img">Image</label>
                                                                <input type="text" class="form-control" name="msg_img" placeholder="https://cdn.ninjatoolkit.com/icon.gif" v-model="message.msg_img" @input="checkMsgImage">
                                                                <span class="text-danger">@{{ message.msg_img_error }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--/Tab message--}}

                                                {{--Tab customize--}}
                                                <div class="tab-pane fade" :class="{ 'active show': settings.step == 5}" id="v-pills-customize" role="tabpanel" aria-labelledby="v-pills-customize-tab">
                                                    <div class="card">
                                                        <div class="card-header lead">Design</div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">Notification Position</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <select class="form-control" name="notify_position" v-model="customize.design.notify_position">
                                                                            <option value="bl">Bottom Left</option>
                                                                            <option value="br">Bottom Right</option>
                                                                            <option value="tl">Top Left</option>
                                                                            <option value="tr">Top Right</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Title Color</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input id="notify_title_color" name="notify_title_color" type="text" class="form-control" v-model="customize.design.notify_title_color" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Title Background</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input id="notify_title_bg_color" name="notify_title_bg_color" type="text" class="form-control" v-model="customize.design.notify_title_bg_color" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Text Color</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input id="notify_text_color" name="notify_text_color" type="text" class="form-control" v-model="customize.design.notify_text_color " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Box Background</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input id="notify_box_color" name="notify_box_color" type="text" class="form-control" v-model="customize.design.notify_box_color" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Title Background</div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <select class="form-control" name="notify_box_design" v-model="customize.design.notify_box_design">
                                                                            <option value="1">Style 1</option>
                                                                            <option value="2">Style 2</option>
                                                                            <option value="3">Style 3</option>
                                                                            <option value="4">Style 4</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-header lead">Behavior</div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">Allow users to close the notification <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can close all notifications">i</button> </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="notify_close_button" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Clickable Notification <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can">i</button></div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="notify_clickable" id="notify_clickable" v-model="customize.behavior.notify_clickable" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-show="customize.behavior.notify_clickable">
                                                                <div class="row">
                                                                    <div class="col-sm-6">Notification Link </div>
                                                                    <div class="col-sm-6 text-right">
                                                                        <div class="form-group float-right">
                                                                            <input type="text" class="form-control" name="notify_link" v-model="customize.behavior.notify_link" @input="customize.behavior.linkErrorMsg = checkValidURL(customize.behavior.notify_link) ? '' : 'URL is invalid.'" placeholder="https://ninjatoolkit.com/" style="width: 250px">
                                                                            <span class="text-danger">@{{ customize.behavior.linkErrorMsg }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="alert alert-warning" role="alert">
                                                                    If http:// is omitted, the link will open relatively to the page displayed
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">Open Notification link in a new tab <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can">i</button></div>
                                                                    <div class="col-sm-6 text-right">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="notify_new_tab" id="notify_new_tab" data-toggle="toggle" value="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">Automatically append UTM params </div>
                                                                    <div class="col-sm-6 text-right">
                                                                        <div class="form-group">
                                                                            <input type="checkbox" name="notify_utm_params" id="notify_utm_params" data-toggle="toggle" value="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-header lead">Time Rules</div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">Show events from all time <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can close all notifications">i</button> </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="show_all_time_events" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Hide the exact time passed <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can">i</button></div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="hide_exact_time" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Ignore events <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can">i</button></div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group form-inline float-right">
                                                                        <input type="number" class="form-control text-center" name="ignore_time" id="ignore_time" min="0" placeholder="0" style="width: 80px" :disabled="customize.timeRules.ignore_events != 1">
                                                                        <select class="form-control" name="ignore_time_type" :disabled="customize.timeRules.ignore_events != 1">
                                                                            <option>Minutes</option>
                                                                            <option>Hours</option>
                                                                        </select>
                                                                        <input type="checkbox" name="ignore_events" id="ignore_events" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="card">
                                                        <div class="card-header lead">Display Rules</div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-6">Show only once per session </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="show_one_per_session" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Hide on mobile screens </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="hide_mobile" data-toggle="toggle" value="1" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Minimum events to display  </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group float-right">
                                                                        <input type="number" class="form-control" name="min_display" min="0" placeholder="0" style="width: 100px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Display notification for </div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group float-right">
                                                                        <input type="number" class="form-control" name="display_time" min="0" placeholder="0 Sec" style="width: 100px">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">Hide the exact number of events if larger than  <button type="button" class="tooltip-button" data-toggle="button-tooltip" title="Here you can">i</button></div>
                                                                <div class="col-sm-6 text-right">
                                                                    <div class="form-group form-inline float-right">
                                                                        <input type="number"  class="form-control text-center" min="0" name="hide_max_event_number" placeholder="0" style="width: 80px" :disabled="customize.displayRules.hide_max_event != 1">
                                                                        <input type="checkbox" name="hide_max_event" id="hide_max_event" data-toggle="toggle" value="1">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{--/Tab customize--}}

                                                {{--Tab launch--}}
                                                <div class="tab-pane fade" :class="{ 'active show': settings.step == 6}" id="v-pills-launch" role="tabpanel" aria-labelledby="v-pills-launch-tab">
                                                    <div class="card">
                                                        <div class="card-header lead">Identify Notification Name</div>
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <label for="msg_title">Name</label>
                                                                <input type="text" class="form-control" name="name" v-model="launch.name" @input="launch.name_error = this.value === null ? 'Name field is required.' : ''" placeholder="Enter notification name">
                                                                <span class="text-danger">@{{ launch.name_error }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                {{--/Tab launch--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <div class="notify-arrow-button float-right">
                                                        <button type="button" class="btn btn-lg btn-secondary" v-show="settings.show_previous_button" @click="previousStep">PREVIOUS</button>
                                                        <button :type="settings.step == 6 && launch.name != '' ? 'submit' : 'button'"  class="btn btn-lg btn-info" v-show="settings.show_next_button" @click="nextStep">@{{ settings.step == 6 ? 'LAUNCH' : 'NEXT' }}</button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="notification-preview-box" class="box_shadow" :style="{ 'background-color': customize.design.notify_box_color }" v-if="settings.step == 4 || settings.step == 5">
            <div class="notification-preview-img-box">
                <img src="https://cdn.ninjatoolkit.com/icon.gif" title="Icon" />
            </div>
            <div class="notification-preview-alert-box">
                <p :style="{ color: customize.design.notify_title_color, 'background-color': customize.design.notify_title_bg_color  }">50 @{{ message.msg_title ? message.msg_title : 'Visitors' }}</p>
                <p :style="{ color: customize.design.notify_text_color }">@{{ message.msg_text ? message.msg_text : 'signed up for NinjaToolkit' }}</p>
                <p :style="{ color: customize.design.notify_text_color  }"><span>@{{ message.locale_time }}</span><span>⚡ by <a href="https://ninjatoolkit.com/" target="_blank">NinjaToolkit</a></span></p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <script src="/js/color-picker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script src="/js/create-notification.js"></script>

@endsection

