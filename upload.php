<?php 
session_start();
require ('connect.php');
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
	<title>Administrative Control</title>
	<link rel="stylesheet" href="FA.css" type="text/css">
</head>
<body>
<div class="banner">
	<h2>NFL Free Agent</h2>
	<h2>Auction House</h2>
	<br />
	<div class="logs">
		<ul>
			<li>( <a href="adminHome.php">Commissioner Goodell</a> | </li>
			<li><a href="logOut.php"> Log Out </a></li>
			<li> )</li>
		</ul>
	</div>
<div class="extras">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp; </li>
		<li><a href="adminHome.php">Admin Home</a></li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
		<li>[&nbsp;Upload New Image&nbsp;]</li>
		<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
		<li><a href="pending.php">Pending Transactions</a></li>
	</ul>
</div>
	</div>
<div class="upload">
<form action="adminHome.php" method="post" enctype="multipart/form-data">
     <fieldset> <table width="500" border="0" align="center">
   	<legend>Data Entry		
	 <tr>
		 <td>
			 <label>Image Name <span class="required">*</span></label>
		 </td>
	   <td align="center">
			 <input type="text" name="iname" placeholder="Image Name"></br>
     </td>
	 </tr>
	 <tr>
		 <td>
			 <label>First Name <span class="required">*</span></label>
		 </td>
	   <td align="center">
			 <input type="text" name="f_name" placeholder="First Name"></br>
     </td>
	 </tr>
	 <tr>
		 <td>
			 <label>Last Name <span class="required">*</span></label>
		 </td>
	     <td align="center">
				 <input type="text" name="l_name" placeholder="Last Name"></br>
     </td>
	 </tr>
	
	<tr>
		 <td>
			 <label>Current Team <span class="required">*</span></label>
		 </td>
	     <td align="center">
				 <select name="team" id="team">
					<option value="none">Select Current Rostered Team</option>
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
     	 </td>
	 </tr>
	
	 <tr>
		 <td>
			 <label>Function <span class="required">*</span></label>
		 </td>
	     <td align="center">
				 <select name="position" id="position" onchange="choose()">
					<option value="none">Select side of the ball</option>
				 	<option value="off" id="off">Offense</option>
					<option value="def" id="def">Defense</option>
				 </select><br />
     	 </td>
	 </tr>
	 <td>
		 	<label>Position <span class="required">*</span></label>
		 </td>
		 <td align="center">
			 <select name="function" id="offense" style="display:none">
				<option selected="selected" disabled value="none">Select Position</option>
			 	<option value="Quarterback" id="Quarterback">Quarterback</option>
			 	<option value="Running Back" id="Running Back">Running Back</option>
				<option value="Center" id="Center">Center</option>
				<option value="Guard" id="Guard">Guard</option>
				<option value="Tackle" id="Tackle">Tackle</option>
				<option value="Wide Receiver" id="Wide Receiver">Wide Receiver</option>
				<option value="Tight End" id="Tight End">Tight End</option>
			 </select>
			 <select name="function" id="defense" style="display:none">
				<option selected="selected" disabled value="none">Select Position</option>
			 	<option value="Defensive End" id="Defensive End">Defensive End</option>
			 	<option value="Defensive Tackle" id="Defensive Tackle">Defensive Tackle</option>
				<option value="Nose Guard" id="Nose Guard">Nose Guard</option>
				<option value="Inside Linebacker" id="Inside Linebacker">Inside Linebacker</option>
				<option value="Outside Linebacker" id="Outside Linebacker">Outside Linebacker</option>
				<option value="Corner Back" id="Corner Back">Corner Back</option>
				<option value="Strong Safety" id="Strong Safety">Strong Safety</option>
			 </select>
		 </td>
<script>
			function choose() {
				if (document.getElementById('position').value == 'off') {
        document.getElementById('offense').style.display = 'table-cell';
    } 
				if (document.getElementById('position').value == 'def') {
        document.getElementById('defense').style.display = 'table-cell';
    }
			}
</script>
     <tr><td><label for="file">Upload Picture:</label></td>
	     <td align="right"><input type="file" name="file" id="file"><br></td></tr>  
     <tr><td>&nbsp;  </td></tr>
		<tr><td colspan="2" align="center"><button type="submit" name="submit">Submit</button>
     <br><br> 
      </td></tr>
<tr><td colspan="2"> &nbsp; </td></tr>
<tr><td colspan="2" align="center"> 
<?php 
if(isset($_POST['submit']))
{
	$iname=$_POST['iname'];
	$fName=$_POST['f_name'];
	$lName=$_POST['l_name'];
	$team=$_POST['team'];
	$function=$_POST['function'];
	$position=$_POST['position'];
	$file=$_FILES["file"]["name"];
	$size= $_FILES["file"]["size"];
//Checking if 'image name' entered and 'File attachment' has been done.
if( empty($iname) || empty($file))
{
	echo "<label class='err'>All fields are required</label>";
}
	
// Checking the File Size. Maximum allowed size: 500,000 bytes (500 kb)	
elseif($size >500000)
{
	echo "<label class='err'> Image size must not greater than 500kb </label>";
}

//Store the allowed extensions in an array	
$allowedExts = array("gif", "jpeg", "jpg", "png"); 

/* using explode() function, separate the 'File Name' 
and its 'Extension' into individual elements of an array: $temp */
$temp = explode(".", $_FILES["file"]["name"]); 

/* The end() function returns the last element iof an array.
As per array $temp, First element: File name 
					 Last element: Extension */	
$extension = end($temp); 

/* -- Checking the File Type (extension) -- */	
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/txt")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] <= 500000)
&& in_array($extension, $allowedExts)) 
/* The in_array() searches for a specific value in an array.
Here, searches for $extension value in $allowedExts array */
{ 
/*If file is of allowed extension type, then further 
 validations for file are processed. */
	
// Checks if any error
if ($_FILES["file"]["error"] > 0) 
  {
	echo "Return Code: " .$_FILES["file"]["error"] . "<br>";
  } 

//Checks if the specific file already exists in the directory.		  
elseif (file_exists("upload/" . $_FILES["file"]["name"])) 
  {
	echo $_FILES["file"]["name"] . " Image upload already exists. ";
  } 

/* On passing all validations, the file is moved from 
temporary location to the directory. */
else
  {
    /* The move_uploaded_file() function moves an 
	    uploaded file to a new location. */
	$stmt = move_uploaded_file ( $_FILES["file"]["tmp_name"],
					     "upload/" .$_FILES["file"]["name"] );
	
	 $stmt = $db->prepare("INSERT INTO items (file, iname, firstName, lastName, team, position, function)
									VALUES ('$file', '$iname', '$fName', '$lName', '$team', '$position', '$function')");			
	
	// Insert the 'Image name' and 'File Name' to the database					 
	$stmt -> execute(array("$file", "$iname", "$fName", "$lName", "$team", "$position", "$function" ));					
	echo "Data Entered Successfully Saved!";
   }
}
//mysqli_close($con); Close the Database Connection
}  ?> 
</td></tr>
</legend>
</table>
	</fieldset>
	</form>
	</div>
</body>
</html>
