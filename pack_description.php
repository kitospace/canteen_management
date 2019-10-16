<?php
include('Canteen_Connection.php');
$change_mode='save';

if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$item_quantity=$_POST['item_quantity'];
		$sql="INSERT INTO pack_description_table SET item_quantity='$item_quantity'";
		if (mysqli_query($conn, $sql)) {
			header('Location:pack_description.php');
		}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update' ){
		$item_quantity=$_POST['item_quantity'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE pack_description_table SET item_quantity='$item_quantity' WHERE item_ID='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:pack_description.php');
		}else {
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$item_id=$_GET['item_id'];
		$sql= "SELECT * FROM pack_description_table WHERE item_ID='$item_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$item_ID=$row['item_ID'];
				$item_quantity=$row['item_quantity'];
			}
		}	
	$change_mode='update';
		
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Canteen Data</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="js/new_bootstrap.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
    function submitPackinfo(){
		var d=document.pack_description_master_form;
		var form=true;
		var item_quantity=d.item_quantity.value;
				d.action='';
				d.submit();
	}
  </script>
  <style>
		.form_error { border: 1px solid red !important;}
		.form_success { border: 1px solid green !important;}
	</style>
</head>
<body>
<?php
include('Nav.php');
?>


<div class="container">


  <div class="panel panel-default">
    <div class="panel-heading"><h1 align="Center">PACKAGE DESCRIPTION MASTER</H1></div>
    <div class="panel-body">
	<form name="pack_description_master_form" action="pack_description.php" method="post" onSubmit="return false;">
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="item_price" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label">Item Quantity :</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="item_quantity"  name="item_quantity" placeholder="Enter Item quantity" value ="<?php echo (isset($item_quantity))?$item_quantity:'';?>">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	<label onblur="submitPackinfo()">
	<span id="item_quantity_error" class="text-error"></span>
  </div></div>
  <input type="hidden" name="update_key" value="<?php echo $item_id;?>">
  <input type="hidden" name="mode" value="<?php echo $change_mode;?>">
  <button type="register" class="btn btn-success" onclick="submitPackinfo()" style="float:Center;" >Submit</button>
</form>
</div></div></div>

<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<br>
<?php

include('Canteen_Connection.php');

$sql = "SELECT item_ID, item_quantity FROM pack_description_table";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>ITEM ID</th><th>Item Quantity</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['item_ID'].'</td><td>'.$row["item_quantity"].'</td>
		<td><a href="pack_description.php?item_id='.$row['item_ID'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
	}
	echo '</tbody>';
	echo '</table>';
}else {
	echo "0 results";
}
mysqli_close($conn);
?>
</div>
</div></div>


</body>
</html>