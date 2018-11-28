@extends('spark::layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <h1 style="color:#6C38A0">Notification</h1>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <a href="/notifications/create" class="add-site btn-lg btn-block text-center">+ Add Notification</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row py-3 text-center">
                            @forelse($notifications as $notification)
                                <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12">
                                    <div class="card mx-3 my-3">
                                        <div class="card-header orange-header"><a href="/notifications/{{ $notification->id }}" class="white-link"><h5>{{ $notification->name }}</h5></a></div>
                                        <div class="card-body">
                                            <h6 class="card-subtitle mb-2">Name: {{ $notification->name }}</h6>
                                            <h6 class="card-subtitle mb-2 text-muted">Enabled: Yes</h6>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-12 text-center">No notifications currently setup. <a href="/notifications/create" style="color: #F16334;"><u>Add a notification to get started.</u></a></div>
                            @endforelse
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 text-center"><h1>0</h1> <span class="footer-fade">notifications shown</span></div>
                            <div class="col-md-4 text-center"><h1>{{ count($notifications) }}</h1> <span class="footer-fade">notification(s) added</span></div>
                            <div class="col-md-4 text-center"><h1>0</h1> <span class="footer-fade">unique visitors</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function confirmDelete(form, parentElement) {
            swal({
                title: 'Are you sure you want to delete?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.value) {
                    if (typeof parentElement !== 'undefined') {
                        $.post(form.action, $(form).serialize()).done(function (data) {
                            swal(
                                'Deleted!',
                                'Your record has been deleted.',
                                'success'
                            )
                            $(parentElement).remove();
                        }).fail(function (error) {
                            swal(
                                'Error!',
                                'Something is went wrong',
                                'error'
                            )
                        })
                    } else {
                        form.submit();
                        return true;
                    }

                    return false;
                } else {
                    return false;
                }
            })
        }

    </script>
@endsection
