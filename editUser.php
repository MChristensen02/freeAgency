<?php
session_start();
require('connect.php');
$id=$_GET['id'];
$result = $db->prepare("SELECT * FROM members WHERE id= :userid");
$result->bindParam(':userid', $id);
$result->execute();
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
// Fetches all pending by the username whoever is logged in
$goods = $db->prepare("SELECT * FROM orders WHERE userName LIKE '%".$name."%' AND status='PENDING'");
$goods->execute();
// Fetches all newly signed players by the current user
$signed = $db->prepare("SELECT * FROM orders WHERE userName LIKE '%".$name."%' AND status='SIGNED'");
$signed->execute();



//$cart = $_GET[$_SESSION['SHOPPING_CART']];
if($role!="User")
{
  header('Location: index.php');
	session_destroy();
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Free Agency Homepage</title>
	<link rel="stylesheet" href="all.css" type="text/css">
</head>
<body>
<div class="banner">
	<h2>NFL Free Agent</h2>
	<h2>Auction House</h2>
	<br />
	<div class="logs">
		<ul>
			<?php
				if ($role=="Admin")
				{?>
					<li>( <a href="adminHome.php">Commissioner Goodell</a> | </li>
					<li><a href="logOut.php">Log Out</a></li>
					<li> )</li>
				<?php 
				}
				elseif ($role == "User")
				{ ?>
					<li>(Welcome, <a href="editUser.php?id=<?php echo $id; ?>"><?php echo $name ; ?></a>! | </li>
					<li><a href="logOut.php">Log Out</a></li>
					<li> )</li>
				<?php 
				}
				else
				{ ?>
					<li>( <a href="login.php">Login</a></li>
					<li>  |  </li>
					<li><a href="adminLog.php">Admin Login</a> )</li>
				<?php } ?>
		</ul>
	</div>
	<div class="extras2">
	<ul>
		<li><a href="index.php">Home</a></li>
	</ul>
</div>
</div>		
	<div class="editTitle">
	<h4>Edit Account Info</h4>
</div>
	<div class="edit">
<?php	
for($i=0; $p = $result->fetch(); $i++)
{
    ?>
<div class="editForm">
<form action="userEdit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $p['id']; ?>" />
	
		User Name <br>
    <input type="text" name="userName" value="<?php echo $p['userName']; ?>" /><br>
    
    First Name <br>
    <input type="text" name="f_name" value="<?php echo $p['f_name']; ?>" /><br>
    
    Last Name<br>
    <input type="text" name="l_name" value="<?php echo $p['l_name']; ?>" /><br>
	
		Home Address<br>
    <input type="text" name="address" value="<?php echo $p['address']; ?>" /><br>
	
		City<br>
    <input type="text" name="city" value="<?php echo $p['city']; ?>" /><br>
	
		State<br>
    <input type="text" name="state" value="<?php echo $p['state']; ?>" /><br>
	
		Zip Code<br>
    <input type="text" name="zip" value="<?php echo $p['zip']; ?>" /><br>
	
		Email<br>
    <input type="text" name="email" value="<?php echo $p['email']; ?>" /><br>
<br>
    <input type="submit" value="Save" />
    <?php } ?>
	</form>
</div>
		</div>
<div class="trans">
		<p>Pending Transactions</p>
</div>
<div class="orders">
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
					<td width="101" align="center">Order Date</td>
					<td width="110" align="center">Order Status</td>
				</tr>  
    <?php 
				foreach($goods as $row) ?>
<!--		<table width="900" border="1">-->
        <tr style="background-color:slategrey;">
						<td>&nbsp;</td>
            <td><?php echo $row['id']; ?></td>   
						<td><?php echo $row['firstName']; ?></td>
						<td><?php echo $row['lastName']; ?></td>
            <td><?php echo $row['team']; ?></td>
            <td><?php echo $row['function']; ?></td>
            <td><?php echo $row['years']; ?>&nbsp;years</td>
            <td>$<?php echo $row['salary']; ?>&nbsp;million</td>
						<td>$<?php echo $row['salary'] * $row['years'] ?>&nbsp;million</td>
            <td><?php echo $row['orderDate']; ?></td>
						<td><?php echo $row['status']; ?></td>
					</tr>
			</table>
	</form>
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
    <?php foreach($signed as $rw) ?>
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
			</table>
	</form>
	</div>
	</body>
</html>