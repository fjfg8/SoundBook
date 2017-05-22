<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>SoundBook</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="css/flexslider.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/line-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/elegant-icons.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/lightbox.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/theme-1.css" rel="stylesheet" type="text/css" media="all"/>
        <link href="css/custom.css" rel="stylesheet" type="text/css" media="all"/>
        <!--[if gte IE 9]>
        	<link rel="stylesheet" type="text/css" href="css/ie9.css" />
		<![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700' rel='stylesheet' type='text/css'>
        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <link href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic" rel="stylesheet" type="text/css">
        <link href="css/font-helvetica.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="loader">
    		<div class="spinner">
			  <div class="double-bounce1"></div>
			  <div class="double-bounce2"></div>
			</div>
    	</div>

        <div class="nav-container">
			<nav class="centered-logo top-bar">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<a href="/index">
							<img class="logo logo-dark" alt="Logo" src="logo.png">
						</div>
						<div class="col-sm-12">
							<a href="/login" class="btn btn-primary pull-right">Login</a>
						</div>
					</div>
					<div class="row nav-menu">
					
						<div class="col-sm-12 columns text-center">
							<ul class="menu">
								<a></a><li><a href="/index" target="_self">Home</a></li><li><a href="/features" target="_self">Features</a></li><li><a href="/testimonials" target="_self">Equipo</a></li><li><a href="/contact" target="_self">Contacto</a></li>		
							</ul>
						</div>
					</div>
					
					<div class="mobile-toggle">
						<i class="icon icon_menu"></i>
					</div>
				</div>
				<div class="bottom-border"></div>
			</nav>
		</div>

        @yield('body')

        <div class="footer-container">
			<footer class="social bg-secondary-1">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 text-center">
							<h1 class="text-white">Contacta con nosotros sin compromiso</h1>
							<a href="#" class="text-white"><strong>contact@soundbook.com</strong></a><br>
							<ul class="social-icons">
								<li>
									<a href="#">
										<i class="icon social_twitter"></i>
									</a>
								</li>
								
								<li>
									<a href="#">
										<i class="icon social_facebook"></i>
									</a>
								</li>
								
								<li>
									<a href="#">
										<i class="icon social_instagram"></i>
									</a>
								</li>
								
								<li>
									<a href="#">
										<i class="icon social_dribbble"></i>
									</a>
								</li>
								
								<li>
									<a href="#">
										<i class="icon social_tumblr"></i>
									</a>
								</li>
								
								<li>
									<a href="#">
										<i class="icon social_pinterest"></i>
									</a>
								</li>
							</ul><br>
							<span class="sub">© Copright 2017 SoundBook DSS. All Rights Reserved.</span>
						</div>
					</div>
				</div>
			</footer>
		</div>

        <script src="https://www.youtube.com/iframe_api"></script>
		<script src="js/jquery.min.js"></script>
        <script src="js/jquery.plugin.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.flexslider-min.js"></script>
        <script src="js/smooth-scroll.min.js"></script>
        <script src="js/skrollr.min.js"></script>
        <script src="js/spectragram.min.js"></script>
        <script src="js/scrollReveal.min.js"></script>
        <script src="js/isotope.min.js"></script>
        <script src="js/twitterFetcher_v10_min.js"></script>
        <script src="js/lightbox.min.js"></script>
        <script src="js/jquery.countdown.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>