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
	<body>
	<?php
	$nameErr = $emailErr = $userErr = $addErr = $passErr = "";
	$name = $email = $user = $add = $city = $zip = $pass = $passc = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["name"]))
		{
			$nameErr = "Name is Required";
		}
		else
		{
			$name = test_input($_POST["name"]);
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
			{
				$nameErr = "Only letters and white space allowed"; 
			}
		}
		
		if (empty($_POST["email"])) 
		{
			$emailErr = "Email is required";
		} 	
		else 
		{
			$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			{
				$emailErr = "Invalid email format"; 
			}
		}
	}
	
	function test_input($data) 
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	?>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1><a href="index.html">FlyBy</h1>
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li>
								<a href="about.html">About Us</a>
							</li>
							<li><a href="login.html" class="button">Log In</a></li>
							<li><a href="#" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>


			<!-- Main -->
				<div>
				<section id="main" class="container 75%">
				<header>
					<h2>Sign Up</h2>
					<p>Join our flying club and start buying/selling today!</p>
				</header>
					<div class="box">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="row uniform 50%">
								<div class="6u 12u(mobilep)">
									<input type="text" name="username" id="username" value="" placeholder="Username">
								</div>
								<div class="6u 12u(mobilep)">
									<input type="email" name="email" id="email" value="" placeholder="Email">
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<input type="text" name="name" id="name" value="" placeholder="Name">
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<input type="text" name="address" id="address" value="" placeholder="Address">
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="6u 12u(mobilep)">
									<input type="text" name="city" id="city" value="" placeholder="City">
								</div>
								<div class="6u 12u(mobilep)">
									<input type="text" name="zip" id="zip" value="" placeholder="Zip-Code">
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u">
									<input type="password" name="password" id="password" value="" placeholder="Password">
								</div>
							</div>
														<div class="row uniform 50%">
								<div class="12u">
									<input type="password" name="passwordC" id="passwordC" value="" placeholder="Confirm Password">
								</div>
							</div>
							<p>
								*All Fields Required
							<?php
								if($nameErr != "")
								{
									echo "<br/>".$nameErr;
								}
								if($emailErr != "")
								{
									echo "<br/>".$emailErr;
								}
								if($userErr != "")
								{
									echo "<br/>".$userErr;
								}
								if($addErr != "")
								{
									echo "<br/>".$addErr;
								}
								if($passErr != "")
								{
									echo "<br/>".$passErr;
								}
							?>
							</p>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Sign Up"></li>
									</ul>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div>
				</div>

				<div>
				</div>	
			<!-- CTA -->
					
			<!-- Footer -->
				<footer id="footer">
					<ul class="copyright">
						<li>Contact us at: FlyBy@gmail.com  OR  804-237-7321
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
