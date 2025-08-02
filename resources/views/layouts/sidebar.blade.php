<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ request()->routeIs('parking-log') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('parking-log') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Parkir Log</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profile') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('guests') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('guests') }}">
                    <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Register
                        Guest</span>
                </a>
            </li>
    </div>
</nav>
