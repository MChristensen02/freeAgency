<?php 
session_start();
require ('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
$id = $_SESSION['sess_user_id'];
$d_pic = $db->prepare("SELECT * FROM items WHERE position LIKE 'def' AND isAvailable LIKE 1 ORDER BY id ASC");
$d_pic->execute();
$o_id = $db->prepare("SELECT id FROM items WHERE position LIKE 'def'");
$o_id->execute();

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
</div>	
<div class="dropdown">
  <button class="dropbtn"><a href="index.php">Menu</a></button>
  <div class="dropdown-content">
		<ul>
  		<li><a href="index.php">Home</a></li>
			<li><a href="index.php">Browse</a></li>
				<ul>
					<li><a href="offense.php">Offense</a></li>
					<li><a href="defense.php">Defense</a></li>
				</ul>
			<?php
			if ($role=="Admin")
			{?>
				<li><a href="adminHome.php">Admin Home Page</a></li>
			<li><a href="pending.php">Transactions</a></li>
			<li><a href="logOut.php">Log Out</a></li>
			<?php }
			?>
				<?php
			if ($role=="User")
			{?>
			<li><a href="cart.php">Cart</a></li>
			<li><a href="logOut.php">Log Out</a></li>
			<?php }
			?>
			<?php 
				if ($role!=="Admin" && $role!=="User")
				{
				?>
			<li><a href="login.php">Log In</a></li>
			<?php } ?>
  	</ul>
	</div>
</div>

	<div class="bground">
		<div class="search">
		<form method="post" action="search.php">
    <input type="text" name="srch_query" placeholder="Search here..." required>
    <input type="submit" name="search" value="search">
</form>
	</div>
		
	<h3>All Defensive Players</h3>
	<?php
		foreach($d_pic as $p)
		{ ?>
	<div class="d_all">
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
		<?php 
				if ($role == "Admin")
				{ ?>
					<tr>
			<td><a href="editform.php?id=<?php echo $p['id']; ?>">Edit</a>&nbsp; | &nbsp;
                <a href="delete.php?id=<?php echo $p['id']; ?>">Delete</a></td>
		</tr>
			<?php	}
			 if ($role == "User")
			 {
			?>
		<tr>
			<td><a href="cart.php?id=<?php echo $p['id']; ?>&first=<?php echo $p['firstName']; ?>&last=<?php echo $p['lastName']; ?>&team=<?php echo $p['team']; ?>&function=<?php echo $p['function']; ?>">Add Player to Cart</a></td>
		</tr>
		<?php  } ?>
	</table>
	</div>
	<?php  } ?>
	</div>
<!--id=<?php echo $p['id']; ?>&-->