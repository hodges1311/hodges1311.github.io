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
<?php
	if($_SESSION["user"] == "")
	{
		$_SESSION["redirect"] = "marketplace";
		header("Location: login.php");
	}
?>
<!-- Banner -->

	<body>
	<?php

	$itemErr = $imgErr = $desErr = $priErr = $owner = "";
	$item = $img = $des = $pri = $data = "";

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["item"]))
		{
			$itemErr = "Item Name is Required";
		}
		else
		{
			$item = test_input($_POST["item"]);
			if (!preg_match("/^[a-zA-Z\d ]*$/",$item))
			{
				$nameErr = "Only letters, digits, and white space allowed for Name";
			}
			if(strlen($item) > 40)
			{
				$userErr = "Item Names can only be 20 Characters Long";
			}
		}

		if (empty($_POST["img"]))
		{
			$imgErr = "Image Source is required";
		}
		else
		{
			$img = test_input($_POST["img"]);
		}

		if(empty($_POST["des"]))
		{
			$desErr = "Description is required";
		}
		else
		{
			$des = test_input($_POST["des"]);
			if (!preg_match("/^[a-zA-Z\d \' \. \, \" \: \; \? \- \! \s ]*$/",$body) || strlen($body) < 1)
			{
				$desErr = "Description must only contain alphanumerical characters and punctuation";
			}
		}
		if(empty($_POST["price"]))
		{
			$priErr = "Choose a price";
		}
		else
		{
			$data = test_input($_POST["price"]);
		}
		
		$owner = $_SESSION["user"];

		$servername = "localhost"; //local machine, the port on which the mySQL server runs on
		$username = "root"; //default is root
		$serverpassword= ""; //default is none
		$databasename = "mysql";

		$conn = new mysqli($servername, $username, $serverpassword, $databasename); //creates the connection

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if($nameErr == "" && $emailErr == "" && $infoErr == ""){
			$sql = "INSERT INTO marketplace (item, imgsrc, des, price, data, owner) VALUES ('$item', '$img', '$des', '$pri', '$data', '$owner')"; //Queries must be in string format
			$result = mysqli_query($conn, $sql); //does your query
			if ($result) { //checks your query
				echo "New record created successfully";
				header("Location: marketplace.php");
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
					<h2>Post Your Product!</h2>
					<p>Post your item for sale and start earning money while driving the invoation of better plane designs foward!</p>
				</header>
					<div class="box">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="row uniform 50%">
								<div class="12u <?php if($itemErr != "") echo 'tooltip'; ?>">
									Item
									<input id="<?php if($itemErr != "") echo 'error'; ?>" type="text" name="item" id="item" value="<?php echo $item?>" placeholder="Item">
									<?php if($itemErr != "") echo '<span  class="tooltiptext">'.$itemErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="12u <?php if($desErr != "") echo 'tooltip'; ?>">
									Description
									<textarea style="height:300" id="<?php if($desErr != "") echo 'error'; ?>" name="des" id="des" value="<?php echo $des?>" placeholder="Enter Description..."></textarea>
									<?php if($desErr != "") echo '<span  class="tooltiptext">'.$desErr.'</span>';?>
								</div>
							</div>
							<div class="row uniform 50%">
								<div class="10u 12u(mobilep) <?php if($imgErr != "") echo 'tooltip'; ?>">
									Image Source
									<input id="<?php if($imgErr != "") echo 'error'; ?>" type="text" name="img" id="img" value="<?php echo $img ?>" placeholder="Image Source">
									<?php if($imgErr != "") echo '<span class="tooltiptext">'.$imgErr.'</span>';?>
								</div>
								<div class="2u 12u(mobilep) <?php if($priErr != "") echo 'tooltip'; ?>">
									Price
									<select id="<?php if($PriErr != "") echo 'error'; ?>" name="price" id="price"><?php echo StateDropdown(null, 'mixed', $pri); ?></select>
									<?php if($priErr != "") echo '<span class="tooltiptext">'.$priErr.'</span>';?>
								</div>
							</div>
							<p id="field">*All Fields Required</p>
							<div class="row uniform">
								<div class="12u">
									<ul class="actions align-center">
										<li><input type="submit" value="Post Product"></li>
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
		array('$1.00', 'Alaska'),
		array('$2.00', 'Alabama'),
		array('$3.00', 'Arkansas'),
		array('$4.00', 'Arizona'),
		array('$5.00', 'California'),
		array('$6.00', 'Colorado'),
		array('$7.00', 'Connecticut'),
		array('$8.00', 'District of Columbia'),
		array('$9.00', 'Delaware'),
		array('$10.00', 'Florida'),
		array('$11.00', 'Georgia'),
		array('$12.00', 'Hawaii'),
		array('$13.00', 'Iowa'),
		array('$14.00', 'Idaho'),
		array('$15.00', 'Illinois'),
	);

	$options = '<option value="" disabled selected>Price</option>';

	foreach ($states as $statef) {
		if ($type == 'abbrev') {
			$options .= '<option value="'.$statef[0].'" '. check_select($stuff, $statef[0]) .' >'.$statef[0].'</option>'."\n";
        } 
		elseif($type == 'name') {
			$options .= '<option value="'.$statef[1].'" '. check_select($stuff, $statef[1]) .' >'.$statef[1].'</option>'."\n";
		}
		elseif($type == 'mixed') {
			$options .= '<option value="'.$statef[1].'" '. check_select($stuff, $statef[0]) .' >'.$statef[0].'</option>'."\n";
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
