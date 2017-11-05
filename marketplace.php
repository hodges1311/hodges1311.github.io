<?php
session_start();
?>
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
	<?php
	if($_SESSION["user"] == "")
	{
		$_SESSION["redirect"] = "marketplace";
		header("Location: login.php");
	}
	?>
<!-- Banner -->
	<section class= "box special" id="banner" style="padding: 5em 0 5em 0">
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
							<?php if($_SESSION["user"] != "") echo '<li><a href="myprofile.php" class ="button">Your Profile</a></li>';?>
							<?php if($_SESSION["user"] != "") echo '<li><a href="signout.php" class ="button">Sign Out</a></li>';?>
						</ul>
					</nav>
				</header>


			<!-- Main -->
				<section class="container">
					<div class="row">
						<div class="6u 12u(narrower)">
							<section class="box special">
								<span class="image featured"><img src="images/papers.jpeg" alt="" width="450" height="322"></span>
								<h3>Paper</h3>
								<p>This is our highest qualtiy construction paper for use in all of your crafting needs</p>
								<ul class="actions">
									<li>
										<form action="https://test.bitpay.com/checkout" method="post" >
											<input type="hidden" name="action" value="checkout" />
											<input type="hidden" name="posData" value="" />
											<input type="hidden" name="data" value="kZt1T4IINMspivqs+QHhhAq8cG0RoSdeuLtVpXz+aRka+Ve4Elc15SV5XK8a57LbZfG4Vju9kiSGJPYG2CFs3me9DORD4bWhQBZNjbM2+ZnId9IGh70nJTGB0+bq92+zmplvIR/XmALCOhBwxQdFSjGyEHJbjZCRX0DF7Ob8LZN+EzZ1iDzrCR38ooEZ2QKP" />
											<input type="image" src="https://test.bitpay.com/img/button-large.png" border="0" name="submit" alt="BitPay, the easy way to pay with bitcoins." >
										</form>
									</li>
								</ul>
							</section>
						</div>
					</div>
				</section>
	
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
