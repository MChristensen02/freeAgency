<?php
	//Let the starting item index be 0
$start = 0;

//Items to display per page (limit) be 10
$limit = 6;

//If the page number ($current_page) is set..
if(isset($_GET['page']))
{
	$current_page = $_GET['page'];
	$start = ($current_page-1)*$limit;
}

// Retrieve required number of rows from database
$getData = $db->prepare('SELECT * FROM items LIMIT :start, :limit');
$getData->bindParam(':start', $start, PDO::PARAM_INT);
$getData->bindParam(':limit', $limit, PDO::PARAM_INT);
$getData->execute(); 

//Fetch the data and Display the items
while($dispData = $getData->fetch(PDO::FETCH_ASSOC))
{
	echo $dispData['text']."<br/>";
}

/*Calculate total number of pages to display, 
 based on total number of records in database */
$data=$db->prepare('SELECT * FROM pagination');
$data->execute();
$totalRecd = $data->rowCount();
$num_of_pages = ceil($totalRecd/$limit);

//If current page is greater than 1, add 'previous' button
if($current_page>1)
{ ?> 
		<button><a href="?page=<?php echo ($current_page-1); ?> " >
        			Previous</a></button>
<?php }

// If current page is lesser than number of pages, add 'Next' button
if( $current_page < $num_of_pages )
{  ?> 
	<button><a href="?page=<?php echo ($current_page+1); ?>" >
    			Next</a></button>
<?php }

//Display all Page numbers at the bottom to navigate.
echo "<ul class='page'>";
for($i=1;$i<=$num_of_pages;$i++)
{
	//Page number of Currenly viewing page
	if($i==$current_page) 
	{ echo "<li class='current'>".$i."</li>"; }
	
	//Page number of other pages (with hyperlink to navigate)		
	else 
	{ echo "<li><a href='?page=".$i."'>".$i."</a></li>"; }
}
echo "</ul>"; 

// Cart INSERT
array($name, "Name" => $_GET['Names'], "Team" => $_GET['team'], "Years" => $_GET['Year'], "Psalary" => $_GET['Salary'] )
?>

<?php

for($i=0; $i<=$p; $i++)
					 { $p = $o_pic->fetch();

// on recent page, this was entered in for the button's form
						 action="bidForm.php?first=<?php echo $row['firstName']; ?>&last=<?php echo $row['lastName']; ?>"
						
						
						
						?>
<!--
	<?php
// ?id=<?php echo $row['id']; ?>&firstName=<?php echo $row['firstName']; ? //>lastName=<?php echo $row['lastName']; ?>
	?> -->
