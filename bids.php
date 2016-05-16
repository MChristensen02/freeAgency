<?php 
session_start();
require ('connect.php');
//require ('pending.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];

if($role!="Admin")
{
  header('Location: index.php');
	session_destroy();
}
if ( (isset($_GET['first'])) &&
		 (isset($_GET['last'])));
$pFirst = $_GET['first'];
$pLast = $_GET['last'];
//Query to select all current bids for the player that was clicked on 'allOrders.php'
$bid = $db->prepare("SELECT * FROM orders WHERE firstName LIKE '%".$pFirst."%' AND lastName LIKE '%".$pLast."%' ");
$bid->execute();

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
	
<div class="orders">
	<form action="completed.php" method="post">
		<table width="1300" height="200">
        <tr style="text-decoration:underline;">
					<td width="60" align="center">Order ID</td>
					<td width="140" align="center">Name</td>
					<td width="135" align="center">Team</td>
					<td width="270" align="center">Position</td>
					<td width="101" align="center">Contract Years</td>
					<td width="141" align="center">Guaranteed per Year</td>
					<td width="141" align="center">Contract Total</td>
					<td width="140" align="center">Bidder</td>
					<td width="101" align="center">Order Date</td>
					<td width="110" align="center">Order Status</td>
					<td width="270" align="center">Accept a Contract</td>
				</tr>  
    <?php foreach($bid as $row) ?>
<!--		<table width="900" border="1">-->
        <tr style="background-color:slategrey;">
            <td><?php echo $row['id']; ?></td>   
						<td><?php echo $row['firstName'];?>&nbsp;<?php echo $row['lastName']; ?></td>
            <td><?php echo $row['team']; ?></td>
            <td><?php echo $row['function']; ?></td>
            <td><?php echo $row['years']; ?>&nbsp;years</td>
            <td>$<?php echo $row['salary']; ?>&nbsp;million</td>
						<td>$<?php echo $row['salary'] * $row['years'] ?>&nbsp;million</td>
						<td><?php echo $row['userName']; ?></td>
            <td><?php echo $row['orderDate']; ?></td>
						<td><?php echo $row['status']; ?></td>
						<td><div class="signContract">
<!--								<form action="" method="post" name="submitButton" >-->
									<input type="submit" name="sign" id="sign" value="SIGN CONTRACT" />
<!--								</form>-->
								</div>
					</td>
					</tr>
			</table>
	</form>
		<?php
if(isset($_POST['sign']))
{
	$_POST['lastName'] = $row['lastName'];
	$Pln = $_POST['lastName'];
	
	$_POST['firstName'] = $row['firstName'];
	$Pfn = $_POST['firstName'];
	
		try { 
	// Update the player's status to 'Signed'
			$s = $db->prepare("UPDATE orders SET status='SIGNED' WHERE firstName LIKE '%".$Pfn."%' AND lastName LIKE '%".$Pln."%'");
			$s->execute();
	// Update the items table so the player is no longer selected in queries
			$u = $db->prepare("UPDATE items SET status='SIGNED' WHERE firstName LIKE '%".$Pfn."%' AND lastName LIKE '%".$Pln."%'"); 
			$u->execute();	
			//header('Location: index.php');	
		}
//			unset($_POST['sign']);
			
		
    catch(PDOException $e)
    {
        echo 'ERROR: ' . $e->getMessage();
				
    }
	
// End of 'if'	
} 
	?>
	</div>