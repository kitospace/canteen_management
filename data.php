<!DOCTYPE html>
<html lang="en">
<title>Bootstrap 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script> 
	//function editForm(){
		//window.location = "register.php";
	//}
  //</script>
<body>
<?php
include('header_menu.php');
?>
<div class="container">
<?php
include('connection.php');

$sql = "SELECT id, first_name, last_name, username FROM register_db";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>ID</th><th>Name</th><th>Username</th><th>   </th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['id'].'</td><td>'.$row["first_name"].' '.$row["last_name"].'</td><td>'.$row['username'].'</td>
		<td><a href="register.php?user_id='.$row['id'].'&mode=edit" class="btn btn-info btn-sm">Edit</a></td></tr>';
	}
	echo '</tbody>';
	echo '</table>';
}else {
	echo "0 results";
}
mysqli_close($conn);
?>
</div>
</body>
</html>