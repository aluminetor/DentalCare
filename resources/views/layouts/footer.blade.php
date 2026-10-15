<footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-6 footer-about">
          <a href="{{ route('home.index') }}" class="logo d-flex align-items-center">
            <span class="sitename">DentalCare</span>
          </a>
          <p class="pt-3">Atención odontológica integral y de confianza para toda la familia.</p>
          <div class="footer-contact pt-2">
            <p>Calle Principal #10-20, Consultorio 301, Bogotá, Colombia</p>
            <p class="mt-3"><strong>Teléfono:</strong> <span>+57 300 123 4567</span></p>
            <p><strong>Correo:</strong> <span>citas@dentalcare.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Enlaces útiles</h4>
          <ul>
            <li><a href="{{ route('home.index') }}">Inicio</a></li>
            <li><a href="{{ Route::has('citas.index') ? route('citas.index') : '#' }}">Citas</a></li>
            <li><a href="{{ Route::has('pacientes.index') ? route('pacientes.index') : '#' }}">Pacientes</a></li>
            <li><a href="{{ url('/#odontologos') }}">Odontólogos</a></li>
            <li><a href="#">Iniciar sesión</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Servicios odontológicos</h4>
          <ul>
            <li><a href="{{ url('/#tratamientos') }}">Odontología general</a></li>
            <li><a href="{{ url('/#tratamientos') }}">Ortodoncia</a></li>
            <li><a href="{{ url('/#tratamientos') }}">Endodoncia</a></li>
            <li><a href="{{ url('/#tratamientos') }}">Limpieza y prevención</a></li>
            <li><a href="{{ url('/#tratamientos') }}">Diseño de sonrisa</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
  <p>
    © 2026
    <strong class="px-1 sitename">DentalCare</strong>
    <span>Todos los derechos reservados.</span>
  </p>

  <p class="mb-0">
    Sistema de gestión para clínica odontológica.
  </p>
</div>

  </footer>
