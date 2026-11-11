<!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js')}}"></script>

  <!-- Local libraries (jQuery and SweetAlert2) -->
  <script src="{{ asset('libs/jquery/jquery.js') }}"></script>
  <script src="{{ asset('libs/sweetalert2/sweetalert2.js') }}"></script>

  {{-- Flash success or error message set by the controller via Session::flash('message', [...]) --}}
  @if (session()->has('message'))
    <script>
      const message = @json(session('message'));

      Swal.fire({
        title: message.content,
        icon: message.type,
      });
    </script>
  @endif

  {{-- Validation errors (Validator::make(...)->validate()) --}}
  @if ($errors->any())
    <script>
      Swal.fire({
        title: "Please check the form",
        icon: "error",
        html: `<ul class="list-unstyled mb-0">@foreach ($errors->all() as $error)<li class="alert alert-danger py-1 my-1">{{ $error }}</li>@endforeach</ul>`,
      });
    </script>
  @endif
