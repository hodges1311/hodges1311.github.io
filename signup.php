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
		
			$mp = "";
			if(isset($_SESSION["redirect"]))
				$mp = $_SESSION["redirect"];
			if(isset($_SESSION["user"]))
				$mp = "signout";
			session_unset();
			
			$mail = new PHPMailer;
			$mail->IsSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->Username = 'flybycorporate@gmail.com';
			$mail->Password = 'DummyPassword2';
			$mail->SMTPAuth = true;

			$nameErr = $emailErr = $userErr = $addErr = $cityErr = $stateErr = $zipErr = $passErr = "";
			$name = $email = $user = $add = $city = $zip = $state = $pass = $passc = "";

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

				if(empty($_POST["zip"]))
				{
					$zipErr = "Zip-Code is Required";
				}
				else
				{
					$zip = test_input($_POST["zip"]);
					if (!preg_match("/^[0-9]*$/",$zip) || strlen($zip) != 5)
					{
						$zipErr = "Only 5 digit number allowed for Zip-Code";
					}
				}

				if(empty($_POST["state"]))
				{
					$stateErr = "Choose a State";
				}
				else
				{
					$state = test_input($_POST["state"]);
				}

								if(empty($_POST["city"]))
				{
					$cityErr = "City is Required";
				}
				else
				{
					$city = test_input($_POST["city"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$city))
					{
						$cityErr = "Only letters and white space allowed for city";
					}
				}

				if(empty($_POST["address"]))
				{
					$addErr = "Address is Required";
				}
				else
				{
					$add = test_input($_POST["address"]);
					if (!preg_match("/^[a-zA-Z0-9 ]*$/",$add))
					{
						$addErr = "Only letters, numbers, & white space allowed for address";
					}
				}
				
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
				else {
					$pass = password_hash($_POST["pass"],PASSWORD_DEFAULT);
				}
				if(empty($_POST["passc"])){
					$passErr = "Password Required";
				}
				elseif(strlen($_POST["passc"]) > 72) {
					$passErr = "Password Cannot be more than 72 Characters";
				}
				else{
					$passc = password_hash($_POST["passc"],PASSWORD_DEFAULT);
				}
				if($passErr == "" && !password_verify($_POST["pass"],$passc) && !password_verify($_POST["passc"],$pass)){
					$passErr = "Passwords Do Not Match";
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
					<h2>Sign Up</h2>
					<p>Join our flying club and start buying/selling today!</p>
					<?php if($mp == "signout") echo '<br><body>You Have Been Signed Out.</body>';?>
				</header>
					<div class="box">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="row uniform 50%">
								<div class="6u 12u(mobilep) <?php if($userErr != "") echo 'tooltip'; ?>">
									Username
									<input id="<?php if($userErr != "") echo 'error'; ?>" type="text" name="username" id="username" value="<?php echo $user?>" placeholder="Username">
									<?php if($userErr != "") echo '<span class="tooltiptext">'.$userErr.'</span>';?>
								</div>
								<div class="6u 12u(mobilep) <?php if($emailErr != "") echo 'tooltip'; ?>">
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
								<div class="12u <?php if($addErr != "") echo 'tooltip'; ?>">
									Address
									<input id="<?php if($addErr != "") echo 'error'; ?>" type="text" name="address" id="address" value="<?php echo $add?>" placeholder="Address">
									<?php if($addErr != "") echo '<span  class="tooltiptext">'.$addErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="6u 12u(mobilep) <?php if($cityErr != "") echo 'tooltip'; ?>">
									City
									<input id="<?php if($cityErr != "") echo 'error'; ?>" type="text" name="city" id="city" value="<?php echo $city?>" placeholder="City">
									<?php if($cityErr != "") echo '<span class="tooltiptext">'.$cityErr.'</span>';?>
								</div>
								<div class="4u 12u(mobilep) <?php if($zipErr != "") echo 'tooltip'; ?>">
									Zip Code
									<input id="<?php if($zipErr != "") echo 'error'; ?>" type="text" name="zip" id="zip" value="<?php echo $zip?>" placeholder="Zip-Code">
									<?php if($zipErr != "") echo '<span class="tooltiptext">'.$zipErr.'</span>';?>
								</div>
								<div class="2u 12u(mobilep) <?php if($stateErr != "") echo 'tooltip'; ?>">
									State
									<select id="<?php if($stateErr != "") echo 'error'; ?>" name="state" id="state"><?php echo StateDropdown(null, 'abbrev', $state); ?></select>
									<?php if($stateErr != "") echo '<span class="tooltiptext">'.$stateErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u <?php if($passErr != "") echo 'tooltip'; ?>">
									Password
									<input id="<?php if($passErr != "") echo 'error'; ?>" type="password" name="pass" id="pass" value="" placeholder="Password">
									<?php if($passErr != "") echo '<span class="tooltiptext">'.$passErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u <?php if($passErr != "") echo 'tooltip'; ?>">
									Confirm Password
									<input id="<?php if($passErr != "") echo 'error'; ?>" type="password" name="passc" id="passc" value="" placeholder="Confirm Password">
									<?php if($passErr != "") echo '<span class="tooltiptext">'.$passErr.'</span>';?>
								</div>
							</div>
							<p id="field">*All Fields Required</p>
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
function StateDropdown($post=null, $type='abbrev', $stuff) {
	$states = array(
		array('AK', 'Alaska'),
		array('AL', 'Alabama'),
		array('AR', 'Arkansas'),
		array('AZ', 'Arizona'),
		array('CA', 'California'),
		array('CO', 'Colorado'),
		array('CT', 'Connecticut'),
		array('DC', 'District of Columbia'),
		array('DE', 'Delaware'),
		array('FL', 'Florida'),
		array('GA', 'Georgia'),
		array('HI', 'Hawaii'),
		array('IA', 'Iowa'),
		array('ID', 'Idaho'),
		array('IL', 'Illinois'),
		array('IN', 'Indiana'),
		array('KS', 'Kansas'),
		array('KY', 'Kentucky'),
		array('LA', 'Louisiana'),
		array('MA', 'Massachusetts'),
		array('MD', 'Maryland'),
		array('ME', 'Maine'),
		array('MI', 'Michigan'),
		array('MN', 'Minnesota'),
		array('MO', 'Missouri'),
		array('MS', 'Mississippi'),
		array('MT', 'Montana'),
		array('NC', 'North Carolina'),
		array('ND', 'North Dakota'),
		array('NE', 'Nebraska'),
		array('NH', 'New Hampshire'),
		array('NJ', 'New Jersey'),
		array('NM', 'New Mexico'),
		array('NV', 'Nevada'),
		array('NY', 'New York'),
		array('OH', 'Ohio'),
		array('OK', 'Oklahoma'),
		array('OR', 'Oregon'),
		array('PA', 'Pennsylvania'),
		array('PR', 'Puerto Rico'),
		array('RI', 'Rhode Island'),
		array('SC', 'South Carolina'),
		array('SD', 'South Dakota'),
		array('TN', 'Tennessee'),
		array('TX', 'Texas'),
		array('UT', 'Utah'),
		array('VA', 'Virginia'),
		array('VT', 'Vermont'),
		array('WA', 'Washington'),
		array('WI', 'Wisconsin'),
		array('WV', 'West Virginia'),
		array('WY', 'Wyoming')
	);

	$options = '<option value="" disabled selected>State</option>';

	foreach ($states as $statef) {
		if ($type == 'abbrev') {
			$options .= '<option value="'.$statef[0].'" '. check_select($stuff, $statef[0]) .' >'.$statef[0].'</option>'."\n";
        } 
		elseif($type == 'name') {
			$options .= '<option value="'.$statef[1].'" '. check_select($stuff, $statef[1]) .' >'.$statef[1].'</option>'."\n";
		}
		elseif($type == 'mixed') {
			$options .= '<option value="'.$statef[0].'" '. check_select($stuff, $statef[0]) .' >'.$statef[1].'</option>'."\n";
		}
	}

	echo $options;
}



function check_select($i, $m)
{
	if($i == $m)
		return 'selected="selected"';
}

?>
