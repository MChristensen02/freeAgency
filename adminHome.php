<?php 
session_start();
require ('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
if($role!="Admin")
{
  header('Location: index.php');
	session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrative Control</title>
	<link rel="stylesheet" href="FA.css" type="text/css">
</head>
<body>
<div class="banner">
	<h2>NFL Free Agent</h2>
	<h2>Auction House</h2>
	<br />
	<div class="logs">
		<ul>
			<li>( Commissioner Goodell | </li>
			<li><a href="logOut.php"> Log Out </a></li>
			<li> )</li>
		</ul>
	</div>
<!--
<div class="extras">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp; </li>
		<li><a href="adminHome.php">Admin Home</a></li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
		<li><a href="adminHome.php">Upload New Image</a></li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
		<li><a href="pending.php">Pending Transactions</a></li>
	</ul>
</div>
-->
	</div>
	<div class="adminHome">
	<h3>Administrator Homepage</h3>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li>&nbsp;&nbsp;|&nbsp;&nbsp; </li>
			<li><a href="adminHome.php">Admin Home</a></li>
			<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
			<li><a href="upload.php">Upload New Image</a></li>
			<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
			<li><a href="pending.php">Pending Transactions</a></li>
		</ul>
	</div>
</body>
</html>
