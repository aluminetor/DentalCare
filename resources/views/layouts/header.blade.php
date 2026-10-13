<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="d-none d-md-flex align-items-center">
                <i class="bi bi-clock me-1"></i>
                Lunes - Sábado, 8:00 AM a 8:00 PM
            </div>

            <div class="d-flex align-items-center">
                <i class="bi bi-phone me-1"></i>
                Llámanos +57 300 123 4567
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
                    $usuario = Auth::user();
                    $codigosPermisos = $usuario->rol
                        ? $usuario->rol->permisos->pluck('codigo')->all()
                        : [];

                    $tienePermiso = fn ($codigo) =>
                        in_array($codigo, $codigosPermisos, true);
                @endphp

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li>
                            <a href="{{ route('home.index') }}"
                               class="{{ request()->routeIs('home.*') ? 'active' : '' }}">
                                Inicio
                            </a>
                        </li>

                        @if ($tienePermiso('pacientes.ver'))
                            <li>
                                <a href="{{ route('pacientes.index') }}"
                                   class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">
                                    Pacientes
                                </a>
                            </li>
                        @endif

                        @if ($tienePermiso('citas.ver'))
                            <li>
                                <a href="{{ route('citas.index') }}"
                                   class="{{ request()->routeIs('citas.*') ? 'active' : '' }}">
                                    Citas
                                </a>
                            </li>
                        @endif

                        @if ($tienePermiso('usuarios.ver') && Route::has('usuarios.index'))
                            <li>
                                <a href="{{ route('usuarios.index') }}"
                                   class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                                    Usuarios
                                </a>
                            </li>
                        @endif

                        @if ($tienePermiso('roles.ver') && Route::has('roles.index'))
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

                @if ($tienePermiso('citas.crear'))
                    <a class="cta-btn me-2" href="{{ route('citas.create') }}">
                        Agendar Cita
                    </a>
                @endif

                <div class="d-flex align-items-center gap-2">
                    <span class="d-none d-lg-inline">
                        Hola, {{ $usuario->name }}
                    </span>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            @endauth

        </div>
    </div>
</header>