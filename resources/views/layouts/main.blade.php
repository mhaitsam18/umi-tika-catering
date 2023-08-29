<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Food order wizard with online payment">
	<meta name="author" content="UWS">
	<title>{{ $title }}</title>

	<!-- Favicon -->
	<link href="/assets-foodboard/img/favicon.png" rel="shortcut icon">

	<!-- Google Fonts - Jost -->
	<link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Font Awesome CSS -->
	<link href="/assets-foodboard/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom Font Icons -->
	<link href="/assets-foodboard/vendor/icomoon/css/iconfont.min.css" rel="stylesheet">

	<!-- Vendor CSS -->
	<link href="/assets-foodboard/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets-foodboard/vendor/dmenu/css/menu.css" rel="stylesheet">
	<link href="/assets-foodboard/vendor/hamburgers/css/hamburgers.min.css" rel="stylesheet">
	<link href="/assets-foodboard/vendor/mmenu/css/mmenu.min.css" rel="stylesheet">
	<link href="/assets-foodboard/vendor/magnific-popup/css/magnific-popup.css" rel="stylesheet">
	<link href="/assets-foodboard/vendor/float-labels/css/float-labels.min.css" rel="stylesheet">

	<!-- Main CSS -->
	<link href="/assets-foodboard/css/style.css" rel="stylesheet">
    @yield('style')

</head>

<body>

	<!-- Preloader -->
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- Preloader End -->

	<!-- Page -->
	<div id="page">
        @include('layouts.navbar')



		<!-- Main -->
		<main>
            @yield('content')
		</main>
		<!-- Main End -->

		<!-- Footer -->
		<footer class="main-footer">
			<div class="container">
				<div class="row">
					{{-- <div class="col-md-3">
						<h5 class="footer-heading">Menu Links</h5>
						<ul class="list-unstyled nav-links">
							<li><i class="fa fa-angle-right"></i> <a href="https://ultimatewebsolutions.net/foodboard/" class="footer-link">Home</a></li>
							<li><i class="fa fa-angle-right"></i> <a href="faq.html" class="footer-link">FAQ</a></li>
							<li><i class="fa fa-angle-right"></i> <a href="contacts.html" class="footer-link">Contacts</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<h5 class="footer-heading">Order Wizard</h5>
						<ul class="list-unstyled nav-links">
							<li><i class="fa fa-angle-right"></i> <a href="pay-with-card-online/" class="footer-link">Pay online</a></li>
							<li><i class="fa fa-angle-right"></i> <a href="pay-with-cash-on-delivery/" class="footer-link">Pay with cash on delivery</a></li>
						</ul>
					</div> --}}
					<div class="col-md-4">
						<h5 class="footer-heading">Kontak Kami</h5>
						<ul class="list-unstyled contact-links">
							<li><i class="icon icon-map-marker"></i><a href="https://goo.gl/maps/vKgGyZe2JSRLDnYH6" class="footer-link" target="_blank">Alamat: Jl. Adiaksa, Bandung, Indonesia</a>
							</li>
							<li><i class="icon icon-envelope3"></i><a href="mailto:info@yourdomain.com" class="footer-link">Email: info@umi-tika.com</a></li>
							<li><i class="icon icon-phone2"></i><a href="tel:+3630123456789" class="footer-link">Nomor WA: +3630123456789</a></li>
						</ul>
					</div>
					<div class="col-md-2">
						<h5 class="footer-heading">Temukan Kami</h5>
						<ul class="list-unstyled social-links">
							<li><a href="https://facebook.com" class="social-link" target="_blank"><i class="icon icon-facebook"></i></a></li>
							<li><a href="https://twitter.com" class="social-link" target="_blank"><i class="icon icon-twitter"></i></a></li>
							<li><a href="https://instagram.com" class="social-link" target="_blank"><i class="icon icon-instagram"></i></a></li>
							<li><a href="https://pinterest.com" class="social-link" target="_blank"><i class="icon icon-pinterest"></i></a></li>
						</ul>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-8">
						<ul id="subFooterLinks">
							<li><a href="https://themeforest.net/user/ultimatewebsolutions" target="_blank">With <i class="fa fa-heart pulse"></i> by Viona</a></li>
							{{-- <li><a href="pdf/terms.pdf" target="_blank">Terms and conditions</a></li> --}}
						</ul>
					</div>
					<div class="col-md-4">
						<div id="copy">© {{ date('Y') }} Umi Tika Catering</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- Footer End -->

	</div>
	<!-- Page End -->

	<!-- Back to top button -->
	<div id="toTop"><i class="icon icon-chevron-up"></i></div>
    @yield('modal')

	<!-- Vendor Javascript Files -->
	<script src="/assets-foodboard/vendor/jquery/jquery.min.js"></script>
	<script src="/assets-foodboard/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets-foodboard/vendor/easing/js/easing.min.js"></script>
	<script src="/assets-foodboard/vendor/parsley/js/parsley.min.js"></script>
	<script src="/assets-foodboard/vendor/nice-select/js/jquery.nice-select.min.js"></script>
	<script src="/assets-foodboard/vendor/price-format/js/jquery.priceformat.min.js"></script>
	<script src="/assets-foodboard/vendor/theia-sticky-sidebar/js/ResizeSensor.min.js"></script>
	<script src="/assets-foodboard/vendor/theia-sticky-sidebar/js/theia-sticky-sidebar.min.js"></script>
	<script src="/assets-foodboard/vendor/mmenu/js/mmenu.min.js"></script>
	<script src="/assets-foodboard/vendor/magnific-popup/js/jquery.magnific-popup.min.js"></script>
	<script src="/assets-foodboard/vendor/float-labels/js/float-labels.min.js"></script>
	<script src="/assets-foodboard/vendor/jquery-wizard/js/jquery-ui-1.8.22.min.js"></script>
	<script src="/assets-foodboard/vendor/jquery-wizard/js/jquery.wizard.js"></script>
	<script src="/assets-foodboard/vendor/isotope/js/isotope.pkgd.min.js"></script>
	<script src="/assets-foodboard/vendor/scrollreveal/js/scrollreveal.min.js"></script>
	<script src="/assets-foodboard/vendor/lazyload/js/lazyload.min.js"></script>
	<script src="/assets-foodboard/vendor/sticky-kit/js/sticky-kit.min.js"></script>

	<!-- Main Javascript File -->
	<script src="/assets-foodboard/js/scripts.js"></script>
    @yield('script')

</body>

</html>