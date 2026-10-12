<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="d-none d-md-flex align-items-center">
          <i class="bi bi-clock me-1"></i> Lunes - Sábado, 8:00 AM a 8:00 PM
        </div>
        <div class="d-flex align-items-center">
          <i class="bi bi-phone me-1"></i> Llámanos +57 300 123 4567
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-end">
        <a href="{{ route('home.index') }}" class="logo d-flex align-items-center me-auto">
          <img src="{{ asset('assets/img/logo.png') }}" alt="DentalCare">
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="{{ route('home.index') }}" class="{{ request()->routeIs('home.*') ? 'active' : '' }}">Inicio</a></li>
            {{-- Cada enlace apunta a su módulo apenas exista la ruta (Route::has); mientras tanto queda en "#" --}}
            <li><a href="{{ Route::has('pacientes.index') ? route('pacientes.index') : '#' }}" class="{{ request()->routeIs('pacientes.*') ? 'active' : '' }}">Pacientes</a></li>
            <li><a href="{{ Route::has('citas.index') ? route('citas.index') : '#' }}" class="{{ request()->routeIs('citas.*') ? 'active' : '' }}">Citas</a></li>
            <li><a href="{{ Route::has('usuarios.index') ? route('usuarios.index') : '#' }}" class="{{ request()->routeIs('usuarios.*') ? 'active' : '' }}">Usuarios</a></li>
            <li><a href="{{ Route::has('roles.index') ? route('roles.index') : '#' }}" class="{{ request()->routeIs('roles.*') ? 'active' : '' }}">Roles</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn" href="{{ Route::has('citas.create') ? route('citas.create') : '#' }}">Agendar Cita</a>

      </div>

    </div>

  </header>
