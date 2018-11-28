<div class="row py-3">
    <div class="col-md-12 text-center">
        <ul id="siteTabs" role="tablist" class="nav nav-tabs">
            <li class="nav-item">
                <a id="site-dashboard-tab" href="{{route('notifications',$site->id)}}" aria-selected="false"
                   class="nav-link {{ Route::currentRouteName()=='sites.show' ? 'active':'nav-inactive' }}">
                    Site Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a id="sources-tab" href="{{ url('/page-visits') }}" role="tab" aria-selected="true" class="nav-link  {{ request()->is('sites/*/page-visits/*') ? 'active' : 'nav-inactive' }}">
                    Page Visits
                </a>
            </li>

        </ul>
    </div>
</div>
