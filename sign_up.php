<?php 
include('Canteen_Connection.php');

if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$email=$_POST['email'];	
		$password=$_POST['password'];
		echo $sql="INSERT INTO sign_up_table SET email='$email', password='$password'";
		if (mysqli_query($conn, $sql)) {
			header('Location:sign_up.php');
		}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="js/pagination.js"></script>
  <script src="js/new_bootstrap.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
	function submitPackInfo(){
		var d=document.sign_up_form;
		var email=d.email.value;
		var password = d.password.value;
		
		d.action='';
		d.submit();
	}
	
  </script>
</head>  
<body>
  <?php include('Nav.php')?>
  <div class="container">
  <div class="panel panel-default">
  <div class="panel-heading" align="center">Sign-Up</div> 
  <div class= "panel-body">
	<form name="sign_up_form" action="sign_up.php" method="post" onSubmit="return false;">
		<div class="form-group row">
		<div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
		<label for="email" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label" >Email: </label></div>
		<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
		</div></div>
		
		<div class="form-group row">
		<div class="col-sm-4 col-lg-4 col-md-4 col-xs-4">
		<label for ="password" class="col-sm-6 col-md-6 col-lg-6 col-xs-6 col-form-label">Password:</label></div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		<input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
		</div>
		</div>
		
		<input type="hidden" name="update_key" value="<?php echo $Id;?>">
		<input type="hidden" name="mode" value="<?php echo $change_mode;?>">
		<button type="register" class="btn btn-success" onclick="submitPackInfo()" style="float:right">Sign Up</button>
		
	</form></div></div>
	<?php mysqli_close($conn)?>
  </div>
</body>
</html>