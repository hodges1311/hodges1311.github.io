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

	<body>
	<?php

	$nameErr = $emailErr = $infoErr = "";
	$name = $email = $body = "";

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
				$nameErr = "Only letters and white space allowed for Name";
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

		if(empty($_POST["body"]))
		{
			$infoErr = "Message is required";
		}
		else
		{
			$body = test_input($_POST["body"]);
			if (!preg_match("/^[a-zA-Z\d \' \. \, \" \: \; \? \- \! \s ]*$/",$body) || strlen($body) < 1)
			{
				$infoErr = "Message must only contain alphanumerical characters and punctuation";
			}
		}







		$servername = "localhost"; //local machine, the port on which the mySQL server runs on
		$username = "root"; //default is root
		$serverpassword= ""; //default is none
		$databasename = "mysql";

		$conn = new mysqli($servername, $username, $serverpassword, $databasename); //creates the connection

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}


		if($nameErr == "" && $emailErr == "" && $infoErr == ""){
			$sql = "INSERT INTO contactUs (Name,	Email, Body) VALUES ('$name', '$email', '$body')"; //Queries must be in string format
			$result = mysqli_query($conn, $sql); //does your query
			if ($result) { //checks your query
				echo "New record created successfully";
				header("Location: success2.php");
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
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
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
				<section id="main" class="container 75%">
				<header>
					<h2>Contact Us</h2>
					<p>Have an issue taking off? Please let us know below! We will respond as quickly as possible.</p>
				</header>
					<div class="box">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="row uniform 50%">
								<div class="12u <?php if($emailErr != "") echo 'tooltip'; ?>">
									Email
									<input id="<?php if($emailErr != "") echo 'error'; ?>" type="text" name="email" id="email" value="<?php echo $email ?>" placeholder="Email">
									<?php if($emailErr != "") echo '<span class="tooltiptext">'.$emailErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u <?php if($nameErr != "") echo 'tooltip'; ?>">
									Name
									<input id="<?php if($nameErr != "") echo 'error'; ?>" type="text" name="name" id="name" value="<?php echo $name?>" placeholder="Name">
									<?php if($nameErr != "") echo '<span  class="tooltiptext">'.$nameErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u <?php if($infoErr != "") echo 'tooltip'; ?>">
									Message
									<textarea style="height:300" id="<?php if($infoErr != "") echo 'error'; ?>" name="body" id="body" value="<?php echo $body?>" placeholder="Enter message..."></textarea>
									<?php if($infoErr != "") echo '<span  class="tooltiptext">'.$infoErr.'</span>';?>
								</div>
							</div>
							<p id="field">*All Fields Required</p>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Contact Us"></li>
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

<?php

/**
 * States Dropdown
 *
 * @uses check_select
 * @param string $post, the one to make "selected"
 * @param string $type, by default it shows abbreviations. 'abbrev', 'name' or 'mixed'
 * @return string
 */





?>
