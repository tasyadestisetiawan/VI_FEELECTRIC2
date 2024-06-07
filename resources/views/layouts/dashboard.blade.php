<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  {{-- Fix CSS Meta Security --}}
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

  <title>
    {{ $title }} - Feelectric | Coffee & Electric Bicycle
  </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('/frontend/img/favicon.svg') }}" rel="icon">
  <link href="{{ asset('/frontend/img/favicon.svg') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/@webpixels/css@1.1.5/dist/index.css">
  <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  {{-- DataTable --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">

  {{-- Custom CSS --}}
  <style>
    * {
      font-family: 'Inter', sans-serif !important;
      font-size: 16px !important;
    }

    .btn-primary-theme {
      background-color: #3B2621 !important;
      border: 2px solid #3B2621 !important;
      color: #ffffff;
      border-radius: 10px;
    }

    .btn-primary-theme:hover {
      background-color: #664238 !important;
      border: 2px solid #664238 !important;
      color: #ffffff;
    }

    .btn-edit-theme {
      background-color: #FFC107 !important;
      border: 2px solid #FFC107 !important;
      color: #000000;
      border-radius: 10px;
    }

    .btn-edit-theme:hover {
      background-color: #FFD649 !important;
      border: 2px solid #FFD649 !important;
      color: #000000;
    }

    .btn-delete-theme {
      background-color: #DC3545 !important;
      border: 2px solid #DC3545 !important;
      color: #ffffff;
      border-radius: 10px;
    }

    .btn-delete-theme:hover {
      background-color: #FF5B6C !important;
      border: 2px solid #FF5B6C !important;
      color: #ffffff;
    }

    .btn-detail-theme {
      background-color: #007BFF !important;
      border: 2px solid #007BFF !important;
      color: #ffffff;
      border-radius: 10px;
    }

    .btn-detail-theme:hover {
      background-color: #4D94FF !important;
      border: 2px solid #4D94FF !important;
      color: #ffffff;
    }

    /* Form Style */
    .form-control {
      border-radius: 10px;
      border: 2px solid #3B2621 !important;
    }

    form button {
      background-color: #3B2621 !important;
      border: 2px solid #3B2621 !important;
      border-radius: 10px;
    }

    form button:hover {
      background-color: #664238 !important;
      border: 2px solid #664238 !important;
    }

    .form-select {
      border-radius: 10px;
      border: 2px solid #3B2621 !important;
    }
  </style>

</head>

<body>

  <!-- Dashboard -->
  <div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">

    {{-- Navbar --}}
    @include('components.dashboard.navbar')

    <!-- Main content -->
    <div class="h-screen flex-grow-1 overflow-y-lg-auto">

      <!-- Header -->
      @include('components.dashboard.header')

      <!-- Main -->
      <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
          @yield('content')
        </div>
      </main>
    </div>
  </div>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('frontend/js/main.js') }}"></script>

  {{-- jQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  {{-- DataTable --}}
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
  <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
  <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

  <script>
    // DataTable Initialization
    $(document).ready(function() {
      $('#dataTable').DataTable({
        responsive: false,
        autoWidth: false,
        language: {
          search: "_INPUT_",
          searchPlaceholder: "Search...",
        },
      });
    });

  </script>

</body>

</html>