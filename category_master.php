<?php
include('Canteen_Connection.php');
$change_mode='save';

// print_r($_POST);
// print_r($_GET);

if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$category_name=$_POST['category_name'];
		$category_code=$_POST['category_code'];
		echo $sql="INSERT INTO category_db SET category_name='$category_name', category_code='$category_code'";
		if (mysqli_query($conn, $sql)) {
			
			header('Location:category_master.php');
		}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update' ){
		$category_name=$_POST['category_name'];
		$category_code=$_POST['category_code'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE category_db SET category_name='$category_name', category_code='$category_code' WHERE category_id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:category_master.php');
		}else {
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$item_id=$_GET['item_id'];
		$sql= "SELECT * FROM category_db WHERE category_id='$item_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$category_id=$row['category_id'];
				$category_name=$row['category_name'];
				$category_code=$row['category_code'];
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
		var d=document.category_master_form;
		var form=true;
		var category_name=d.category_name.value;
		var category_code=d.category_code.value;
		if(category_name ==''){
			$('#category_name_error').html('Please enter the category of the Item');
			$('#category_name').removeClass('form_success');
			$('#category_name').addClass('form_error');
			form = false;
		}else{
			if(!isNaN(category_name)){
				$('#category_name_error').html('Please enter the valid category of the Item');
				$('#category_name').removeClass('form_success');
				$('#category_name').addClass('form_error');
				form = false;
			}else{
				$('category_name_error').html(' ');
				$('#category_name').removeClass('form_error');
				$('#category_name').addClass('form_success');
			}
		}
		if(category_code==''){
				$('#category_code_error').html('Please enter the category Code of the Item');
			$('#category_code').removeClass('form_success');
			$('#category_code').addClass('form_error');
			form = false;
		}else{
			if(!isNaN(category_code)){
				$('#category_code_error').html('Please enter the valid category code of the Item');
				$('#category_code').removeClass('form_success');
				$('#category_code').addClass('form_error');
				form = false;
			}else{
				$('category_code_error').html(' ');
				$('#category_code').removeClass('form_error');
				$('#category_code').addClass('form_success');
			}
		}
				d.action='';
				if(form==true){
				d.submit();
	}}
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
    <div class="panel-heading"><h1 align="Center">CATEGORY MASTER</H1></div>
    <div class="panel-body">
	<form name="category_master_form" action="category_master.php" method="post" onSubmit="return false;">
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="category_name" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Category Name : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category Name" value="<?php echo (isset($category_name))?$category_name:'';?>">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	<label onblur="submitPackinfo()">
	<span id="category_name_error" class="text-error"></span>
  </div></div>
  
  
    <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="category_code" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Category Code : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="category_code" name="category_code" placeholder="Enter category Code" value="<?php echo (isset($category_code))?$category_code:'';?>">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
	<label onblur="submitPackinfo()">
	<span id="category_code_error" class="text-error"></span>
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



$sql = "SELECT category_id, category_name, category_code FROM category_db";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>CATEGORY ID</th><th>Category Name</th><th>Category Code</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['category_id'].'</td><td>'.$row["category_name"].'</td><td>'.$row['category_code'].'</td>
		<td><a href="category_master.php?item_id='.$row['category_id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
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