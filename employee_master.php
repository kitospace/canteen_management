<?php
include('Canteen_Connection.php');

$change_mode='save';
// print_r($_GET);
// print_r($_POST);

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$em_name=$_POST['em_name'];
		$employee_id=$_POST['employee_id'];
		$phone_no=$_POST['phone_no'];
		$email=$_POST['email']; 
		$gender=$_POST['gender'];
		$date=$_POST['date'];
		$designation=$_POST['designation'];
		$sql="INSERT INTO employee_table SET em_name='$em_name', date='$date', phone_no='$phone_no', email='$email', gender='$gender', employee_id='$employee_id', designation='$designation'";
		if (mysqli_query($conn, $sql)) {
			header('Location:employee_master.php');
		}else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update'){
		$em_name=$_POST['em_name'];
		$phone_no=$_POST['phone_no'];
		$email=$_POST['email']; 
		$gender=$_POST['gender'];
		$designation=$_POST['designation'];
		$employee_id=$_POST['employee_id'];
		$date=$_POST['date'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE employee_table SET em_name='$em_name',date='$date', phone_no='$phone_no', email='$email', gender='$gender', employee_id='$employee_id', designation='$designation' WHERE em_id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:employee_master.php');
		}else{
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$user_id=$_GET['user_id'];
		$sql= "SELECT * FROM employee_table WHERE em_id='$user_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$em_name=$row['em_name'];
				$date=$row['date'];
				$phone_no=$row['phone_no'];
				$email=$row['email']; 
				$gender=$row['gender'];
				$designation=$row['designation'];
			    $employee_id=$row['employee_id'];

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
	<title>Canteen Employee Data</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="js/new_bootstrap.js"></script>
  <script src="js/bootstrap.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


  <script>
  function submitForm(){
	var d=document.employee_master_form;
	var submit_form = true;
	var em_name=d.em_name.value;
	if(em_name == '') {
		$('#name_error').html('Please fill the name');
		$('#em_name').removeClass('form_success');
		$('#em_name').addClass('form_error');
		submit_form = false;
	}else{
		if(!isNaN(em_name)){
			$('#name_error').html('Name filled is invalid');
			$('#em_name').removeClass('form_success');
		    $('#em_name').addClass('form_error');
			submit_form = false;
		}else{
		$('#name_error').html('');	
		$('#em_name').addClass('form_success');
		$('#em_name').removeClass('form_error');
	}}
	
	var employee_id=d.employee_id.value;
	if(employee_id == ''){
		$('#id_error').html('Please enter your employee ID');
		$('#employee_id').removeClass('form_success');
		$('#employee_id').addClass('form_error');
		submit_form = false;
	}else{
		if(isNaN(employee_id)){
			$('#id_error').html('Please enter valid employee ID');
			$('#employee_id').removeClass('form_success');
			$('#employee_id').addClass('form_error');
			submit_form = false;
		}else{
		$('#id_error').html('');	
		$('#employee_id').removeClass('form_error');
		$('#employee_id').addClass('form_success');
	}}
  
  var designation=d.designation.value;
	if(designation == '') {
		$('#designation_error').html('Please enter your Designation');
		$('#designation').removeClass('form_success');
		$('#designation').addClass('form_error');
		submit_form = false;
	}else{
		if(!isNaN(designation)){
			$('#designation_error').html('Please enter valid Designation');
			$('#designation').removeClass('form_success');
			$('#designation').addClass('form_error');
			submit_form = false;
		}else{
		$('#designation_error').html('');	
		$('#designation').removeClass('form_error');
		$('#designation').addClass('form_success');
	}}
	var date=d.date.value;
		if(date==''){
		$('#dob_error').html('Please enter your Date of Birth');
		$('#date').removeClass('form_success');
		$('#date').addClass('form_error');
		submit_form = false;
	}else{
		$('#dob_error').html('');
		$('#date').removeClass('form_error');
		$('#date').addClass('form_success');
	}
	
	
	var phone_no=d.phone_no.value;
	var re_phone= /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/;
	if(phone_no == ''){
		$('#phone_error').html('Please enter your Phone number');
		$('#phone_no').removeClass('form_success');
		$('#phone_no').addClass('form_error');
		submit_form = false;
	}else{
		if(!re_phone.test(phone_no)){
			$('#phone_error').html('Please enter the valid Phone Number');
			$('#phone_no').removeClass('form_success');
			$('#phone_no').addClass('form_error');
			submit_form = false;
		}else{
		$('#phone_error').html('');	
		$('#phone_no').addClass('form_success');
		$('#phone_no').removeClass('form_error');
	}}
	var email=d.email.value;
	var mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/ ;
	if(email==''){
		$('#email_error').html('Please enter your email id');
		$('#email').removeClass('form_success');
		$('#email').addClass('form_error');
		submit_form = false;
	}else{
		if(!mailformat.test(email)){
			$('#email_error').html('Please enter valid email id');
			$('#email').removeClass('form_success');
			$('#email').addClass('form_error');
			submit_form = false;
		}else{
		$('#email_error').html('');
		$('#email').addClass('form_success');
		$('#email').removeClass('form_error');
	}}
	var gender=d.gender.value;
	if(gender==''){
		$('#error').html('Please select your Gender');
		submit_form= false;
	}else{
	d.action='';
	if(submit_form==true){
		d.submit();
	}
  }}
	</script>
  
   <script>
    $(document).ready(function(){
      var employee_table=$('input[name="date"]'); 
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy/dd/mm',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      employee_table.datepicker(options);
    })
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
    <div class="panel-heading"><h1 align="center">EMPLOYEE DATA</h1></div>
    <div class="panel-body">
	<form name="employee_master_form" action="employee_master.php" method="post" onSubmit="return false;">
  <div class="form-group row">
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="em_name" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label" >Employee Full Name:</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="em_name" name="em_name" placeholder="Enter Your Name" value ="<?php echo (isset($em_name))?$em_name:'';?>" onblur="submitForm()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<label onblur="submitForm()">
		<span id="name_error" class="text-error"></span>
	</div>
  </div>
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
  <label for="employee_id" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label">Employee ID :</label></div>
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <input class="form-control" type="text" id="employee_id" name="employee_id" placeholder="Enter Your Id no." value="<?php echo(isset($employee_id))?$employee_id:'';?>" onblur="submitForm()">
  </div>
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<label onblur="submitForm()">
		<span id="id_error" class="text-error"></span>
	</div>
</div>
<div class="form-group row">
<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="designation" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label">Designation :</label></div>
	 <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="designation"  name="designation" placeholder="Enter Your Designation" value ="<?php echo (isset($designation))?$designation:'';?>" onblur="submitForm()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<label onblur="submitForm()">
		<span id="designation_error" class="text-error"></span>
	</div>
	</div>
	
<div class="form-group row">
<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
<label for="date" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label">DOB :</label></div>
<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
<input class="form-control" id="date" name="date" placeholder="YYYY/DD/MM" type="text" value ="<?php echo (isset($date))?$date:'';?>" onblur="submitForm()">
</div>
<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<label onblur="submitForm()">
		<span id="dob_error" class="text-error"></span>
	</div>
</div>	    
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="phone_no" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label">Phone No. :</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="phone_no"  name="phone_no" placeholder="Enter your phone no." value ="<?php echo (isset($phone_no))?$phone_no:'';?>" onblur="submitForm()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<label onblur="submitForm()">
		<span id="phone_error" class="text-error"></span>

	</div>
  </div>
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
    <label for="email" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label">Email :</label></div>
    <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
      <input type="text" class="form-control" id="email"  name="email" placeholder="Enter your Email" value ="<?php echo (isset($email))?$email:'';?>" onblur="submitForm()">
    </div>
	<div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
		<label onblur="submitForm()">
	  <span id="email_error" class="text-error" autocomplete="off">
	</div>
  </div>
  <div class="form-group row">
  <div class="col-sm-4 col-lg-4 col-xs-4 col-md-4">
     <label for="gender" class="col-sm-6 col-lg-6 col-xs-6 col-md-6 col-form-label" id="gender" name="gender">Gender :</label></div>
    <div class="form-check-inline">
      <label class="col-sm-1 col-md-1 col-lg-1 col-xs-1 form-check-label" for="gender">
		<input type="radio" class="form-check-input" id="male" name="gender" value="male">Male
      </label>
    </div>
    <div class="form-check-inline">
      <label class="col-sm-1 col-md-1 col-lg-1 col-xs-1 form-check-label" for="gender">
        <input type="radio" class="form-check-input" id="female" name="gender"  value="female">Female
      </label>
    </div>
    <div class="form-check-inline">
      <label class="col-sm-1 col-md-1 col-lg-1 col-xs-1 form-check-label" for="gender">
        <input type="radio" class="form-check-input" id="others" name="gender" value="others">Others
      </label>
    </div>
	<div class="col-sm-4">
		<label onblur="submitForm()">
	  <span id="error" class="text-error" autocomplete="off"></span>
	</div>
	</div>
	<input type="hidden" name="update_key" value="<?php echo $user_id;?>">
   <input type="hidden" name="mode" value="<?php echo $change_mode;?>">
  <button type="register" class="btn btn-success" onclick="submitForm()" style="float: center;">Submit</button>
</form>
	
	</div>
	</div>
</div>


<div class="container">
  <div class="panel panel-default">
<div class="panel-body">
<br>
<?php

include('Canteen_Connection.php');

$sql = "SELECT em_id, em_name, designation, employee_id, date, gender, phone_no, email FROM employee_table";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	echo '<table class="table table-striped">';
	echo '<thead>';
	echo '<tr><th>SNo.</th><th>Employee Name</th><th>Designation</th><th>Employee ID</th><th>DOB</th><th>Gender</th><th>Phone No</th><th>Email</th><th>Edits</th></tr>';
	echo '</thead>';
	echo '<tbody>';
	
	while($row = mysqli_fetch_assoc($result)){
		echo '<tr><td>'.$row['em_id'].'</td><td>'.$row["em_name"].'</td><td>'.$row['designation'].'</td><td>'.$row['employee_id'].'</td><td>'.$row['date'].'</td><td>'.$row['gender'].'</td><td>'.$row["phone_no"].'</td><td>'.$row["email"].'</td>
		<td><a href="employee_master.php?user_id='.$row['em_id'].'&mode=edit" class="btn btn-info btn-sm" onclick="update()">Edit</a></td></tr>';
	}
	echo '</tbody>';
	echo '</table>';
}else {
	echo "0 results";
}
mysqli_close($conn);
?>
</div></div>
</div>
</body>
</html>



