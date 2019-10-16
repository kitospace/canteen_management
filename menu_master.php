<?php
include('Canteen_Connection.php');
$change_mode='save';

// print_r($_POST);
// print_r($_GET);

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$item_name=$_POST['item_name'];
		$item_price=$_POST['item_price'];
		$item_mrp=$_POST['item_mrp'];
		$sql="INSERT INTO canteen SET item_name='$item_name', item_price='$item_price', item_mrp='$item_mrp'";
		if (mysqli_query($conn, $sql)) {
			header('Location:menu_master.php');
		}else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update'){
		$item_name=$_POST['item_name'];
		$item_price=$_POST['item_price'];
		$item_mrp=$_POST['item_mrp'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE canteen SET item_name='$item_name', item_price='$item_price', item_mrp='$item_mrp' WHERE item_id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:menu_master.php');
		}else{
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$user_id=$_GET['user_id'];
		$sql= "SELECT * FROM canteen WHERE item_id='$user_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$item_name=$row['item_name'];
				$item_price=$row['item_price'];
				$item_mrp=$row['item_mrp'];
			}
		}	
		$change_mode='update';
		
	}
}
mysqli_close($conn)

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
function submitForm1(){
	var d=document.menu_master_form;
	var form=true;
	var item_name=d.item_name.value;
	if(item_name == '') {
		$('#item_name_error').html('Please fill the Item name');
		$('#item_name').removeClass('form_success');
		$('#item_name').addClass('form_error');
		form= false;
	}else{
		if(!isNaN(item_name)){
			$('#item_name_error').html('Item Name filled is invalid');
			$('#item_name').removeClass('form_success');
		    $('#item_name').addClass('form_error');
			form= false;
		}else{
		$('#item_name_error').html('');	
		$('#item_name').addClass('form_success');
		$('#item_name').removeClass('form_error');
	}}
	var item_price=d.item_price.value;
	if(item_price==''){
		$('#item_price_error').html('Please fill the price of Item');
		$('#item_price').removeClass('form_success');
		$('#item_price').addClass('form_error');
		form= false;
	}else{
		if(isNaN(item_price)){
			$('#item_price_error').html('Please enter the valid price of Item');
			$('#item_price').removeClass('form_success');
			$('#item_price').addClass('form_error');
			form= false;
		}else{
		$('#item_price_error').html('');	
		$('#item_price').addClass('form_success');
		$('#item_price').removeClass('form_error');
	}}
	var item_mrp=d.item_mrp.value;
	if(item_mrp==''){
		$('#item_mrp_error').html('Please fill the mrp of Item');
		$('#item_mrp').removeClass('form_success');
		$('#item_mrp').addClass('form_error');
		form= false;
	}else{
		if(isNaN(item_mrp)){
			$('#item_mrp_error').html('Please enter the valid mrp of Item');
			$('#item_mrp').removeClass('form_success');
			$('#item_mrp').addClass('form_error');
			form= false;
		}else{	
		$('#item_mrp_error').html('');
		$('#item_mrp').addClass('form_success');
		$('#item_mrp').removeClass('form_error');
	}}
		d.action='';
		if(form==true){	
	    d.submit();
		}
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
    <div class="panel-heading"><h1 align="Center">SALE MENU MASTER</h1></div>
    <div class="panel-body">
	<form name="menu_master_form" action="menu_master.php" method="post" onSubmit="return false;">
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="item_name" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Item Name :</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value ="<?php echo (isset($item_name))?$item_name:'';?>" onblur="submitForm1()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	<label onblur="submitForm1()">
	<span id="item_name_error" class="text-error"></span>
  </div></div>
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="item_price" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label">Item Price(on sale) :</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="item_price"  name="item_price" placeholder="Enter Item's Sale Price" value ="<?php echo (isset($item_price))?$item_price:'';?>" onblur="submitForm1()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	<label onblur="submitForm1()">
	<span id="item_price_error" class="text-error"></span>
  </div></div>
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="item_mrp" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label">Item MRP :</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="item_mrp"  name="item_mrp" placeholder="Enter the Item MRP" value ="<?php echo (isset($item_mrp))?$item_mrp:'';?>" onblur="submitForm1()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	<label onblur="submitForm1()">
	<span id="item_mrp_error" class="text-error"></span>
  </div></div>
  <input type="hidden" name="update_key" value="<?php echo $user_id;?>">
  <input type="hidden" name="mode" value="<?php echo $change_mode;?>">
  <button type="register" class="btn btn-success" onclick="submitForm1()" style="float:Center;" >Submit</button>
</form>
</div></div></div>

<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<br>
<?php

include('Canteen_Connection.php');

$sql = "SELECT item_id, item_name, item_price, item_mrp FROM canteen";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>ITEM SNo.</th><th>Item Name</th><th>Item Price(on sale)</th><th>Item MRP</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['item_id'].'</td><td>'.$row["item_name"].'</td><td>'.$row["item_price"].'</td><td>'.$row['item_mrp'].'</td>
		<td><a href="menu_master.php?user_id='.$row['item_id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
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