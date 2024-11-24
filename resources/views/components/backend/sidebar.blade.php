<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="img/profile_small.jpg" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">David Williams</span>
                        <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    AD+
                </div>
            </li>

            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" >
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" >
                <a href="{{ route('admin.categories.index') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Categories</span></a>
            </li>

            <li class="{{ request()->routeIs('admin.rooms.*') ? 'active' : '' }}" >
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Rooms Management</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse {{ request()->routeIs('admin.rooms.*') ? 'in' : '' }}">
                    {{-- <li class="{{ request()->routeIs('admin.rooms.setting') ? 'active' : '' }}"><a href="{{ route('admin.rooms.setting') }}">Setting</a></li> --}}
                    {{-- <li class="{{ request()->routeIs('admin.rooms.coupon') ? 'active' : '' }}"><a href="{{ route('admin.rooms.coupon') }}">Coupon</a></li> --}}
                    <li class="{{ request()->routeIs('admin.rooms.amenities.index') ? 'active' : '' }}"><a href="{{ route('admin.rooms.amenities.index') }}">Amenities</a></li>
                    {{-- <li class="{{ request()->routeIs('admin.rooms.index') ? 'active' : '' }}"><a href="{{ route('admin.rooms.index') }}">Rooms</a></li> --}}
                </ul>
            </li>

        </ul>

    </div>
</nav>
