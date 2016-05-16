<?php 
session_start();
require ('connect.php');
//require ('pending.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
// Begin Query for each table
$plyr = $db->prepare("SELECT * FROM items WHERE status='PENDING'");
// Get the amount of rows
$plyr->execute();
$rowNum = mysql_num_rows($plyr);

//$rowNum = $db->prepare("SELECT * FROM orders WHERE ");

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
			<li>( <a href="adminHome.php">Commissioner Goodell</a> | </li>
			<li><a href="logOut.php"> Log Out </a></li>
			<li> )</li>
		</ul>
	</div>
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
	</div>	
	<h3>All Pending Transactions</h3>
	<div class="pendingPlayers">
	<?php
		foreach($plyr as $p)
		{ ?>
		<div class="bidAll">
	<table>
		<tr>
			<td><?php echo '<img src="upload/'.$p['file'].'" width="200" height="175">'; ?></td>
		</tr>
		<tr>
			<td><?php echo $p['firstName'];?>&nbsp;<?php echo $p['lastName']; ?></td>
		</tr>
		<tr>
			<td><?php echo $p['function']; ?></td>
		</tr>
		<tr>
			<td>Current Team: <?php echo $p['team']; ?></td>
		</tr>
		<tr>
			<td><a href="bids.php?id=<?php echo $p['id']; ?>&first=<?php echo $p['firstName']; ?>&last=<?php echo $p['lastName']; ?>">View All Bids</a></td>
		</tr>
	</table>
	</div>
	<?php  } ?>
	</div>
