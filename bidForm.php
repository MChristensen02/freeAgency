<?php
session_start();
include('connect.php');
$query = $db->prepare("SELECT * FROM orders WHERE id LIKE '%".$bID."%'");
$query->execute();

if ( (isset ($_GET['first'])) &&
		(isset ($_GET['last'])) &&
		)
{
		$Pfn = $row['firstName'];
		$Pln = $row['lastName'];

$sql = "UPDATE orders
        SET status=SIGNED 
        WHERE firstName LIKE '%".$Pfn."%' AND WHERE lastName LIKE '%".$Pln."%'";

$q = $db->prepare($sql);
$q->execute($sql);

$stmt = "UPDATE items
        SET isAvailable=FALSE AND SET status=SIGNED 
        WHERE firstName LIKE '%".$Pfn."%' AND WHERE lastName LIKE '%".$Pln."%'"; 
$s = $db->prepare($stmt);
$s->execute($stmt);
		header("location: completed.php"); 
	
	
} // end if




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
