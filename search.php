<?php
session_start();
include('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
$id = $_SESSION['sess_user_id'];
$all = "SELECT * FROM items ";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
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
<!--this form displays the search box with query in the search result page-->
<div class="search">
<form method = "post" action="">
    <input type="text" name="srch_query" value = "<?php echo $q ?>" required>
    <input type="submit" name="search" value="Search">    
</form>
</div>
	<div class="bground">
	<h3 style="background-color:transparent;">Search Results:</h3>
<?php
	if(isset($_POST['search']))
{
    $q = $_POST['srch_query']; //searchquery of the user saved to variable'q'
	
		$all .= "WHERE firstName LIKE '%".$q."%' OR lastName LIKE '%".$q."%'"; 			
					
        $search = $db->prepare($all);
    
    $search->execute(); //Execute with wildcards
    if($search->rowcount()==0){echo "No match found!"; }
    else //Echo results
    {
			foreach ($search as $row)
				{ ?>
	<div class="srch" style="">
		<table>
		<tr>
			<td><?php echo '<img src="upload/'.$row['file'].'" width="200" height="175">'; ?></td>
		</tr>
		<tr>
			<td><?php echo $row['firstName'];?>&nbsp;<?php echo $row['lastName']; ?></td>
		</tr>
		<tr>
			<td><?php echo $row['function']; ?></td>
		</tr>
		<tr>
			<td>Current Team: <?php echo $row['team']; ?></td>
		</tr>
		<?php 
				if ($role == "Admin")
				{ ?>
					<tr>
			<td><a href="editform.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp; | &nbsp;
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
		</tr>
		<?php	}
			 if ($role == "User")
			 {
			?>
		<tr>
			<td><a href="cart.php?id=<?php echo $p['id']; ?>&first=<?php echo $p['firstName']; ?>&last=<?php echo $p['lastName']; ?>&team=<?php echo $p['team']; ?>&function=<?php echo $p['function']; ?>">Add Player to Cart</a></td>
		</tr>
			<?php	}
			?>
			</table>
		</div>
		
		<?php } // END foreach
     } // END else 
}	// END if 
		?> 
	</div>
	</body>
</html>