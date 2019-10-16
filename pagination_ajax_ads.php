<?php
include("ADS_Connection.php");
if($_POST== true){
echo "Search not matched";
if(isset($_POST)){
if (isset($_POST['search'])) {
	
   $name = $_POST['search'];
   $sql = "SELECT * FROM ads_result_info WHERE name LIKE '%$name%' LIMIT 5";
   $result = mysqli_query($conn, $sql);  
		if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row["year"].'</td><td>'.$row['branch'].'</td><td>'.$row['phone_no'].'</td><td>'.$row['email'].'</td>
		<td>'.$row['marks'].'</td><td>'.$row['department'].'</td><td>'.$row['mentor'].'</td><td>'.$row['interview'].'</td>
		<td><a href="ADS_JSS.php?item_id='.$row['id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
}}}}}else{

$limit = 5;  
    if (isset($_GET["page"])) {  
      $pn  = $_GET["page"];  
    }  
    else {  
      $pn=1;  
    };   
  
    $start_from = ($pn-1) * $limit;   
  
    $sql = "SELECT * FROM ads_result_info LIMIT $start_from, $limit";  
    $result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)){
	echo '<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row["year"].'</td><td>'.$row['branch'].'</td><td>'.$row['phone_no'].'</td><td>'.$row['email'].'</td>
		<td>'.$row['marks'].'</td><td>'.$row['department'].'</td><td>'.$row['mentor'].'</td><td>'.$row['interview'].'</td>
		<td><a href="ADS_JSS.php?item_id='.$row['id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
}}
?> 

