<div class="main-header">
    <div class="logo-header">
        @php
            if (Auth::guard('web')->check()) {
                $route = route('admin.dashboard');
            } else {
                $route = route('recruiter.dashboard');
            }
        @endphp

        <a href="{{ $route }}" class="logo">
            <img src="{{ asset('assets/img/innerlogo.png') }}" alt="navbar brand" class="navbar-brand">
        </a>

        <button class="topbar-toggler more"><img src="{{ asset('assets/img/innerlogo.png') }}" alt="navbar brand"
                class="navbar-brand"></button>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
    </div>
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid" id="searchRight">
        </div>
    </nav>
</div>
