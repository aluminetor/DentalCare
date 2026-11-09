@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="DentalCare Clinic">
          <div class="container">
            <h2>Welcome to DentalCare</h2>
            <p>Comprehensive and specialized dental care for the whole family.</p>
            <a href="#appointments" class="btn-get-started">Book Appointment</a>
          </div>
        </div><!-- End Carousel Item -->

        <ol class="carousel-indicators"></ol>

      </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-tooth icon"></i></div>
              <h4><a href="#treatments" class="stretched-link">Dental Cleaning</a></h4>
              <p>Professional hygiene for a healthy and protected smile.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-teeth-open icon"></i></div>
              <h4><a href="#treatments" class="stretched-link">Orthodontics</a></h4>
              <p>Dental alignment correction with braces and clear aligners.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-tooth icon"></i></div>
              <h4><a href="#treatments" class="stretched-link">Endodontics</a></h4>
              <p>Root canal treatment to preserve your natural teeth.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-smile icon"></i></div>
              <h4><a href="#treatments" class="stretched-link">Cosmetic Dentistry</a></h4>
              <p>Teeth whitening and custom smile design.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us<br></h2>
        <p>We care for your oral health with modern technology and a human touch</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="Our clinic">
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Your smile in the hands of specialists.</h3>
            <p class="fst-italic">
              Dental clinic focused on prevention, diagnosis, and comprehensive treatment.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Certified dentists in every specialty.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Digital medical records and patient follow-up.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Organized appointment scheduling and timely reminders.</span></li>
            </ul>
            <p>
              At DentalCare we prioritize prevention and personalized care for the whole family.
            </p>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-user-md flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalDentists ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Dentists</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="far fa-smile flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalPatients ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Patients</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-calendar-check flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalCompletedAppointments ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Completed Appointments</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-award flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
                <p>Years of Experience</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="treatments" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Treatments</h2>
        <p>Essential dental services for your oral health</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-tooth"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Dental Cleaning</h3>
              </a>
              <p>Prophylaxis and professional hygiene to prevent cavities and periodontal disease.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-teeth-open"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Orthodontics</h3>
              </a>
              <p>Dental alignment with metal braces, ceramic braces, or clear aligners.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-syringe"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Endodontics</h3>
              </a>
              <p>Root canal treatment to preserve teeth with pulp damage.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-smile"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Cosmetic Dentistry</h3>
              </a>
              <p>Teeth whitening, veneers, and personalized smile design.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-tooth"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Dental Implants</h3>
              </a>
              <p>Fixed and functional replacement for missing teeth.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-child"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Pediatric Dentistry</h3>
              </a>
              <p>Specialized dental care for children and adolescents.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Appointment Section -->
    <section id="appointments" class="appointment section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Book Appointment</h2>
        <p>Schedule your dental consultation in just a few steps</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="#" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-4 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group mt-3">
              <input type="datetime-local" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required="">
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="department" id="department" class="form-select" required="">
                <option value="">Select Treatment</option>
                <option value="cleaning">Dental Cleaning</option>
                <option value="orthodontics">Orthodontics</option>
                <option value="endodontics">Endodontics</option>
              </select>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="doctor" id="doctor" class="form-select" required="">
                <option value="">Select Dentist</option>
                <option value="doctor-1">Dentist 1</option>
                <option value="doctor-2">Dentist 2</option>
                <option value="doctor-3">Dentist 3</option>
              </select>
            </div>
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Reason for consultation (optional)"></textarea>
          </div>
          <div class="mt-3">
            <div class="text-center"><button type="submit">Book Appointment</button></div>
          </div>
        </form>

      </div>

    </section><!-- /Appointment Section -->

    <!-- Doctors Section -->
    <section id="dentists" class="doctors section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dentists</h2>
        <p>Specialists committed to your smile</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt="Dentist">
              </div>
              <div class="member-info">
                <h4>Dr. Charles Ruiz</h4>
                <span>Orthodontics</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt="Dentist">
              </div>
              <div class="member-info">
                <h4>Dr. Laura Gomez</h4>
                <span>Endodontics</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="Dentist">
              </div>
              <div class="member-info">
                <h4>Dr. Andrew Torres</h4>
                <span>Implantology</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-4.jpg" class="img-fluid" alt="Dentist">
              </div>
              <div class="member-info">
                <h4>Dr. Ana Martinez</h4>
                <span>Pediatric Dentistry</span>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Doctors Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Visit us or write to us to schedule your evaluation</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Street 123 #45-67, Bogota, Colombia</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+57 300 123 4567</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>contact@dentalcare.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-6">
            <form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->


@endsection
