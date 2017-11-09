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
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header" class="alt">
					<h1><a href="index.php">FlyBy</h1>
					<nav id="nav">
						<ul>
							<?php if(isset($_SESSION["user"])) echo '<li><a href="marketplace.php">MarketPlace</a></li>';?>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li><a href="contact.php">Contact Us</a></li>
							<?php if(!isset($_SESSION["user"])) echo '<li><a href="login.php" class="button">Log In</a></li>';?>
							<?php if(!isset($_SESSION["user"])) echo '<li><a href="signup.php" class="button">Sign Up</a></li>';?>
							<?php if(isset($_SESSION["user"])) echo '<li><a href="myprofile.php" class ="button">Your Profile</a></li>';?>
							<?php if(isset($_SESSION["user"])) echo '<li><a href="signout.php" class ="button">Sign Out</a></li>';?>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<h2>FlyBy</h2>
					<p>Quality paper aircraft to conquer the skies</p>
					<?php if(isset($_SESSION["user"])) echo '<p>Welcome Back, '.$_SESSION["name"].'!</p>';?>
					<ul class="actions">
						<?php if(!isset($_SESSION["user"])) echo '<li><a href="signup.php" class="button special">Sign Up</a></li>';?>
						<?php if(!isset($_SESSION["user"])) echo '<li><a href="about.php" class="button">About Us</a></li>';?>
						<?php if(isset($_SESSION["user"])) echo '<li><a href="myprofile.php" class ="button special">Your Profile</a></li>';?>
						<?php if(isset($_SESSION["user"])) echo '<li><a href="marketplace.php" class="button">MarketPlace</a></li>';?>
					</ul>
				</section>

			<!-- Main -->
				<section id="main" class="container">

					<section class="box special">
						<header class="major">
							<h2>Introducing the ultimate paper airplanes
							<br />
							for conquering the sky</h2>
							<p>These paper airplanes put the competition to shame. They fly faster, farther, and straighter than any of the competition</p>
						</header>
						<span class="image featured">
							<div style="height: 100%; overflow: hidden">
								<img alt="" src="images\toss.jpg" style="margin: -200px 0 0 0px;">
							</div>
						</span>
					</section>

					<section class="box special features">
						<div class="features-row">
							<section>
								<span id="paper"></span>
								<h3>The Paper</h3>
								<p>Paper has been a world fascination since its first inception. It has many uses from documentation, homework, paper sports, etc. However, our paper is used for something so much better: Paper Airplanes.</p>
							</section>
							<section>
								<span id="plane"></span>
								<h3>The Plane</h3>
								<p>Many people the strive to build and fly the best paper airplanes. We help support that. Our site contains many of the best paper airplane designs the world has known.</p>
							</section>
						</div>
						<div class="features-row">
							<section>
								<span id="serv"></span>
								<h3>The Service</h3>
								<p>We not only pride our selves in the designs we sell, but also in the community we have. If you sign up, we give you access to the best paper, paper more structurally stable for your flying needs, as well as the ability to sell your unique designs</p>
							</section>
							<section>
								<span id="dif"></span>
								<h3>The Difference</h3>
								<p>There are many sites and places where you can find varying paper airplane designs. However, what we provide is the best of the best in terms of designs as well as ones you can't find anywhere else. We give you step by step instructions and support and the ability to sell your own products. All supported by our unique, specially-made paper.</p>
							</section>
						</div>
					</section>

					<div class="row">
					<?php if(!isset($_SESSION["user"])) echo '
						<div class="6u 12u(narrower)">
							<section class="box special">
								<span class="image featured"><img src="images/plane2.jpg" alt="" width="450" height="322"></span>
								<h3>Already a Member?</h3>
								<p>Log in to view your account status and to get access to the market place.</p>
								<ul class="actions">
									<li><a href="login.php" class="button alt">Log In!</a></li>
								</ul>
							</section>
						</div>
						<div class="6u 12u(narrower)">
							<section class="box special">
								<span class="image featured"><img src="images/plane1.jpg" alt="" width="450" height="322"></span>
								<h3>New to the Site?</h3>
								<p>Become a member today and get access to our vast catalog.</p>
								<ul class="actions">
									<li><a href="signup.php" class="button alt">Sign Up!</a></li>
								</ul>
							</section>
						</div>';
					else
						echo '
						<div class="6u 12u(narrower)" style="height: 596.48px;">
							<section class="box special">
								<span class="image featured"><img src="images/papers.jpeg" alt="" width="450" height="322"></span>
								<h3>Buy our Quality Paper Here!</h3>
								<p>For Use in All of Your Crafting Needs. Price: .250 Bitcoin</p>
								<ul class="actions">
									<li>
										<form action="https://test.bitpay.com/checkout" method="post" style="margin: 0 0 0 0; padding: 0 0 10px 0;">
											<input type="hidden" name="action" value="checkout" />
											<input type="hidden" name="posData" value="" />
											<input type="hidden" name="data" value="kZt1T4IINMspivqs+QHhhAq8cG0RoSdeuLtVpXz+aRka+Ve4Elc15SV5XK8a57LbZfG4Vju9kiSGJPYG2CFs3me9DORD4bWhQBZNjbM2+ZnId9IGh70nJTGB0+bq92+zmplvIR/XmALCOhBwxQdFSjGyEHJbjZCRX0DF7Ob8LZN+EzZ1iDzrCR38ooEZ2QKP" />
											<input type="image" src="https://test.bitpay.com/img/button-medium.png" border="0" name="submit" alt="BitPay, the easy way to pay with bitcoins." >
										</form>
									</li>
								</ul>
							</section>
						</div>
						<div class="6u 12u(narrower)" style="height: 596.48px;">
							<section class="box special">
								<span class="image featured"><img src="images/plane1.jpg" alt="" width="450" height="322"></span>
								<h3>Visit our MarketPlace!</h3>
								<p>Where You Can Find the Paper Planes of Your Dreams!</p>
								<ul class="actions">
									<li style="padding: 0 1em 0 0;"><a href="marketplace.php" class="button alt">MarketPlace</a></li>
								</ul>
							</section>
						</div>'
					?>
					</div>

				</section>

			<!-- CTA -->
			<?php if(!isset($_SESSION["user"])) echo '
				<section id="cta" style="padding: 1em 0 1em 0;">
					<h2 style="margin: 0 0 0 0;">Want to know more?</h2>
					<p style="margin: 0 0 1em 0;">Read the About Us Section!</p>
					<form>
						<ul class="actions">
							<li><a href="about.php" class="button">About Us</a></li>
						</ul>
					</form>
				</section>';
				else
					echo '
				<section id="cta" style="padding: 1em 0 1em 0;">
					<h2 style="margin: 0 0 0 0;">Otherwise Check Out Your Profile!</h2>
					<p style="margin: 0 0 1em 0;">And Edit Any User Settings & Items That You Have Posted!</p>
					<form>
						<ul class="actions">
							<li><a href="myprofile.php" class="button">Your Profile</a></li>
						</ul>
					</form>
				</section>';
			?>
			<!-- Footer -->
				<footer id="footer" style="padding: 2em 0 2em 0">
					<ul class="copyright">
						<li>Contact us at: FlyByCorporate@gmail.com  OR  804-237-7321</li>
						<li>&copy; FlyBy. All rights reserved.
						</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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
