<?php
include('Canteen_Connection.php');
$change_mode='save';

if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$item_form=$_POST['item_form'];	
		echo $sql="INSERT INTO item_form_mater_table SET item_form='$item_form'";
		if (mysqli_query($conn, $sql)) {
			header('Location:item_form_master.php');
		}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update' ){
		$item_form=$_POST['item_form'];	
		$update_key=$_POST['update_key'];
		$sql="UPDATE item_form_mater_table SET item_form='$item_form' WHERE form_id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:item_form_master.php');
		}else {
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$item_id=$_GET['item_id'];
		$sql= "SELECT * FROM item_form_mater_table WHERE form_id='$item_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$form_id=$row['form_id'];	
				$item_form=$row['item_form'];
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
		var d=document.item_form_master_form;
		var item_form=d.item_form.value;

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
    <div class="panel-heading"><h1 align="Center"><u>ITEM FORM MASTER</u></H1></div>
    <div class="panel-body">
	<form name="item_form_master_form" action="item_form_master.php" method="post" onSubmit="return false;">
	
	
	
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
    <label for="item_form" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Item Form : </label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
       <input type="text" class="form-control" id="item_form" name="item_form" placeholder="Enter Item Form" value="<?php echo (isset($item_form))?$item_form:'';?>">
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


$sql = "SELECT  form_id, item_form FROM item_form_mater_table";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>S.No. </th><th>Form Name</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['form_id'].'</td><td>'.$row['item_form'].'</td>
		<td><a href="item_form_master.php?item_id='.$row['form_id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
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