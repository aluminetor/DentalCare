<footer id="footer" class="footer light-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-6 footer-about">
          <a href="{{ route('home.index') }}" class="logo d-flex align-items-center">
            <span class="sitename">DentalCare</span>
          </a>
          <p class="pt-3">Comprehensive and trusted dental care for the whole family.</p>
          <div class="footer-contact pt-2">
            <p>Main Street #10-20, Suite 301, Bogota, Colombia</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+57 300 123 4567</span></p>
            <p><strong>Email:</strong> <span>appointments@dentalcare.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="{{ route('home.index') }}">Home</a></li>
            <li><a href="{{ Route::has('appointments.index') ? route('appointments.index') : '#' }}">Appointments</a></li>
            <li><a href="{{ Route::has('patients.index') ? route('patients.index') : '#' }}">Patients</a></li>
            <li><a href="{{ url('/#dentists') }}">Dentists</a></li>
            <li><a href="{{ route('login') }}">Log In</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-links">
          <h4>Dental Services</h4>
          <ul>
            <li><a href="{{ url('/#treatments') }}">General Dentistry</a></li>
            <li><a href="{{ url('/#treatments') }}">Orthodontics</a></li>
            <li><a href="{{ url('/#treatments') }}">Endodontics</a></li>
            <li><a href="{{ url('/#treatments') }}">Cleaning and Prevention</a></li>
            <li><a href="{{ url('/#treatments') }}">Smile Design</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
  <p>
    © 2026
    <strong class="px-1 sitename">DentalCare</strong>
    <span>All Rights Reserved.</span>
  </p>

  <p class="mb-0">
    Dental clinic management system.
  </p>
</div>

  </footer>
