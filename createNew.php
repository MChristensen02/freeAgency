<?php
session_start();
include ('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="FA.css" type="text/css">
<title>Free Agency Homepage</title>
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
  <button class="dropbtn">Menu</button>
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
<div class="search">
		<form method="post" action="search.php">
    <input type="text" name="srch_query" placeholder="Search here..." required>
    <input type="submit" name="search" value="search">
</form>
	</div>
	<div class="wrapper3">
	<h4>Create a New Account</h4>
	<form name="myForm" action="" method="post">
		<table>
	<div class="display">
		<tr>
			<td>First Name</td>	
			<td><input type="text" name="f_name" required value="<?php echo (isset($_POST['f_name']) ? $_POST['f_name'] : ''); ?>" placeholder="Enter your first name here..."></td>
		</tr>
		
		<tr>
			<td>Last Name</td>
			<td><input type="text" name="l_name" required value="<?php echo (isset($_POST['l_name']) ? $_POST['l_name'] : ''); ?>" placeholder="Enter your last name here..."></td>
		</tr>
		
		<tr>
			<td>Username</td>
			<td><input type="text" name="u_name" required value="<?php echo (isset($_POST['u_name']) ? $_POST['u_name'] : ''); ?>" placeholder="Enter your username here..."></td>
		</tr>
		
		<tr>
			<td>Password</td>
			<td><input type="password" name="u_pass" required value="<?php echo (isset($_POST['u_pass']) ? $_POST['u_pass'] : ''); ?>" placeholder="Enter your password here..."></td>
		</tr>
		
		<tr>
		<td>Confirm Password</td>
			<td><input type="password" name="u_pass2" required value="<?php echo (isset($_POST['u_pass2']) ? $_POST['u_pass2'] : ''); ?>" placeholder="Re-enter password here..."></td>
		</tr>
		
		<tr>
			<td>Street Address</td>
			<td><input type="text" name="u_add" required value="<?php echo (isset($_POST['u_add']) ? $_POST['u_add'] : ''); ?>" placeholder="Enter your address here..."></td>
		</tr>
		
		<tr>
			<td>City</td>
			<td><input type="text" name="u_city" required value="<?php echo (isset($_POST['u_city']) ? $_POST['u_city'] : ''); ?>" placeholder="Enter your city here..."></td>
		</tr>
		
		<tr>
			<td>State</td>
			<td><input type="text" name="u_state" required value="<?php echo (isset($_POST['u_state']) ? $_POST['u_state'] : ''); ?>" placeholder="Enter your state here..."></td>
		</tr>
		
		<tr>
			<td>Zip Code</td>
			<td><input type="text" name="u_zip" required value="<?php echo (isset($_POST['u_zip']) ? $_POST['u_zip'] : ''); ?>" placeholder="Enter 5 digit zip code here..."></td>
		</tr>
		
		<tr>
			<td>Email Address</td>
			<td><input type="text" name="u_email" required value="<?php echo (isset($_POST['u_email']) ? $_POST['u_email'] : ''); ?>" placeholder="Enter email address here..."></td>
		</tr>
</div>	
			</table>
			<div style="float:right; clear:both; margin-right:133px;"><br />
				<input type="submit" name="create" value="Create Account">				
			</div>
			<div style="margin-left:110px; clear:both; font-size:14pt;"><br /><br /><br />
			<a href="login.php" style="font-family:'Calibri'; text-decoration:none; color:black;">[Back to Login Page]</a></div>
	

</form>
		<?php
function fNameCheck($str1)
    {
        global $Err;
        $result = preg_match("/^[A-z]{2,12}[^0-9]{0}$/",$str1);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid First Name.";
            $Err++;
        }
        return $str1;
    }
    
    function lNameCheck($str2)
    {
        global $Err;
        $result = preg_match("/^[A-z]{2,20}[^0-9]{0}$/",$str2);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid Last Name.";
            $Err++;
        }
        return $str2;
    }

		function uNameCheck($str3)
    {
        global $Err;
        $result = preg_match("/^[A-z0-9]{2,25}$/",$str3);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid User Name. You can use numbers and letter, between 2 and 25 characters.";
            $Err++;
        }
        return $str3;
    }
    
    function passCheck($str4)
    {
        global $Err;
        $result = preg_match("/^[A-z0-9]{2,18}$/",$str4);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid Password. Can contain letters and numbers, between 2 and 18 characters.";
            $Err++;
        }
        return $str4;
    }
    
    function passCheck2($str4,$str5)
    {
        global $Err;
        $result = strcmp($str4,$str5);
        if ($result == 0)
        {
            echo "";
        }
        else
        {
            echo "<br />There was an issue confirming your Password. Please try again.";
            $Err++;
        }
        return $str5;
    }
//^[A-z0-9]{8,40}

function streetCheck($str6)
    {
        global $Err;
        $result = preg_match("/^[a-zA-Z0-9_. ]{8,50}$/",$str6);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid Street Address. Please use letters or numbers.";
            $Err++;
        }
        return $str6;
    }

function cityCheck($str7)
    {
        global $Err;
        $result = preg_match("/^[A-z_. ]{2,22}[^0-9]{0}$/",$str7);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid City.";
            $Err++;
        }
        return $str7;
    }

function stateCheck($str8)
    {
        global $Err;
        $result = preg_match("/^[A-Z]{2}[^0-9]{0}$/i",$str8);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid State. Make sure to only use the 2 letter abbreviation.";
            $Err++;
        }
        return $str8;
    }

function zipCheck($str9)
    {
        global $Err;
        $result = preg_match("/^[0-9]{5}$/",$str9);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid zip code. Please enter your 5 digit zip code.";
            $Err++;
        }
        return $str9;
    }

function mailCheck($str10)
    {
        global $Err;
        $result = preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[_a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/i",$str10);
        if ($result)
        {
            echo "";
        }
        else
        {
            echo "<br />Invalid email address. Please try again.";
            $Err++;
        }
        return $str10;
    }

if(isset($_POST['create']))
{
		fNameCheck($_POST['f_name']);
		lNameCheck($_POST['l_name']);
    uNameCheck($_POST['u_name']);
    passCheck($_POST['u_pass']);
    passCheck2($_POST['u_pass'], $_POST['u_pass2']);
		streetCheck($_POST['u_add']);
		cityCheck($_POST['u_city']);
		stateCheck($_POST['u_state']);
		zipCheck($_POST['u_zip']);
		mailCheck($_POST['u_email']);
    try
    {
       // change DB values so execute statement works
        if ($Err <= 0)
        {
            include('connect.php');
            $stmt = $db->prepare("INSERT INTO members(userName, f_name, l_name, password, address, city, state, zip, email)
                            VALUES(:Uname, :Fname, :Lname, :Pass, :Add, :City, :State, :Zip, :Mail)");
        
            $stmt->execute(array("Uname" => $_POST['u_name'], "Fname" => $_POST['f_name'], "Lname" => $_POST['l_name'], "Pass" => $_POST['u_pass'], "Add" => $_POST['u_add'], "City" => $_POST['u_city'], "State" => $_POST['u_state'], "Zip" => $_POST['u_zip'], "Mail" => $_POST['u_email'] ));
            echo "Account Created Successfully!";
            //header('add.php');
        }
       else
       {
         echo "<br /><b>You have entered Invalid Information.</b>";
       }
        
    }
    catch(PDOException $e)
    {
        echo 'ERROR: ' . $e->getMessage();
    }
}
else
{
        
}

?>
</body>
</html>