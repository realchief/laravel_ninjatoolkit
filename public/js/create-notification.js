var notifyApp = new Vue({
    el: '#vue-element',
    data: {

        settings: {
            show_preloader: true,
            show_previous_button: false,
            show_next_button: false,
            step: 1,
        },

        /*Type*/
        type: {
            notification_type: '',
        },

        /*Track*/
        track: {
            track_format: 'simple',
            track_urls: '',
            simple_track_urls: '',
            expression_track_urls: '',
            invalid_track_url: false,
            urls: [],
            url_id: 0,
            show_track_error: false,
            add_track_url: '',
        },

        /*Display*/
        display: {
            display_format: 'simple',
            display_urls: '',
            simple_display_urls: '',
            expression_display_urls: '',
            invalid_display_url: false,
            urls: [],
            url_id: 0,
            show_display_error: false,
            add_display_url: '',
        },

        /*Message*/
        message: {
            msg_lang: 'en',
            msg_title: 'Visitors',
            msg_text: 'Visited our site',
            msg_img: 'https://cdn.ninjatoolkit.com/icon.gif',
            msg_title_error: '',
            msg_text_error: '',
            msg_img_error: '',
            locale_time: '',
            valid_step_four: true,
        },

        /*Design*/
        customize: {
            design: {
                notify_position: 'bl',
                notify_title_color: '#000000',
                notify_title_bg_color: '#FFFFFF',
                notify_text_color: '#000000',
                notify_box_color: '#FFFFFF',
                notify_box_design: 1
            },
            behavior: {
                notify_close_button: 0,
                notify_clickable: 0,
                notify_link: '',
                notify_new_tab: 0,
                notify_utm_params: 0,
                linkErrorMsg: '',
            },
            timeRules: {
                show_all_time_events: 0,
                hide_exact_time: 0,
                ignore_events: 0,
                ignore_time_type: 'minutes',
                ignore_time: null,
            },
            displayRules: {
                show_one_per_session: 0,
                hide_mobile: 0,
                min_display: null,
                display_time: null,
                hide_max_event: 0,
                hide_max_event_number: null
            }
        },

        /*Launch*/
        launch:{
            name: '',
            name_error: ''
        },

    },
    methods: {
        pageVisits: function () {
            this.settings.show_previous_button = true;
            this.settings.show_next_button = true;
            this.settings.step = 2;
            this.type.notification_type = 'page_visits';
        },
        previousStep: function () {
            this.settings.step = this.settings.step - 1;
            if(this.settings.step < 2){
                this.settings.show_previous_button = false;
                this.settings.show_next_button = false;
            }
        },
        nextStep: function () {
            switch (this.settings.step) {
                case 2:
                    if((this.track.track_format == 'simple' && this.track.simple_track_urls) || ((this.track.track_format == 'contains' || this.track.track_format == 'regex') && this.track.expression_track_urls) ){
                        this.track.show_track_error = false;
                        this.settings.step = 3;
                    }
                    else{
                        this.track.show_track_error = true;
                    }
                    break;
                case 3:
                    if((this.display.display_format == 'simple' && this.display.simple_display_urls) || ((this.display.display_format == 'contains' || this.display.display_format == 'regex') && this.display.expression_display_urls) || this.display.display_format == 'all' ){
                        this.display.show_display_error = false;
                        this.settings.step = 4;
                    }
                    else{
                        this.display.show_display_error = true;
                    }
                    break;
                case 4:
                    if(this.message.valid_step_four)
                        this.settings.step = 5;
                    break;
                case 6:
                    if(this.launch.name == '')
                        this.launch.name_error = 'Name field is required.';
                    else
                        this.launch.name_error = '';
                    break;
                default:
                    this.settings.step = this.settings.step + 1;

            }
        },

        /*Track*/
        trackType: function (v) {
            this.track.track_format = v;
            this.track.show_track_error = false;
        },
        getTrackTypeClass: function (v) {
            if(this.track.track_format == v){
                return {"btn-primary": true};
            }
            else{
                return {"btn-outline-primary": true};
            }
        },
        addTrackUrl: function () {
            if(this.checkValidURL(this.track.add_track_url)){
                this.track.invalid_track_url = false;
                this.track.url_id = this.track.url_id + 1;
                this.track.urls.push({id: this.track.url_id, url: this.track.add_track_url});

                var temp_track_urls = [];
                for(var i = 0; i < this.track.urls.length; i++){
                    temp_track_urls.push(this.track.urls[i].url);
                }
                this.track.simple_track_urls = JSON.stringify(temp_track_urls);
                this.track.add_track_url = '';
                this.track.show_track_error = false;
            }
            else{
                this.track.invalid_track_url = true;
            }
        },
        deleteTrackUrl: function (v) {
            for(var i = 0; i < this.track.urls.length; i++){
                if(this.track.urls[i].id == v) {
                    this.track.urls.splice(i, 1);
                    break;
                }
            }
            var temp_track_urls = [];
            for(var i = 0; i < this.track.urls.length; i++){
                temp_track_urls.push(this.track.urls[i].url);
            }
            if (temp_track_urls === undefined || temp_track_urls.length == 0)
                this.track.simple_track_urls = '';
            else
                this.track.simple_track_urls = JSON.stringify(temp_track_urls);

        },
        displayType: function (v) {
            this.display.display_format = v;
            this.display.show_display_error = false;
        },

        /*Display*/
        getDisplayTypeClass: function (v) {
            if(this.display.display_format == v){
                return {"btn-primary": true};
            }
            else{
                return {"btn-outline-primary": true};
            }
        },
        addDisplayUrl: function () {
            if(this.checkValidURL(this.display.add_display_url)){
                this.display.invalid_display_url = false;
                this.display.url_id = this.display.url_id + 1;
                this.display.urls.push({id: this.display.url_id, url: this.display.add_display_url});

                var temp_display_urls = [];
                for(var i = 0; i < this.display.urls.length; i++){
                    temp_display_urls.push(this.display.urls[i].url);
                }
                this.display.simple_display_urls = JSON.stringify(temp_display_urls);
                this.display.add_display_url = '';
                this.display.show_display_error = false;
            }
            else{
                this.display.invalid_display_url = true;
            }
        },
        deleteDisplayUrl: function (v) {
            for(var i = 0; i < this.display.urls.length; i++){
                if(this.display.urls[i].id == v) {
                    this.display.urls.splice(i, 1);
                    break;
                }
            }
            var temp_display_urls = [];
            for(var i = 0; i < this.display.urls.length; i++){
                temp_display_urls.push(this.display.urls[i].url);
            }

            if (temp_display_urls === undefined || temp_display_urls.length == 0)
                this.display.simple_display_urls = '';
            else
                this.display.simple_display_urls = JSON.stringify(temp_display_urls);
        },

        /*Message*/
        setLocale: function () {
            var now = new Date();
            moment.locale(this.message.msg_lang);
            this.message.locale_time = moment(moment(now).subtract(5, "minutes")).fromNow();
        },
        checkMsgTitle: function () {
            if(this.message.msg_title == ''){
                this.message.valid_step_four = false;
                this.message.msg_title_error = 'Please fill message title field.';
            }
            else{
                this.checkStepFourValidation();
                this.message.msg_title_error = '';
            }
        },
        checkMsgText: function () {
            if(this.message.msg_text == ''){
                this.message.valid_step_four = false;
                this.message.msg_text_error = 'Please fill message text field.';
            }
            else{
                this.checkStepFourValidation();
                this.message.msg_text_error = '';
            }
        },
        checkMsgImage: function () {
            if(this.checkValidURL(this.message.msg_img) && this.checkValidImageURL(this.message.msg_img)){
                this.checkStepFourValidation();
                this.message.msg_img_error = '';
            }
            else{
                this.message.valid_step_four = false;
                this.message.msg_img_error = 'Invalid image URL.';
            }
        },
        checkStepFourValidation: function () {
            if(this.message.msg_title_error == '' && this.message.msg_text_error == '' && this.message.msg_img_error == '')
                this.message.valid_step_four = true;
        },



        checkValidURL: function (v) {
            return /^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(v);
        },
        checkValidImageURL: function(v) {
            return(v.match(/\.(jpeg|jpg|gif|png)$/) != null);
        }


    },
    mounted: function () {
        this.settings.show_preloader = false;

        var now = new Date();
        moment.locale(this.message.msg_lang);
        this.message.locale_time = moment(moment(now).subtract(5, "minutes")).fromNow();
        // Jquery
        var _this = this;
        jQuery(document).ready(function($) {
            $('#notify_title_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 200,
                        maxTop: 200
                    },
                    hue: {
                        maxTop: 200
                    }
                }
            }).on('changeColor', function(e){
                _this.customize.design.notify_title_color = $(this).val();
            });
            $('#notify_title_bg_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 200,
                        maxTop: 200
                    },
                    hue: {
                        maxTop: 200
                    }
                }
            }).on('changeColor', function(e){
                _this.customize.design.notify_title_bg_color = $(this).val();
            });
            $('#notify_text_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 200,
                        maxTop: 200
                    },
                    hue: {
                        maxTop: 200
                    }
                }
            }).on('changeColor', function(e){
                _this.customize.design.notify_text_color = $(this).val();
            });
            $('#notify_box_color').colorpicker({
                customClass: 'colorpicker-2x',
                sliders: {
                    saturation: {
                        maxLeft: 200,
                        maxTop: 200
                    },
                    hue: {
                        maxTop: 200
                    }
                }
            }).on('changeColor', function(e){
                _this.customize.design.notify_box_color = $(this).val();
            });


            $('#notify_clickable').change(function() {
                if($(this).prop('checked')){
                    _this.customize.behavior.notify_clickable = 1;
                }
                else{
                    _this.customize.behavior.notify_clickable = 0;
                }
            });
            $('#ignore_events').change(function() {
                if($(this).prop('checked')){
                    _this.customize.timeRules.ignore_events = 1;
                }
                else{
                    _this.customize.timeRules.ignore_events = 0;
                }
            });
            $('#hide_max_event').change(function() {
                if($(this).prop('checked')){
                    _this.customize.displayRules.hide_max_event = 1;
                }
                else{
                    _this.customize.displayRules.hide_max_event = 0;
                }
            });

            $('[data-toggle="button-tooltip"]').tooltip();
        });
    }
});

