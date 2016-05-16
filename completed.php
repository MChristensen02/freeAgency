<?php 
session_start();
require ('connect.php');
//require ('pending.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
// Begin Query for each table
$plyr = $db->prepare("SELECT * FROM orders WHERE status LIKE 'SIGNED'");
$plyr->execute();


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
	<div class="done">
		<p>Signed Players</p>
</div>
<div class="signed">
	<form action="" method="get">
		<table width="1000" border="3">
        <tr style="background-color:whitesmoke; text-decoration:underline;">
					<td width="74">&nbsp;</td>
					<td width="60" align="center">Order ID</td>
					<td width="140" align="center">Player First Name</td>
					<td width="140" align="center">Player Last Name</td>
					<td width="135" align="center">Team</td>
					<td width="270" align="center">Position</td>
					<td width="101" align="center">Contract Years</td>
					<td width="141" align="center">Guaranteed per Year</td>
					<td width="141" align="center">Contract Total</td>
				</tr>  
    <?php foreach($plyr as $rw) 
{?>
<!--		<table width="900" border="1">-->
        <tr style="background-color:slategrey;">
						<td>&nbsp;</td>
            <td><?php echo $rw['id']; ?></td>   
						<td><?php echo $rw['firstName']; ?></td>
						<td><?php echo $rw['lastName']; ?></td>
            <td><?php echo $rw['team']; ?></td>
            <td><?php echo $rw['function']; ?></td>
            <td><?php echo $rw['years']; ?>&nbsp;years</td>
            <td>$<?php echo $rw['salary']; ?>&nbsp;million</td>
						<td>$<?php echo $rw['salary'] * $rw['years'] ?>&nbsp;million</td>
					</tr>
			<?php } ?>
			</table>
	</form>
	</div>