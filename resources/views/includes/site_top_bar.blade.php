@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <a href="{{ url('sites/' . $site->id . 'notification/new') }}" class="float-right btn submit-button">New notification</a>

        <h1>{{ $site->name }}</h1>
        <h3>{{ $site->url }}</h3>
    </div>
</div>
@include('includes.tab-menu')
