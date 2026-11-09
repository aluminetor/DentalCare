<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="d-none d-md-flex align-items-center">
                <i class="bi bi-clock me-1"></i>
                Monday - Saturday, 8:00 AM to 8:00 PM
            </div>

            <div class="d-flex align-items-center">
                <i class="bi bi-phone me-1"></i>
                Call us +57 300 123 4567
            </div>
        </div>
    </div>

    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-end">

            <a href="{{ route('home.index') }}"
               class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo.png') }}" alt="DentalCare">
            </a>

            @auth
                @php
                    $user = Auth::user();
                    $permissionCodes = $user->role
                        ? $user->role->permissions->pluck('code')->all()
                        : [];

                    $hasPermission = fn ($code) =>
                        in_array($code, $permissionCodes, true);
                @endphp

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li>
                            <a href="{{ route('home.index') }}"
                               class="{{ request()->routeIs('home.*') ? 'active' : '' }}">
                                Home
                            </a>
                        </li>

                        @if ($hasPermission('patients.view'))
                            <li>
                                <a href="{{ route('patients.index') }}"
                                   class="{{ request()->routeIs('patients.*') ? 'active' : '' }}">
                                    Patients
                                </a>
                            </li>
                        @endif

                        @if ($hasPermission('appointments.view'))
                            <li>
                                <a href="{{ route('appointments.index') }}"
                                   class="{{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                                    Appointments
                                </a>
                            </li>
                        @endif

                        @if ($hasPermission('users.view') && Route::has('users.index'))
                            <li>
                                <a href="{{ route('users.index') }}"
                                   class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                                    Users
                                </a>
                            </li>
                        @endif

                        @if ($hasPermission('roles.view') && Route::has('roles.index'))
                            <li>
                                <a href="{{ route('roles.index') }}"
                                   class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                    Roles
                                </a>
                            </li>
                        @endif
                    </ul>

                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

                @if ($hasPermission('appointments.create'))
                    <a class="cta-btn me-2" href="{{ route('appointments.create') }}">
                        Book Appointment
                    </a>
                @endif

                <div class="d-flex align-items-center gap-2">
                    <span class="d-none d-lg-inline">
                        Hello, {{ $user->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Log Out
                        </button>
                    </form>
                </div>
            @endauth

        </div>
    </div>
</header>
