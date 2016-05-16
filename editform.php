<?php
session_start();
include('connect.php');
$id=$_GET['id'];
$result = $db->prepare("SELECT * FROM items WHERE id= :userid");
$result->bindParam(':userid', $id);
$result->execute();
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
	<title>Free Agency Homepage</title>
	<link rel="stylesheet" href="FA.css" type="text/css">
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
					<li>(Welcome, <?php echo $name ; ?>! | </li>
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
			<li><a href="products.php">Browse</a></li>
			<?php
			if ($role=="Admin")
			{?>
				<li><a href="adminHome.php">Upload New Image</a></li>
			<li><a href="editform.php">Edit an Image</a></li>
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
<div class="editTitle">
	<h4>Edit Image Data</h4>
</div>
	<div class="edit">
<?php	
foreach($result as $p)
{
    ?>
<form action="edit.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $p['id']; ?>" />
	
		File Name <br>
    <input type="text" name="file" value="<?php echo $p['file']; ?>" /><br>
    
    First Name <br>
    <input type="text" name="firstName" value="<?php echo $p['firstName']; ?>" /><br>
    
    Last Name<br>
    <input type="text" name="lastName" value="<?php echo $p['lastName']; ?>" /><br>
    
    Team<br>
<!--    <input type="text" name="team" value="<?php echo $p['team']; ?>" /><br>-->
	 <select name="team" id="team">
					<option value="none"><?php echo $p['team']; ?></option>
				 	<option value="Cardinals" id="Cardinals">Arizona Cardinals</option>
					<option value="Falcons" id="Falcons">Atlanta Falcons</option>
					<option value="Ravens" id="Ravens">Baltimore Ravens</option>
					<option value="Bills" id="Bills">Buffalo Bills</option>
					<option value="Panthers" id="Panthers">Carolina Panthers</option>
					<option value="Bears" id="Bears">Chicago Bears</option>
					<option value="Browns" id="Browns">Cleveland Browns</option>
					<option value="Bengals" id="Bengals">Cincinnati Bengals</option>
					<option value="Cowboys" id="Cowboys">Dallas Cowboys</option>
					<option value="Broncos" id="Broncos">Denver Broncos</option>
					<option value="Lions" id="Lions">Detroit Lions</option>
					<option value="Packers" id="Packers">Green Bay Packers</option>
					<option value="Texans" id="Texans">Houston Texans</option>
					<option value="Colts" id="Colts">Indianapolis Colts</option>
					<option value="Jaguars" id="Jaguars">Jacksonville Jaguars</option>
					<option value="Chiefs" id="Chiefs">Kansas City Chiefs</option>
					<option value="Rams" id="Rams">Los Angeles Rams</option> 
					<option value="Dolphins" id="Dolphins">Miami Dolphins</option>
					<option value="Vikings" id="Vikings">Minnesota Vikings</option>
					<option value="Patriots" id="Patriots">New England Patriots</option>
					<option value="Saints" id="Saints">New Orleans Saints</option>
					<option value="Giants" id="Giants">New York Giants</option>
					<option value="Jets" id="Jets">New York Jets</option>
					<option value="Raiders" id="Raiders">Oakland Raiders</option>
					<option value="Eagles" id="Eagles">Philadelphia Eagles</option>
					<option value="Steelers" id="Steelers">Pittsburgh Steelers</option>
					<option value="Chargers" id="Chargers">San Diego Chargers</option>
					<option value="49ers" id="49ers">San Francisco 49ers</option>
					<option value="Seahawks" id="Seahawks">Seattle Seahawks</option>
					<option value="Buccaneers" id="Buccaneers">Tampa Bay Buccaneers</option>
					<option value="Titans" id="Titans">Tennessee Titans</option>
					<option value="Redskins" id="Redskins">Washington Redskins</option> 
				 </select><br />
	
		Function<br>
    <input type="text" name="function" value="<?php echo $p['function']; ?>" /><br>
    <input type="submit" value="Save" />
    <?php } ?>
		</form>
</div>
	</body>
</html>
	
	