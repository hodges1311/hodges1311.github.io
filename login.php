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
		<title>FlyBy - Log in</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/span.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>

<?php
	$user = "";
	$passErr = "";
	$userErr = "";
	$mp = "";
	
	if($_SESSION["redirect"] != NULL)
		$mp = $_SESSION["redirect"];
	if($_SESSION["user"] != "")
		$mp = "signout";
	session_unset();
	$_SESSION["user"] = "";
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["username"]))
	{
		$userErr = "Username Required";
	}
	else
	{
		$user = test_input($_POST["username"]);
		if (!preg_match("/^[a-zA-Z0-9]*$/",$user))
		{
			$userErr = "Only letters & number allowed for Username";
		}
		if(strlen($user) > 20)
		{
			$userErr = "Username can only be 20 Characters Long";
		}
	}

	if(empty($_POST["pass"])) {
		$passErr = "Password Required";
	}
	elseif(strlen($_POST["pass"]) > 72) {
		$passErr = "Password Cannot be more than 72 Characters";
	}
	
	$servername = "localhost"; //local machine, the port on which the mySQL server runs on
	$username = "root"; //default is root
	$serverpassword= ""; //default is none
	$databasename = "mysql";
	
	$conn = new mysqli($servername, $username, $serverpassword, $databasename); //creates the connection
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
		
	$check  ="SELECT * FROM `siteCustomers` WHERE `username` = '{$user}'";
	$result = mysqli_query($conn, $check);
	
	if(mysqli_num_rows($result) >= 1){
		$userErr = "";
	}
	else
	{
		$userErr = "No user by that Name";
	}
		
	if($userErr == "" && $passErr == ""){
		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$temp = $row["password"];
			if(password_verify($_POST['pass'],$row["password"]))
			{
				$passErr = "";
				$_SESSION["user"] = $row["username"];
				header("Location: index.php");
			}
			else
			{
				$passErr = "Incorrect Password";
			}
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	mysqli_close($conn);
}

function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
	
	
<!-- Banner -->
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
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
				<div>
				<section id="main" class="container 75%">
				<header>
					<h2>Log in</h2>
					<p>Access your account to buy and sell the best planes around!</p>
					<?php if($mp == "marketplace") echo '<br><body>You must Login to View MarketPlace!</body>';?>
					<?php if($mp == "signout") echo '<br><body>You Have Been Signed Out.</body>';?>
				</header>
					<div class="box">
						<form method="post" action="#">
							<div class="row uniform 50%">
								<div class="12u <?php if($userErr != "") echo 'tooltip'; ?>">
									Username
									<input id="<?php if($userErr != "") echo 'error'; ?>" type="text" name="username" id="username" value="<?php echo $user?>" placeholder="Username">
									<?php if($userErr != "") echo '<span class="tooltiptext">'.$userErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u <?php if($passErr != "") echo 'tooltip'; ?>">
									Password
									<input id="<?php if($passErr != "") echo 'error'; ?>" type="password" name="pass" id="pass" value="" placeholder="Password">
									<?php if($passErr != "") echo '<span class="tooltiptext">'.$passErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Log In"></li>
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
