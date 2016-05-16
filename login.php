<?php 
session_start();
include ('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];

//if(!isset($_SESSION['sess_userName']) && $role!="Admin")
//{
////   header('Location: index.php?err=2');
//}
?>

<!DOCTYPE html>
<html>
<head>
<link href="CSS/css/bootstrap.min.css" rel="stylesheet">
<link href="CSS/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="FA.css" type="text/css">
</head>
	<div class="banner">
	<h2>NFL Free Agent</h2>
	<h2>Auction House</h2>
	<br />
	<div class="logs">
		<ul>
			<?php
				if ($role=="Admin")
				{?>
					<li>( Admin | </li>
					<li><a href="logOut.php">Log Out</a></li>
					<li> )</li>
				<?php 
				}
				elseif ($role == "User")
				{ ?>
					<li>( <?php echo $name ; ?> | </li>
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

<div class="block-margin-top">
	<?php 
//Associative array to display 2 types of error message.
 $errors = array( 1=>"Invalid user name or password, Try again",
                  2=>"Please login to access this area" );						
//Get the error_id from URL
$error_id =  $_GET['err'];
if ($error_id == 1) 
{
    echo '<p class="text-danger">'.$errors[$error_id].'</p>';
} elseif ($error_id == 2) 
  {
    echo '<p class="text-danger">'.$errors[$error_id].'</p>';
  }?>  
	<div class="col-md-6 col-md-offset-3">
		<h4><br /><br /><br /><span style="margin-left:40%; color:whitesmoke;">Log In</span><span class="glyphicon glyphicon-user" style="margin-left:60px; color:whitesmoke;"></span></h4>
				<br/>


<form action="authenticate.php" method="POST" class="form-signin col-md-8 col-md-offset-2" role="form">  
   <input type="text"  name="u_name" class="form-control" placeholder="Username" required autofocus>				<br/>
   <input type="password"  name="u_pass" class="form-control" placeholder="Password" required>
		<br/>
   <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
</div>
	</div>

	<div class="home">
		<a href="index.php">Home</a>
		<a href="createNew.php" style="margin-left:270px">Create a new Account</a>
	</div>


</html>