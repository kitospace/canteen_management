<?php
include('Canteen_Connection.php');
$change_mode='save';

if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$tax_name=$_POST['tax_name'];	
		$tax_code=$_POST['tax_code'];
		$tax_rate=$_POST['tax_rate'];
		echo $sql="INSERT INTO tax_type_master_table SET tax_name='$tax_name', tax_code='$tax_code', tax_rate='$tax_rate'";
		if (mysqli_query($conn, $sql)) {
			header('Location:tax_type_master.php');
		}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update' ){
		$tax_name=$_POST['tax_name'];	
		$tax_code=$_POST['tax_code'];
		$tax_rate=$_POST['tax_rate'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE tax_type_master_table SET tax_name='$tax_name', tax_code='$tax_code', tax_rate='$tax_rate' WHERE tax_id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:tax_type_master.php');
		}else {
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$item_id=$_GET['item_id'];
		$sql= "SELECT * FROM tax_type_master_table WHERE tax_id='$item_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$tax_id=$row['tax_id'];	
				$tax_name=$row['tax_name'];
				$tax_code=$row['tax_code'];
				$tax_rate=$row['tax_rate'];
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
		var d=document.tax_type_master_form;
		var tax_name=d.tax_name.value;
		var tax_code=d.tax_code.value;
		var tax_rate=d.tax_rate.value;

				d.action='';
				d.submit();
	}
  </script>
  <!--<style>
		.form_error { border: 1px solid red !important;}
		.form_success { border: 1px solid green !important;}
	</style>-->
</head>
<body>
<?php
include('Nav.php');
?>


<div class="container">


  <div class="panel panel-default">
    <div class="panel-heading"><h1 align="Center"><u>TAX TYPE MASTER</u></H1></div>
    <div class="panel-body">
	<form name="tax_type_master_form" action="tax_type_master.php" method="post" onSubmit="return false;">
	
	
	
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="tax_name" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >TAX NAME : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
       <input type="text" class="form-control" id="tax_name" name="tax_name" placeholder="Enter Tax Name" value="<?php echo (isset($tax_name))?$tax_name:'';?>">
	  </div></div>
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="tax_code" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >TAX CODE : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="tax_code" name="tax_code" placeholder="Enter Tax Code" value="<?php echo (isset($tax_code))?$tax_code:'';?>">
    </div></div>
    <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="tax_rate" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >TAX RATE : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	 <input type="text" class="form-control" id="tax_rate" name="tax_rate" placeholder="Enter Tax Rate" value="<?php echo (isset($tax_rate))?$tax_rate:'';?>">
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


$sql = "SELECT  tax_id, tax_name, tax_code, tax_rate FROM tax_type_master_table";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>ID</th><th>Tax Name</th><th>Tax Code</th><th>Tax Rate(in %)</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['tax_id'].'</td><td>'.$row['tax_name'].'</td><td>'.$row["tax_code"].'</td><td>'.$row['tax_rate'].'</td>
		<td><a href="tax_type_master.php?item_id='.$row['tax_id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
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
</html>`