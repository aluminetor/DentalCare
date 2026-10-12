@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="Clínica DentalCare">
          <div class="container">
            <h2>Bienvenidos a DentalCare</h2>
            <p>Atención odontológica integral y especializada para toda la familia.</p>
            <a href="#citas" class="btn-get-started">Agendar Cita</a>
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
              <h4><a href="#tratamientos" class="stretched-link">Limpieza Dental</a></h4>
              <p>Higiene profesional para una sonrisa sana y protegida.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-teeth-open icon"></i></div>
              <h4><a href="#tratamientos" class="stretched-link">Ortodoncia</a></h4>
              <p>Corrección de la alineación dental con brackets y alineadores.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-tooth icon"></i></div>
              <h4><a href="#tratamientos" class="stretched-link">Endodoncia</a></h4>
              <p>Tratamiento de conducto para salvar tus dientes naturales.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><i class="fas fa-smile icon"></i></div>
              <h4><a href="#tratamientos" class="stretched-link">Estética Dental</a></h4>
              <p>Blanqueamiento y diseño de sonrisa a tu medida.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Nosotros<br></h2>
        <p>Cuidamos tu salud bucal con tecnología moderna y trato humano</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="Nuestra clínica">
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Tu sonrisa en manos de especialistas.</h3>
            <p class="fst-italic">
              Clínica odontológica enfocada en prevención, diagnóstico y tratamiento integral.
            </p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Odontólogos certificados en cada especialidad.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Historias clínicas digitales y seguimiento por paciente.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Agenda de citas ordenada y recordatorios oportunos.</span></li>
            </ul>
            <p>
              En DentalCare priorizamos la prevención y la atención personalizada para toda la familia.
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
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalOdontologos ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Odontólogos</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="far fa-smile flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalPacientes ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Pacientes</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-calendar-check flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $totalCitasAtendidas ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Citas atendidas</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fas fa-award flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter"></span>
                <p>Años de experiencia</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Services Section -->
    <section id="tratamientos" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tratamientos</h2>
        <p>Servicios odontológicos esenciales para tu salud bucal</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-tooth"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Limpieza Dental</h3>
              </a>
              <p>Profilaxis e higiene profesional para prevenir caries y enfermedad periodontal.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-teeth-open"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Ortodoncia</h3>
              </a>
              <p>Alineación dental con brackets metálicos, estéticos o alineadores.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-syringe"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Endodoncia</h3>
              </a>
              <p>Tratamiento de conducto para conservar dientes con daño pulpar.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-smile"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Estética Dental</h3>
              </a>
              <p>Blanqueamiento, carillas y diseño de sonrisa personalizado.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-tooth"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Implantes</h3>
              </a>
              <p>Reemplazo fijo y funcional de piezas dentales perdidas.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
                <i class="fas fa-child"></i>
              </div>
              <a href="#" class="stretched-link">
                <h3>Odontopediatría</h3>
              </a>
              <p>Atención dental especializada para niños y adolescentes.</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Appointment Section -->
    <section id="citas" class="appointment section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Agendar Cita</h2>
        <p>Reserva tu consulta odontológica en pocos pasos</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="#" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-4 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Tu nombre" required="">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Tu correo" required="">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="Tu teléfono" required="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 form-group mt-3">
              <input type="datetime-local" name="date" class="form-control datepicker" id="date" placeholder="Fecha de la cita" required="">
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="department" id="department" class="form-select" required="">
                <option value="">Seleccionar tratamiento</option>
                <option value="limpieza">Limpieza dental</option>
                <option value="ortodoncia">Ortodoncia</option>
                <option value="endodoncia">Endodoncia</option>
              </select>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="doctor" id="doctor" class="form-select" required="">
                <option value="">Seleccionar odontólogo</option>
                <option value="doctor-1">Odontólogo 1</option>
                <option value="doctor-2">Odontólogo 2</option>
                <option value="doctor-3">Odontólogo 3</option>
              </select>
            </div>
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Motivo de la consulta (opcional)"></textarea>
          </div>
          <div class="mt-3">
            <div class="text-center"><button type="submit">Agendar Cita</button></div>
          </div>
        </form>

      </div>

    </section><!-- /Appointment Section -->

    <!-- Doctors Section -->
    <section id="odontologos" class="doctors section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Odontólogos</h2>
        <p>Especialistas comprometidos con tu sonrisa</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-1.jpg" class="img-fluid" alt="Odontólogo">
              </div>
              <div class="member-info">
                <h4>Dr. Carlos Ruiz</h4>
                <span>Ortodoncia</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-2.jpg" class="img-fluid" alt="Odontóloga">
              </div>
              <div class="member-info">
                <h4>Dra. Laura Gómez</h4>
                <span>Endodoncia</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-3.jpg" class="img-fluid" alt="Odontólogo">
              </div>
              <div class="member-info">
                <h4>Dr. Andrés Torres</h4>
                <span>Implantología</span>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member">
              <div class="member-img">
                <img src="assets/img/doctors/doctors-4.jpg" class="img-fluid" alt="Odontóloga">
              </div>
              <div class="member-info">
                <h4>Dra. Ana Martínez</h4>
                <span>Odontopediatría</span>
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
        <h2>Contacto</h2>
        <p>Visítanos o escríbenos para agendar tu valoración</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Dirección</h3>
                  <p>Calle 123 #45-67, Bogotá, Colombia</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Llámanos</h3>
                  <p>+57 300 123 4567</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>Escríbenos</h3>
                  <p>contacto@dentalcare.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>

          <div class="col-lg-6">
            <form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Tu nombre" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Tu correo" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Asunto" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Mensaje" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit">Enviar Mensaje</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->


@endsection
