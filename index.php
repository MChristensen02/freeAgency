<?php 
session_start();
require ('connect.php');
require ('home.php');
$role = $_SESSION['sess_userrole'];
$name = $_SESSION['sess_userName'];
$id = $_SESSION['sess_user_id'];
$o_pic = $db->prepare("SELECT * FROM items WHERE position LIKE 'off' AND isAvailable=1");
$o_pic->execute();
$d_pic = $db->prepare("SELECT * FROM items WHERE position LIKE 'def' AND isAvailable=1 ORDER BY id ASC");
$d_pic->execute();
$o_id = $db->prepare("SELECT id FROM items WHERE position LIKE 'off'");
$o_id->execute();
$d_id = $db->prepare("SELECT id FROM items WHERE position LIKE 'def'");
$d_id->execute();
?>
<!DOCTYPE html>
<html>

<div class="bigBox">	
	<h3>Featured Offensive Players</h3>
	<?php
		for($i=0; $i<=2; $i++)
			{ $p = $o_pic->fetch(); ?>
	<div class="o_features">
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
	</div>
	<?php  } ?>
<h3>Featured Defensive Players</h3>
<?php
		for($i=0; $i<=2; $i++)
			{ $p = $d_pic->fetch(); ?>
	<div class="d_features">
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
</body>
</html>

