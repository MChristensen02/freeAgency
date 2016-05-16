<?php 
session_start();
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Login</title>

    <!-- Bootstrap -->
<link href="CSS/css/bootstrap.min.css" rel="stylesheet">
<link href="CSS/css/style.css" rel="stylesheet">
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
	<div class="search">
		<form method="post" action="search.php">
    <input type="text" name="srch_query" placeholder="Search here..." required>
    <input type="submit" name="search" value="search">
</form>
	</div>
  	<div class="info">
			
			<div class="col-md-6 col-md-offset-3">
				<h4>Log in with your credentials<span class="glyphicon glyphicon-user"></h4>
				<br/>
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
		} 
		elseif ($error_id == 2) 
  	{
    	echo '<p class="text-danger">'.$errors[$error_id].'</p>';
  	}
					?>  
<form action="authenticate.php" method="POST" class="form-signin col-md-8 col-md-offset-2" role="form">  
   <input type="text"  name="u_name" class="form-control" placeholder="Username" required autofocus>				<br/>
   <input type="password"  name="u_pass" class="form-control" placeholder="Password" required>
		<br/>
   <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
         </div>
			</div>
				
      </div>
      <div class="adminHome">
					<a href="index.php"> Home </a>
				</div>
     
    </div>
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>