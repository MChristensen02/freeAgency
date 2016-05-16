<?php
include ('connect.php');

//new data
$userName = $_POST['userName'];
$f_name = $_POST ['f_name'];
$l_name = $_POST['l_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$email = $_POST['email'];
$id = $_POST['id'];


//Query
$sql = "UPDATE members
        SET userName=?, f_name=?, l_name=?, address=?, city=?, state=?, zip=?, email=?
        WHERE id=?";

$q = $db->prepare($sql);
$q->execute(array($userName, $f_name, $l_name, $address, $city, $state, $zip, $email, $id));
header("location: index.php"); 

?>