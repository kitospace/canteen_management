<?php
include('Canteen_Connection.php');
$change_mode='save';

//print_r($_POST);
 //print_r($_GET);

if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$category_id=$_POST['category_id'];	
		$sub_category_name=$_POST['sub_category_name'];
		$sub_category_code=$_POST['sub_category_code'];
		echo $sql="INSERT INTO sub_category_master_table SET category_id='$category_id', sub_category_name='$sub_category_name', sub_category_code='$sub_category_code'";
		if (mysqli_query($conn, $sql)) {
			
			header('Location:sub_category_master.php');
		}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update' ){
		$category_id=$_POST['category_id'];	
		$sub_category_name=$_POST['sub_category_name'];
		$sub_category_code=$_POST['sub_category_code'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE sub_category_master_table SET category_id='$category_id', sub_category_name='$sub_category_name', sub_category_code='$sub_category_code' WHERE sub_category_id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:sub_category_master.php');
		}else {
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$item_id=$_GET['item_id'];
		$sql= "SELECT * FROM sub_category_master_table WHERE sub_category_id='$item_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$category_id=$row['category_id'];	
				$sub_category_name=$row['sub_category_name'];
				$sub_category_code=$row['sub_category_code'];
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
		var d=document.sub_category_master_form;
		var category_id=d.category_id.value;
		var sub_category_name=d.sub_category_name.value;
		var sub_category_code=d.sub_category_code.value;

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
    <div class="panel-heading"><h1 align="Center">SUB-CATEGORY MASTER</H1></div>
    <div class="panel-body">
	<form name="sub_category_master_form" action="sub_category_master.php" method="post" onSubmit="return false;">
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="category_id" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Category Name : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <div class="dropdown">
	  <?php
	  $sql ="SELECT category_id, category_name FROM category_db";
	  $result= mysqli_query($conn, $sql);
	  ?>
	  <select class="form-control" name="category_id" >   
		<option value="">Select Category</option>
		<?php 
		if($result){
		while ($row = mysqli_fetch_assoc($result)){
		$selected=($row['category_id']==$category_id)?'selected':'';
		echo '<option '.$selected.'  value="'.$row['category_id'].'">'.$row['category_name'].$category.'</option>';
		}
		}
		?>
	</select>

</div>

  </div></div>
  
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="sub_category_name" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Sub Category Name : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="sub_category_name" name="sub_category_name" placeholder="Enter sub category Name" value="<?php echo (isset($sub_category_name))?$sub_category_name:'';?>">
    </div></div>
 
  
  
    <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="sub_category_code" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Sub Category Code : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="sub_category_code" name="sub_category_code" placeholder="Enter sub category Code" value="<?php echo (isset($sub_category_code))?$sub_category_code:'';?>">
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


$sql = "SELECT  sub_category_id, category_id, sub_category_name, sub_category_code FROM sub_category_master_table";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>SUB-CATEGORY ID</th><th>Category</th><th>Sub Category Name</th><th>Sub Category Code</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['sub_category_id'].'</td><td>'.$row['category_id'].'</td><td>'.$row["sub_category_name"].'</td><td>'.$row['sub_category_code'].'</td>
		<td><a href="sub_category_master.php?item_id='.$row['sub_category_id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
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