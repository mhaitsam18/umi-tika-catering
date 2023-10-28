<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Purchase: https://1.envato.market/nobleui_admin
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="Viona">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="/assets-nobleui/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/assets-nobleui/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="/assets-nobleui/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="/assets-nobleui/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="/assets-nobleui/css/demo1/style.css">
    <!-- End layout styles -->

    {{-- <link rel="shortcut icon" href="/assets-nobleui/images/favicon.png" /> --}}
    <link rel="shortcut icon" href="/assets-foodboard/img/favicon.png">
    @yield('style')
</head>

<body>
    <div class="main-wrapper">

        @include('layouts.admin-sidebar')
        <div class="page-wrapper">

            @include('layouts.admin-topbar')

            <div class="page-content">

                @yield('content')

            </div>

            <!-- partial:partials/_footer.html -->
            <footer
                class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="/" target="_blank">Umi Tika Catering</a>.
                </p>
                <p class="text-muted">Handcrafted By Viona With <i class="mb-1 text-primary ms-1 icon-sm"
                        data-feather="heart"></i></p>
            </footer>
            <!-- partial -->

        </div>
    </div>
    @yield('modal')

    <!-- core:js -->
    <script src="/assets-nobleui/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="/assets-nobleui/vendors/chartjs/Chart.min.js"></script>
    <script src="/assets-nobleui/vendors/jquery.flot/jquery.flot.js"></script>
    <script src="/assets-nobleui/vendors/jquery.flot/jquery.flot.resize.js"></script>
    <script src="/assets-nobleui/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/assets-nobleui/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="/assets-nobleui/vendors/feather-icons/feather.min.js"></script>
    <script src="/assets-nobleui/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="/assets-nobleui/js/dashboard-light.js"></script>
    <script src="/assets-nobleui/js/datepicker.js"></script>
    <!-- End custom js for this page -->
    @yield('script')
</body>

</html>
