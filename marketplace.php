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
	if(!isset($_SESSION["user"]))
	{
		$_SESSION["redirect"] = "marketplace";
		header("Location: login.php");
	}
	
	$servername = "localhost"; //local machine, the port on which the mySQL server runs on
	$username = "root"; //default is root
	$serverpassword= ""; //default is none
	$databasename = "mysql";
	
	$conn = new mysqli($servername, $username, $serverpassword, $databasename); //creates the connection

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
	
	$sql = "SELECT * FROM marketplace"; //Queries must be in string format
	$result = mysqli_query($conn, $sql); //does your query

	mysqli_close($conn);
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,'https://api.coindesk.com/v1/bpi/currentprice.json');
	$temp = curl_exec($ch);

	$content = json_decode($temp, true);
	$rate = $content['bpi']['USD']['rate_float'];
	?>
<!-- Banner -->
	<section class= "box special" id="banner" style="padding: 5em 0 5em 0">
		<h2>FlyBy</h2>
		Quality paper aircraft to conquer the skies<br>
		<?php if(isset($_SESSION["user"])) echo '<a href="posting.php" class ="button">Post Your Product</a>';?>
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
				<section class="container">
					<div class="row">
					<?php
					$servername = "localhost"; //local machine, the port on which the mySQL server runs on
					$username = "root"; //default is root
					$serverpassword= ""; //default is none
					$databasename = "mysql";
					$conn = new mysqli($servername, $username, $serverpassword, $databasename); //creates the connection
					
					while($row = mysqli_fetch_assoc($result)) {
						$tobi = (float) (preg_replace('/[^A-Za-z0-9.\-]/', '', $row["price"]));
						$tobi2 = round($tobi / $rate, 7);
						echo'
						<div class="6u 12u(narrower)" style="height: 650px; width: 550px; padding: 0 0 690px 2em;">
							<section class="box special" style="height: 650px;">
								<span class="image featured"><img src="'.$row["imgsrc"].'" alt="" width="450" height="322"></span>
								<h3>'.$row["item"].'</h3>
								'.$row["des"].'<br>
								'.$row["price"].'<br>
								'.$tobi2.' BTC
								<ul class="actions">
									<li>
										<form action="https://test.bitpay.com/checkout" method="post" >
											<input type="hidden" name="action" value="checkout" />
											<input type="hidden" name="posData" value="" />
											<input type="hidden" name="data" value="'.$row["data"].'" />
											<input type="image" src="https://test.bitpay.com/img/button-large.png" border="0" name="submit" alt="BitPay, the easy way to pay with bitcoins." >
										</form>
									</li>
								</ul>
							</section>
						</div>';
					}
					mysqli_close($conn);
					?>
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
