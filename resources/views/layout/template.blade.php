<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/7fd926bad2.js" crossorigin="anonymous"></script>

</head>

<body>



    {{-- barre de navigation --}}
    @include('layout.menu')
    <!-- Main Content -->
    <main>
        @yield('contenu')

    </main>

    <!-- Footer -->

    @include('layout.footer')







    <!-- Back to Top Button -->
    <div class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </div>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        <div id="liveToast" class="toast align-items-center border-0 shadow-sm" role="alert" aria-live="assertive"
            aria-atomic="true" data-bs-delay="4000">
            <div class="d-flex align-items-center p-1">

                <div id="toastIcon" class="ms-2"
                    style="color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; flex-shrink: 0;">
                    !
                </div>

                <div id="toastBody" class="toast-body flex-grow-1">
                </div>

                <button type="button" class="btn-close ms-2 me-2" data-bs-dismiss="toast"
                    style="font-size: 0.6rem;"></button>
            </div>

            <div class="progress" style="height: 4px;">
                <div id="toastProgress" class="progress-bar" style="width: 100%;"></div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('asset/js/script.js') }}"></script>
    <script src="{{ asset('asset/js/recherche.js') }}"></script>


</body>

</html>
