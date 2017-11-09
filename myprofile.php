<?php
session_start();
if(!isset($_SESSION["user"]))
{
$_SESSION["redirect"] = "marketplace";
header("Location: login.php");
}

?>
<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #6358CB;
    color: white;
}
</style>

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


			<!-- Main -->
				<div>
				<section class="container">

					<section class="box special">
						<header class="major">
							<h2><?php echo "Welcome, {$_SESSION["user"]}!" ?>
							</h2>
							<p>This is your own Profile page, where you can edit your information, get FlyBy news, and keep up to date with your posts.
							Happy Flying!
							</p>
							<ul class="actions">
							<li><a href="update_profile.php" class="button">Edit My Profile</a></li>
							</ul>
						</header>
					</section>
				</div>
				<section class="container">
				<div>
				<?php
				$servername = "localhost"; //local machine, the port on which the mySQL server runs on
				$username = "root"; //default is root
				$serverpassword= ""; //default is none
				$databasename = "mysql";
	
				$conn = new mysqli($servername, $username, $serverpassword, $databasename); //creates the connection
	
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
	
				$user  ="SELECT * FROM `siteCustomers` WHERE `username` = '{$_SESSION["user"]}'";
				$result = mysqli_query($conn, $user);
				$row = mysqli_fetch_assoc($result);
				?>
				
				<table id="customers">
					  <tr>
						<th>User Name</th>
						<th><?php echo $_SESSION["user"]?></th>
					  </tr>
					  <tr>
						<td>Name</td>
						<td><?php echo $row["name"];?></td>
					  </tr>
					  <tr>
						<td>Email</td>
						<td><?php echo $row["email"];?></td>
					  </tr>
					  <tr>
						<td>Address</td>
						<td><?php echo $row["address"].", ".$row["city"].", ".$row["state"]." ".$row["zipcode"];?></td>
					  </tr>
				</table>
				</div>
				</section>
			<!-- CTA -->
			<?php
			if(!isset($_SESSION["user"])) echo '
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