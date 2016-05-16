<?php 
session_start();
require ('connect.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
$id = $_SESSION['sess_user_id'];
$cart = $db->prepare("SELECT * FROM orders");
$cart->execute();


//Create an array for 'shopping cart' if it doesn't already exist
if(!isset($_SESSION['SHOPPING_CART']))
{
 $_SESSION['SHOPPING_CART']=array();   
}
// Add an item only if we have the four required pieces of information: First and Last name|Team|Function
if ( (isset ($_GET['first'])) &&
		(isset ($_GET['last'])) &&
		 (isset ($_GET['team'])) &&
    (isset ($_GET['function']))
    )
{
 // Adding an Item
 // Store it in the array
    $ITEM = array(
        'First' => $_GET['first'], // Player First Name
				'Last' => $_GET['last'],	 // Player Last Name
				'Team' => $_GET['team'],	// Current Team
        'Function' => $_GET['function'], // Position on field
				'Year' => $_GET['year'],
				'Salary' => $_GET['salary']
        );
    
 // Add this item to the Shopping Cart
  $_SESSION['SHOPPING_CART'][] = $ITEM;
    
    // Clear the URL variables
    header('Location: '.$_SERVER['PHP_SELF']);
}
 // If the user clicks 'Remove'
elseif (isset($_GET['remove']))
{
  // Remove the item from the cart
    unset($_SESSION['SHOPPING_CART'][$_GET['remove']]);
    
    // Re-Organize the cart and clear the URL variables
    header('Location: '.$_SERVER['PHP_SELF']);
}

 // If the user clicks 'Empty' button to empty the cart
elseif (isset($_GET['empty']))
{
  // Clear the cart by destroying all the data but keeping the user logged in
			unset($_SESSION['SHOPPING_CART']);
  // Clear the URL variables
    header('Location: '.$_SERVER['PHP_SELF']);
}
	// If the user clicks 'Update' button to update the cart
elseif (isset($_GET['update']))
{
  // Update Quantity for all items
    foreach ($_GET['year'] as $itemID => $qty)
    {
      // If the Quantity is "0", remove it from the cart
        if ($qty == 0)
        {
          // Remove it from the cart
            unset($_SESSION['SHOPPING_CART'][$itemID]);
					
        }
				// If Quantity is more than 1, update to the new quantity
				else if($qty >= 1)
				{
				 // Update to the new Qty
						$_SESSION['SHOPPING_CART'][$itemID]['Year'] = $qty;
				}
				
    }
		foreach ($_GET['salary'] as $itemID => $qty)
    {
      // If the Quantity is "0", remove it from the cart
        if ($qty == 0)
        {
          // Remove it from the cart
            unset($_SESSION['SHOPPING_CART'][$itemID]);
					
        }
				// If Quantity is more than 1, update to the new quantity
				else if($qty >= 1)
				{
				 // Update to the new Qty
						$_SESSION['SHOPPING_CART'][$itemID]['Salary'] = $qty;

						
				}
				
    }
    // Clear the POST variables

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Your Cart</title>
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
<div class="extras2">
	<ul>
		<li><a href="index.php">Home</a></li>
	</ul>
</div>
	<div class="cart">
	<form action="" method="get" name="shoppingcart">
    <?php
        // Turn on Output Buffering
        ob_start();
    ?>
		
      <table width="900" border="1">
        <tr>
					<td width="74">&nbsp;</td>
					<td width="100" align="center">First Name</td>
					<td width="100" align="center">Last Name</td>
					<td width="95" align="center">Team</td>
					<td width="101" align="center">Function</td>
					<td width="50" align="center">Years</td>
					<td width="410" align="center">Cost per Year</td>
					<td width="600" align="center">Total Cap Hit</td>
				</tr>  
			<?php
				//Print all the items in the shopping cart
				foreach($_SESSION['SHOPPING_CART'] as $itemNumber => $item)
				{?>
						<tr id="item <?php echo $itemNumber; ?>">
								<td><a href="?remove=<?php echo $itemNumber; ?>">[Remove]</a></td>	
								<td align="center" name value="<?php echo $item['First']; ?>"><?php echo $item['First']; ?></td>
							<td align="center" value="<?php echo $item['Last']; ?>"><?php echo $item['Last']; ?></td>
								<td align="center" value="<?php echo $item['Team']; ?>"><?php echo $item['Team']; ?></td>
								<td align="center" value="<?php echo $item['Function']; ?>"><?php echo $item['Function'] ?></td>
								<td align="center">
									<input type="text" name="year[<?php echo $itemNumber; ?>]" id="year" size="2" maxlength="2" value="<?php echo $item['Year']; ?>" required>
							  </td>
								<td align="center">$&nbsp;<input type="text" name="salary[<?php echo $itemNumber; ?>]" id="salary"  size="5" maxlength="12" value="<?php echo $item['Salary'] ?>" requried>
								</td>
								<td>$&nbsp;<?php echo $item['Year'] * $item['Salary']; ?>&nbsp;million</td>
					</tr>
				<?php } ?>
      </table>  
				<?php 
	// Outputs the content of internal buffer to $_SESSION['SHOPPING_CART_HTML']
						$_SESSION['SHOPPING_CART_HTML'] = ob_get_flush();
				 ?>
				<p><label>
						<input type="submit" name="update" id="update" value="Update Bids" />
					 </label>
					</p>
				</form>
				<form action="" method="post" name="submitButton">
					 <p><label>
						<input type="submit" name="add" id="add" value="Submit Bids" />
					 </label></p>
				</form>
		</div>
	<div class="linx1">
		<ul>
			<li><a href="index.php">Keep Shopping</a></li>
			</ul>
	</div>	
	<div class="linx2">
		<ul>
			<li><a href="?empty">Empty Cart</a></li>
		</ul>
	</div>
	<?php
if(isset($_POST['add']))
{
	try
    { 
		foreach($_SESSION['SHOPPING_CART'] as $itemNumber => $item)
	{
		$_POST['firstName'] = $item['First'];
		$Pname = $_POST['firstName'];
			
		$_POST['lastName'] = $item['Last'];
		$Lname = $_POST['lastName'];
			
		$_POST['team'] = $item['Team'];
		$team = $_POST['team'];
			
		$_POST['function'] = $item['Function'];
		$func = $_POST['function'];
			
		$_POST['years'] = $item['Year'];
		$year = $_POST['years'];
			
		$_POST['salary'] = $item['Salary'];
		$salary = $_POST['salary'];	
		
			$stmt = $db->prepare("INSERT INTO orders(userName, firstName, lastName, team, function, years, salary)
			
			VALUES('$name', '$Pname', '$Lname', '$team', '$func', '$year', '$salary')");
      $stmt->execute();	
			
			$uDate = $db->prepare("UPDATE items SET status='PENDING' WHERE firstName LIKE '%".$Pname."%' AND lastName LIKE '%".$Lname."%'");
			$uDate->execute();	
				
		}
			unset($_SESSION['SHOPPING_CART']);
			header('Location: products.php');
		}
    catch(PDOException $e)
    {
        echo 'ERROR: ' . $e->getMessage();
				
    }
			
// End of 'if'
	
} 

		
else
{    
	print_r($item);
}
?>
</body>
</html>
	
	