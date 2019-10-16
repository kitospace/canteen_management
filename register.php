<?php
include('connection.php');
//print_r($_POST);
$change_mode='save';

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$username=$_POST['username'];
		$Cpassword=$_POST['Cpassword'];
		$password=$_POST['password'];
		$sql="INSERT INTO register_db SET first_name='$first_name', last_name='$last_name', username='$username',Cpassword = '$Cpassword', password='$password'";
		if (mysqli_query($conn, $sql)) {
			header('Location:data.php');
		}else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update'){
		//print_r($_POST);
		
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$username=$_POST['username'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE register_db SET first_name='$first_name', last_name='$last_name', username='$username',Cpassword = '$Cpassword', password='$password' WHERE id='$update_key'";
		if (mysqli_query($conn, $sql)) {	
			header('Location:data.php');
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode']) && $_GET['mode']=='edit'){
		$user_id=$_GET['user_id'];
		
		$sql = "SELECT * FROM register_db where id='$user_id'";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$first_name=$row['first_name'];
				$last_name=$row['last_name'];
				$username=$row['username'];
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
  <title>Bootstrap 4</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="js/bootstrap.js"></script>
  
<script>
function submitForm(){
	var d=document.register_form;
	var password=d.password.value;
	var confirm_password=d.Cpassword.value;
	if(password!=confirm_password){
	$('#Cpassword_msg').html('password not match');
	return false;
	}
	d.action='';
	d.submit();
}

function checkPassword(){
	var d=document.register_form;
	var password=d.password.value;
	var confirm_password=d.Cpassword.value;
	if(password!=confirm_password){
	$('#Cpassword_msg').html('password not match');
	return false;
	}else{
		$('#Cpassword_msg').html('password ok');
	}
}
// function checkActivity() {
  // alert("Input field lost focus.");
// }
function emptyActivity(){
	var d=document.register_form;
	var first_name=d.first_name.value;
	var username=d.username.value;
	var password=d.password.value;
	if(first_name == '' || username == '' || password == ''){
			alert("Fill the required field");
			return false;
	}else{
		d.action='';
	    d.submit();
	}
}
</script>
</head>
<body>
<?php
include('header_menu.php');
?>


<div class="container">
<div class="row">  

  <form name="register_form" action="register.php" method="post" onSubmit="return false;">value ="<?php echo (isset($first_name))?$first_name:'';?>"
    <div class="form-group">
      <label for="first_name">First Name:</label>
      <input type="text" class="form-control" id="first_name" placeholder="Enter your First Name" name="first_name" value ="<?php echo (isset($first_name))?$first_name:'';?>">
    </div>
    <div class="form-group">
      <label for="last_name">Last Name:</label>
      <input type="text" class="form-control" id="last_name" placeholder="Enter your Last Name" name="last_name" value ="<?php echo (isset($last_name))?$last_name:'';?>">
    </div>
	<div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" value ="<?php echo (isset($username))?$username:'';?>">
    </div>
	<div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
	<div class="form-group">
      <label for="Cpassword">Confirm Password:</label>
      <input type="password" class="form-control" id="Cpassword" placeholder="Enter Confirm password" name="Cpassword" onKeyUp="checkPassword()">
	  <span class="text-danger" id="Cpassword_msg"></span>
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>
	 <input type="hidden" name="update_key" value="<?php echo $user_id;?>">
  <input type="hidden" name="mode" value="<?php echo $change_mode;?>">
  <button type="register" class="btn btn-primary" onclick="emptyActivity()">Register</button>
  </form>
</div>
</div>
</body>
</html>