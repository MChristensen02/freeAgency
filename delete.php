<?php

include('connect.php');
$id=$_GET['id'];
$file = $_GET['file'];
$result = $db->prepare("DELETE FROM items WHERE id= :memid");
$result->bindParam(':memid', $id);
$result->execute();
header("location: index.php");

?>