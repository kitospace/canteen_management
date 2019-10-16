<?php
include('Canteen_Connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
img {
    width: 300px;
    height: 300px;
}

</style>
<body background src="css/wallpaper.jpeg">

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>KITO STORE.</h1>
  <p>Welcome to the @kito_space store!</p> 
</div>

<?php
include('Nav.php');
?>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <h2>About Us</h2>
      <img src="css\Untitled.png">
      <p><br>"A software and Zend certified company based in Noida. zend Passionate 
	  about web, we keen on learning new technologies and love to develop new ideas and 
	  fun projects. Here is a place for our to share my knowledge and challenges in different 
	  projects as well as a reference for ourself. Check out our projects on GitHub."</p>
      <h3>Project Links</h3>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="menu_master.php">Menu Master</a></li>
        <li><a href="employee_master.php">Employee Master</a></li>
        <li><a href="item_master.php">Item Master</a></li>
      </ul>
      <hr class="hidden-sm hidden-md hidden-lg">
    </div>
    <div class="col-sm-8">
      <h2>TITLE HEADING</h2>
      <h5>Title description, Dec 7, 2017</h5>
      <div class="img">Fake Image</div>
      <p>Some text..</p>
      <p>......</p>
      <br>
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg">Fake Image</div>
      <p>Some text..</p>
      <p>......</p>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Footer</p>
</div>

</body>
</html>
