<?php
session_start();
session_unset();
$_SESSION["user"] = "";
$_SESSION["redirect"] = "signout";
header("Location: login.php");
?>