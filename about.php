<?php
session_start();
?>
<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>FlyBy</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/span.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>

<!-- Banner -->
	<section id="banner" style="padding: 10em 0 10em 0">
		<h2>FlyBy</h2>
		<p>Quality paper aircraft to conquer the skies</p>
	</section>

	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="index.php">FlyBy</h1>
					<nav id="nav">
						<ul>
							<?php if($_SESSION["user"] != "") echo '<li><a href="marketplace.php">MarketPlace</a></li>';?>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li><a href="contact.php">Contact Us</a></li>
							<?php if($_SESSION["user"] == "") echo '<li><a href="login.php" class="button">Log In</a></li>';?>
							<?php if($_SESSION["user"] == "") echo '<li><a href="signup.php" class="button">Sign Up</a></li>';?>
							<?php if($_SESSION["user"] != "") echo '<li><a href="myprofile.php" class ="button">My Profile</a></li>';?>
							<?php if($_SESSION["user"] != "") echo '<li><a href="signout.php" class ="button">Sign Out</a></li>';?>
						</ul>
					</nav>
				</header>


			<!-- Main -->
				<div>
				<section class="container">

					<section class="box special">
						<header class="major">
							<h2>What is FlyBy?
							</h2>
							<p>We offer a simple, easy-to-use platform for the buying and selling of paper
							aircraft designs. FlyBy strives to simultaneously protect our user's intellectual
							rights and to facilitate their product distribution. Just as our slogan suggests,
							we want to empower our users so that their creativity can take them to new heights
							and they can conquer the friendly skies.
							</p>
						</header>
						<span class="image featured">
							<span>
								<img class="resize" style="display: inline-block;" src="images/plane1.jpg" alt="">
							</span>
						</span>
					</section>
				</div>
				<div>
				<section class="container">

					<section class="box special">
						<header class="major">
							<h2>Our Mission Statement
							</h2>
							<p>Here at FlyBy, we want encourage creativity and community by allowing
							the continued creation of high quality paper planes. From enthusiasts to
							young children and passersby, FlyBy is meant to be accessible for everyone
							and tries to offer a wide variety of crafts</p>
						</header>
						<span class="image featured">
							<img align="middle" style="display: inline-block;" class="resize" src="images/plane2.jpg" alt="" />
						</span>
					</section>
				</div>

				<div>
				<section class="container">
					<section class="box special">
						<header class="major">
							<h2>Buying and Selling
							</h2>
							<p>All users are able to submit designs through our website and able to
							fully control their product's prices. Addtionally, by utilitizing our website
							we can assist you in protecting your intellectual rights.
							</p>
						</header>
						<span class="image featured">
							<img align="middle" style="display: inline-block;" class="resize" src="images/plane3.jpg" alt="" /></span>
					</section>
				</div>
			<!-- CTA -->
			<?php
			if($_SESSION["user"] == "") echo '
				<section id="cta" style="padding: 1em 0 1em 0;">
					<h2 style="margin: 0 0 0 0;">Sign up Here!</h2>
					<p style="margin: 0 0 1em 0;">Join our flying community.</p>
					<form>
						<ul class="actions">
							<li><a href="signup.php" class="button">Sign Up!</a></li>
						</ul>
					</form>
				</section>';
				else
					echo '<section id="cta" style="padding: 1em 0 1em 0;">
					<h2 style="margin: 0 0 0 0;">Visit the MarketPlace!</h2>
					<p style="margin: 0 0 1em 0;">View our Extensive Designs and Custom Made Paper to Help You Reach the Skies!</p>
					<form>
						<ul class="actions">
							<li><a href="marketplace.php" class="button">MarketPlace!</a></li>
						</ul>
					</form>
				</section>'
			?>
			<!-- Footer -->
				<footer id="footer" style="padding: 2em 0 2em 0">
					<ul class="copyright">
						<li>Contact us at: FlyByCorporate@gmail.com  OR  804-237-7321
						</li>
						<li>&copy; FlyBy. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
