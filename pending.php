<?php 
session_start();
require ('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
// Begin Query for each table
$order = $db->prepare("SELECT * FROM orders");
$order->execute();

$plyr = $db->prepare("SELECT * FROM items");
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
		<li><a href="upload.php">Upload New Image</a></li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
		<li>[&nbsp;Pending Transactions&nbsp;]</li>
	</ul>
</div>
	</div>
	<div class="upload">
<form action="" method="post" enctype="multipart/form-data">
<!--
     <fieldset> <table width="350" border="0" align="center">
			 <label>Sort Transactions<span class="required">*</span></label>
		 </td>
	     <td align="center">
			 <label>Sort By:<span class="required">*</span></label>
		 </td>
	     <td align="center">
				 <select name="method" id="method">
					<option value="none">Select a Sorting Method</option>
				 	<option value="recent" id="recent">Most Recent</option>
					<option value="play" id="play">All Players</option>
					<option value="com" id="com">Completed Transactions</option>
				 </select><br />
     	 </td>
				<input type="submit" name="sort" style="float:right; clear:both;" value="Sort">
		</fieldset>
		</form>
-->
	<ul>
		<li><input type="submit" name="sort" value="Most Recent" /></li>
		<li><input type="submit" name="sort" value="All Players" /></li>
		<li><input type="submit" name="sort" value="Completed Transactions" /></li>
	</ul>

	</form>
<?php
if(isset($_POST['sort'])) 
{
	switch($_POST['sort']) {
		case 'Most Recent': header('Location: recent.php');
         break;
		case 'All Players': header('Location: allOrders.php');
         break;
		case 'Completed Transactions': header('Location: completed.php');
				 break;
		default:
				header('Location: pending.php');
				break;
   
 }
}
else //No button has been selected
{
    
}
?>
		
	</div>
	</body>
</html>
	