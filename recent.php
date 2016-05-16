<?php 
session_start();
require ('connect.php');
//require ('pending.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
// Begin Query for each table
$ordr = $db->prepare("SELECT * FROM orders WHERE status LIKE 'PENDING' ORDER BY id DESC");
$ordr->execute();

// Get items table ready for UPDATE if a player accepts a contract
$itm = $db->prepare("SELECT * FROM items WHERE status LIKE 'PENDING'");
$itm->execute();

// Only allow Admin access to this page
if($role!="Admin")
{
  header('Location: index.php');
	session_destroy();
}

//if(isset($_POST['sign']));
//{
//	header('Location: bidForm.php');
//}

//if(isset($_POST['sign']))
//{
//	header('Location: bidForm.php');
//}

//if(isset($_POST['sign']))
//{
//	try //{ for($ordr as $row)
//	{
//				$_POST['firstName']=$row['firstName'];
//				$Pfn = $_POST['firstName'];
//				
//				$_POST['lastName']=$row['lastName'];
//				$Pln = $_POST['lastName'];
//		
//				$_POST['userName'] = $row['userName'];
//				$uName = $_POST['userName'];
//				
//	// Update the player's status to 'Signed' in orders table
//			$s = $db->prepare("UPDATE orders SET status='SIGNED' WHERE userName='.$uName.' AND firstName='.$Pfn.' AND lastName='.$Pln.'");
//			$s->execute();
//	// Update the items table so the player is no longer selected in queries
//			$u = $db->prepare("UPDATE items SET isAvailable=0 WHERE firstName='.$Pfn.' AND lastName='.$Pln.'"); 
//			$u->execute();	
//	//} // END foreach
//			header('Location: completed.php');
//		} // END try
//    catch(PDOException $e)
//    {
//        echo 'ERROR: ' . $e->getMessage();
//				
//    }
//
//// End of 'if'	
//} 

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
<div class="recents">	
	<h4>Most Recent Transactions</h4>

		<table width="1400" height="400" border="3">
        <tr style="text-decoration:underline;">
					<td width="60" align="center">Order ID</td>
					<td width="140" align="center">First Name</td>
					<td width="140" align="left">Last Name</td>
					<td width="135" align="center">Team</td>
					<td width="270" align="center">Position</td>
					<td width="101" align="center">Contract Years</td>
					<td width="141" align="center">Guaranteed per Year</td>
					<td width="141" align="center">Contract Total</td>
					<td width="140" align="center">Bidder</td>
					<td width="101" align="center">Order Date</td>
					<td width="110" align="center">Order Status</td>
					<td width="320" align="center">Accept a Contract</td>
				</tr>  
    <?php foreach ($ordr as $row) 
					{	?>
        <tr style="background-color:slategrey;">
            <td value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>   
						<td value="<?php echo $row['firstName'];?>"><?php echo $row['firstName'];?></td>
						<td value="<?php echo $row['lastName']; ?>"><?php echo $row['lastName']; ?></td>
            <td value="<?php echo $row['team']; ?>"><?php echo $row['team']; ?></td>
            <td value="<?php echo $row['function']; ?>"><?php echo $row['function']; ?></td>
            <td value="<?php echo $row['years']; ?>"><?php echo $row['years']; ?>&nbsp;years</td>
            <td value="<?php echo $row['salary']; ?>">$<?php echo $row['salary']; ?>&nbsp;million</td>
						<td value="total">$<?php echo $row['salary'] * $row['years'] ?>&nbsp;million</td>
						<td value="<?php echo $row['userName']; ?>"><?php echo $row['userName']; ?></td>
            <td value="<?php echo $row['orderDate']; ?>"><?php echo $row['orderDate']; ?></td>
						<td value="<?php echo $row['status']; ?>"><?php echo $row['status']; ?></td>
						<div class="signContract">
							<td><a href="bidForm.php?first=<?php echo $row['firstName']; ?>&last=<?php echo $row['lastName']; ?>">Sign Contract</a>
						</td>
						</div>
					</tr>
		<?php } ?>
					
			</table>
	<?php
//		if(isset($_POST['sign']))
//		{
////			$_POST['id'] = $row['id'];
////			$bID = $_POST['id'];
//			
//			$_POST['firstName'] = $row['firstName'];
//			$Pfn = $_POST['firstName'];
//		
//			$_POST['lastName'] = $row['lastName'];
//			$Pln = $_POST['lastName'];
//			try {
//				//foreach($ordr as $row) {
//					$sql = $db->prepare("UPDATE orders SET status='SIGNED' WHERE firstName LIKE '%".$Pfn."% AND lastName LIKE '%".$Pln."%'");
//					$sql->execute();
//				
//				// UPDATE the items table to disable other queries on player
//					$qry = $db->prepare("UPDATE items SET isAvailable=0 AND status='SIGNED' WHERE firstName LIKE '%".$Pfn."%' AND lastName LIKE '%".$Pln."%'");
//					$qry->execute();
//				//	} // END foreach
//				
//				//header("location: completed.php"); 
//				} // end try
//	
//			catch(PDOException $e)
//			{
//			echo 'ERROR: ' . $e->getMessage();
//			} // end catch
//	
//} // end if
//else 
//{
//	print_r($row);
//}
?>
<!--	</form>-->
	</div>

		</body>
</html>