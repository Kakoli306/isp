<!doctype html>
<html class="fixed">

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.1.1/layouts-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Aug 2018 11:36:35 GMT -->
<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<title>@yield('title')</title>


	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<link rel="shortcut icon" href="{{asset('image/icone.ico')}}" type="image/x-icon">
	<!-- Vendor CSS -->
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/animate/animate.css">

	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/font-awesome/css/fontawesome-all.min.css" />
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/jquery-ui/jquery-ui.css" />
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/jquery-ui/jquery-ui.theme.css" />
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="{{asset('superadmin/')}}/vendor/morris/morris.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{asset('superadmin/')}}/css/theme.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="{{asset('superadmin/')}}/css/custom.css">

	<!-- Head Libs -->
	<script src="{{asset('superadmin/')}}/vendor/modernizr/modernizr.js"></script>
	<script src="{{asset('superadmin/')}}/master/style-switcher/style.switcher.localstorage.js"></script>

</head>
<body>

<!-- end: header -->
@include('superadmin.includes.header')
@include('superadmin.includes.sidebar')

@yield('content')


@include('superadmin.includes.aside')

<!-- Vendor -->
<script src="{{asset('superadmin/')}}/vendor/jquery/jquery.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-cookie/jquery-cookie.js"></script>
<script src="{{asset('superadmin/')}}/master/style-switcher/style.switcher.js"></script>
<script src="{{asset('superadmin/')}}/vendor/popper/umd/popper.min.js"></script>
<script src="{{asset('superadmin/')}}/vendor/bootstrap/js/bootstrap.js"></script>
<script src="{{asset('superadmin/')}}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{asset('superadmin/')}}/vendor/common/common.js"></script>
<script src="{{asset('superadmin/')}}/vendor/nanoscroller/nanoscroller.js"></script>
<script src="{{asset('superadmin/')}}/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Specific Page Vendor -->

<script src="{{asset('superadmin/')}}/vendor/jquery-ui/jquery-ui.js">
</script>		<script src="{{asset('superadmin/')}}/vendor/jqueryui-touch-punch/jqueryui-touch-punch.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-appear/jquery-appear.js"></script>
<script src="{{asset('superadmin/')}}/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="{{asset('superadmin/')}}/vendor/flot/jquery.flot.js"></script>
<script src="{{asset('superadmin/')}}/vendor/flot.tooltip/flot.tooltip.js"></script>
<script src="{{asset('superadmin/')}}/vendor/flot/jquery.flot.pie.js"></script>
<script src="{{asset('superadmin/')}}/vendor/flot/jquery.flot.categories.js"></script>
<script src="{{asset('superadmin/')}}/vendor/flot/jquery.flot.resize.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-sparkline/jquery-sparkline.js"></script>
<script src="{{asset('superadmin/')}}/vendor/raphael/raphael.js"></script>
<script src="{{asset('superadmin/')}}/vendor/morris/morris.js"></script>
<script src="{{asset('superadmin/')}}/vendor/gauge/gauge.js"></script>
<script src="{{asset('superadmin/')}}/vendor/snap.svg/snap.svg.js"></script>
<script src="{{asset('superadmin/')}}/vendor/liquid-meter/liquid.meter.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/jquery.vmap.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>

<!-- Vendor -->
<script src="{{asset('superadmin/')}}/vendor/jquery/jquery.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-cookie/jquery-cookie.js"></script>
<script src="{{asset('superadmin/')}}/master/style-switcher/style.switcher.js"></script>
<script src="{{asset('superadmin/')}}/vendor/popper/umd/popper.min.js"></script>
<script src="{{asset('superadmin/')}}/vendor/bootstrap/js/bootstrap.js"></script>
<script src="{{asset('superadmin/')}}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="{{asset('superadmin/')}}/vendor/common/common.js"></script>
<script src="{{asset('superadmin/')}}/vendor/nanoscroller/nanoscroller.js"></script>
<script src="{{asset('superadmin/')}}/vendor/magnific-popup/jquery.magnific-popup.js"></script>
<script src="{{asset('superadmin/')}}/vendor/jquery-placeholder/jquery-placeholder.js"></script>

<!-- Specific Page Vendor -->		<script src="{{asset('superadmin/')}}/vendor/jquery-validation/jquery.validate.js"></script>
<script src="{{asset('superadmin/')}}/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script src="{{asset('superadmin/')}}/vendor/pnotify/pnotify.custom.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="{{asset('superadmin/')}}/js/theme.js"></script>

<!-- Theme Custom -->
<script src="{{asset('superadmin/')}}/js/custom.js"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('superadmin/')}}/js/theme.init.js"></script>
<!-- Analytics to Track Preview Website -->		<script>		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)		  })(window,document,'script','../../../www.google-analytics.com/analytics.js','ga');		  ga('create', 'UA-42715764-8', 'auto');		  ga('send', 'pageview');		</script>
<!-- Examples -->
<script src="{{asset('superadmin/')}}/js/examples/examples.wizard.js"></script>



</body>

<!-- Mirrored from preview.oklerthemes.com/porto-admin/2.1.1/layouts-default.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Aug 2018 11:36:35 GMT -->
</html>
