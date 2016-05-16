<?php 
require 'connect.php'; //Databsse Connection
session_start(); //Start the session

if(isset($_POST['u_name']))
{	$username = $_POST['u_name'];	 }

if(isset($_POST['u_pass'])) 
{	$pass = $_POST['u_pass'];
}
	
// Check whether the entered username/password pair exist in the Database
$q = 'SELECT * FROM members WHERE userName=:UName AND password=:Pass';
$query = $db->prepare($q);
$query->execute(array(':UName' => $username, ':Pass' => $pass));

if($query->rowCount() == 0)
{	header('Location: index.php?err=1');  }


else 
{	//fetch the result as associative array
	$row = $query->fetch(PDO::FETCH_ASSOC);
	
	//Store the fetched details into $_SESSION
	$_SESSION['sess_user_id'] = $row['id'];
	$_SESSION['sess_userName'] = $row['userName'];
  $_SESSION['sess_userrole'] = $row['role'];
	
	if( $_SESSION['sess_userrole'] == "Admin")
	{
		header('Location: adminHome.php');
	}
	elseif($_SESSION['sess_userrole'] == "User")
	{
		header('Location: index.php');
	}
	else
	{
		header('Location: login.php');
	} 
}?>




<!--
$stmt = $db->prepare("INSERT INTO users(userName, password, securityQues, securityAns)
                            VALUES(:Uname, :Pass, :Sques, :Sans)");
        
            $stmt->execute(array("Uname" => $_POST['u_name'], "Pass" => $_POST['u_pass'], "Sques" => $_POST['secQuestion'], "Sans" => $_POST['s_ans']-->
