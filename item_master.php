<?php
include('Canteen_Connection.php');
$change_mode='save';
$item_type=0;
$fixed_mrp=0;
$non_batch_item=0;
$non_expiry_item=0;
$fixed_mrp=0;
$non_mrp_item=0;
  
$mode=$_REQUEST['mode'];
if(isset($_POST)){
		if(isset($_POST['mode']) && $_POST['mode']=='save'){
		$item_type=$_POST['item_type'];
		$item_form=$_POST['item_form'];
		$pack_description=$_POST['pack_description'];
		$fixed_mrp=$_POST['fixed_mrp'];
		$non_batch_item=$_POST['non_batch_item'];
		$item_name=$_POST['item_name'];
		$category=$_POST['category'];
		$item_mrp=$_POST['item_mrp'];
		$non_expiry_item=$_POST['non_expiry_item'];
		$item_code=$_POST['item_code'];
		$sub_category=$_POST['sub_category'];
		$tax_type=$_POST['tax_type'];
		$non_mrp_item=$_POST['non_mrp_item'];
		$hsn_code=$_POST['hsn_code'];
		$sql="INSERT INTO item_table_master SET item_type='$item_type', item_form='$item_form', pack_description='$pack_description', fixed_mrp='$fixed_mrp', non_batch_item='$non_batch_item',
				item_name='$item_name', category='$category', item_mrp='$item_mrp', non_expiry_item='$non_expiry_item', item_code='$item_code', sub_category='$sub_category', 
				tax_type='$tax_type', non_mrp_item='$non_mrp_item', hsn_code='$hsn_code'";
		if (mysqli_query($conn, $sql)) 
		{
			header('Location:item_master.php?mode=new');
			}else {
			echo "Error: " . $sql . "<br>". mysqli_error($conn);
	}
	}
}

if(isset($_POST)){
	if(isset($_POST['mode']) && $_POST['mode']=='update'){
		$item_type=$_POST['item_type'];
		$item_form=$_POST['item_form'];
		$pack_description=$_POST['pack_description'];
		$fixed_mrp=$_POST['fixed_mrp'];
		$non_batch_item=$_POST['non_batch_item'];
		$item_name=$_POST['item_name'];
		$category=$_POST['category'];
		$item_mrp=$_POST['item_mrp'];
		$non_expiry_item=$_POST['non_expiry_item'];
		$item_code=$_POST['item_code'];
		$sub_category=$_POST['sub_category'];
		$tax_type=$_POST['tax_type'];
		$non_mrp_item=$_POST['non_mrp_item'];
		$hsn_code=$_POST['hsn_code'];
		$update_key=$_POST['update_key'];
		$sql="UPDATE item_table_master SET item_type='$item_type', item_form='$item_form', pack_description='$pack_description', fixed_mrp='$fixed_mrp', non_batch_item='$non_batch_item',
				item_name='$item_name', category='$category', item_mrp='$item_mrp', non_expiry_item='$non_expiry_item', item_code='$item_code', sub_category='$sub_category', 
				tax_type='$tax_type', non_mrp_item='$non_mrp_item', hsn_code='$hsn_code' WHERE id='$update_key'";
		if(mysqli_query($conn, $sql)){
			header('Location:item_master.php?item_id='.$update_key.'&mode=info');
		}else{
			echo "Error: ".$sql."<br>".mysqli_error($conn);
		}
	}
}

if(isset($_GET)){
	if(isset($_GET['mode'])&&$_GET['mode']=='edit'){
		$item_id=$_GET['item_id'];
		$sql= "SELECT * FROM item_table_master WHERE id='$item_id'";
		$result= mysqli_query($conn, $sql);
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$id=$row['id'];
				$item_type=$row['item_type'];
				$item_form=$row['item_form'];
				$pack_description=$row['pack_description'];
				$fixed_mrp=$row['fixed_mrp'];
				$non_batch_item=$row['non_batch_item'];
				$item_name=$row['item_name'];
				$category=$row['category'];
				$item_mrp=$row['item_mrp'];
				$non_expiry_item=$row['non_expiry_item'];
				$item_code=$row['item_code'];
				$sub_category=$row['sub_category'];
				$tax_type=$row['tax_type'];
				$non_mrp_item=$row['non_mrp_item'];
				$hsn_code=$row['hsn_code'];
				

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
  function getSubCategory(category_id){
	$.ajax({
	url : "get_ajax.php",
	type : "POST",
	data: 'cat='+category_id,
	async: true,
	success : function(result_data) {	
		$('#subcategory').html(result_data);
	}
	});
  }
 </script> 
 <style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
    }
</style>
 <style>
 
 label.error {
  font-size: 12px;
  color: red;
 }
 a:hover {
   cursor: pointer;
   background-color: yellow;
}
 </style>
 <script> 
  $(function(){
	 $("#item_master_form").validate({
		 rules: {
			 item_type: "required",
			 item_name: {
							required: true
							
			             },
			 item_code: {
					required: true,
					minlength: 5
					},
			 hsn_code :{ 
					required : true,
					minlength : 5 
					},
			item_form: "required",
			category: "required",
			sub_category:"required",
			pack_description:"required",
			item_mrp: {required: true,
						number : true},
			tax_type: "required",
			fixed_mrp:"required",
			non_expiry_item:"required",
			non_batch_item:"required",
			non_mrp_item:"required"
		 },
			messages:{
			item_type: "Check the item Type",
			item_name: { 
						required: "Please enter the item name",
						},
			item_code: {
				required: "Please Enter Item Code",
				minlength:"Enter 5 digit Item Code",
			},
			hsn_code: {
				required: "Please Enter HSN Code",
				minlength:"Enter 5 digit HSN Code",
			},
			item_form : "Select Item Form",
			category : "Select Category of item",
			sub_category : "Select Sub-Category",
			pack_description: "Select Pack Description",
			item_mrp : {
				required : "Enter MRP of Item",
				number: "Please enter valid MRP of item"
			},
			tax_type : "Select Tax Type",
			fixed_mrp: "Check an option",
			non_expiry_item: "Check an option",
			non_batch_item: "Check an option",
			non_mrp_item : "Check an option"
			
		},	
		submitHandler: function(form) {
		form.submit();
		}
	 });
 });
 </script>
 
  <script>
  function submit(){
	  var d=document.item_master_form;
	  var item_type=d.item_type.value;
	  var item_form=d.item_form.value;
	  var pack_description=d.pack_description.value;
	  var fixed_mrp=d.fixed_mrp.value;
	  var non_batch_item=d.non_batch_item.value;
	  var item_name=d.item_name.value;
	  var category=d.category.value;
	  var item_mrp=d.item_mrp.value;
	  var non_expiry_item=d.non_expiry_item.value;
	  var item_code=d.item_code.value;
	  var sub_category=d.sub_category.value;
	  var tax_type=d.tax_type.value;
	  var non_mrp_item=d.non_mrp_item.value;
	  var hsn_code=d.hsn_code.value;
	  
	  d.action='';
	  d.submit();
  }
  </script>

<style>
table, th, td {
  border: 1px solid white;
  padding: 25px;
}
</style>
<style>
.accordion {
  background-color: #f5f5f5;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}


.accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active:after {
  content: "\2212";
}
</style>
</head>
<body>
<?php
include('Nav.php');
?>
<div class="container">

<div id="Div1">
  <div class="panel panel-default">
		<a class="text-info" data-toggle="collapse" data-target="#collapse1"><button class="accordion">ITEM MASTER</button></div></a>
	<div id="collapse1" class="panel-collapse">
	<div class="panel">
    <div class="panel-body" style="border : 5px black!important;">
	<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	 <?php 
	 
	 if($mode=='info'){
		include('info_page.php');
	}else{
	 ?>
	
	<form name="item_master_form" action="item_master.php" method="post" id="item_master_form">
	<div class="row">
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	  <label for="item_type" >Item Type :</label><br>
		<div class="form-control" style="border:0px !important;">
		<label class="radio-inline" for="item_type1">
		<input type="radio" class="radio" id="item_type1" name="item_type" value="1" <?php echo($item_type=='1')?"checked":""?>>Manufactured
		</label>
		<label class="radio-inline" for="item_type2">
		<input type="radio" class="radio" id="item_type2" name="item_type" value="2" <?php echo($item_type=='2')?"checked":""?>>Raw Item
		</label>
		</div>
		<label id="item_type-error" class="error" for="item_type"></label>
	</div>
	
		
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	<div class="form-group">
			<label for="item_name">Item Name:</label>
			<input type="text" class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value ="<?php echo (isset($item_name))?$item_name:'';?>" pattern="^[a-zA-Z\s]{3,}$" required>
			<label id="item_name-error" class="error" for="item_name"></label>
	</div></div>

		
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	  <label for="item_code" >Item Code:</label>
			<input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter Item Code" value ="<?php echo (isset($item_code))?$item_code:'';?>" >
			
	<label id="item_code-error" class="error" for="item_code" ></label></div>
		
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	  <label for="hsn_code" >HSN Code:</label>
			<input type="text" class="form-control" id="hsn_code" name="hsn_code" placeholder="Enter HSN Code" value ="<?php echo (isset($hsn_code))?$hsn_code:'';?>">
			
	<label id="hsn_code-error" class="error" for="hsn_code" ></label>
	</div></div>

	<div class="row">
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
    <label for="item_form" >Item Form:</label>
    <?php
	  $sql ="SELECT form_id, item_form FROM item_form_mater_table";
	  $result= mysqli_query($conn, $sql);
	  ?>
	  <select class="form-control" name="item_form" >   
		<option value="">Select Item Form</option>
		<?php 
		if($result){
		while ($row = mysqli_fetch_assoc($result)){
		$selected=($row['form_id']==$id)?'selected':'';
		echo '<option '.$selected.'  value="'.$row['form_id'].'">'.$row['item_form'].$name.'</option>';
		}
		}
		?>
	</select>
	<label id="item_form-error" class="error" for="item_form" ></label>
	</div>
	
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
	<label for="category">Category:</label>
    <?php
	  $sql ="SELECT category_id, category_name, category_code FROM category_db";
	  $result= mysqli_query($conn, $sql);
	  ?>
	  <select class="form-control" name="category" onChange="getSubCategory(this.value)">   
		<option value="">Select Category</option>
		<?php 
		if($result){
		while ($row = mysqli_fetch_assoc($result)){
		$selected=($row['category_id']==$id)?'selected':'';
		echo '<option '.$selected.'  value="'.$row['category_id'].'">'.$row['category_name'].$name.',  '.$row['category_code'].$code.'</option>';
		}
		}
		?>
	</select>
	<label id="category-error" class="error" for="category" ></label></div>
	
	<div class="col-sm-3 col-lg-3 col-md-3 col-xs-3">
	<label for="sub_category" >Sub-Category:</label>
    <?php
	  $sql ="SELECT sub_category_id, sub_category_name, sub_category_code FROM sub_category_master_table";
	  $result= mysqli_query($conn, $sql);
	  ?>
	  <select class="form-control" name="sub_category" id="subcategory">   
		<option value="">Select Sub-Category</option>
		<?php 
		if($result){
		while ($row = mysqli_fetch_assoc($result)){
		$selected=($row['sub_category_id']==$id)?'selected':'';
		echo '<option '.$selected.'  value="'.$row['sub_category_id'].'">'.$row['sub_category_name'].$name.',  '.$row['sub_category_code'].$code.'</option>';
		}
		}
		?>
	</select>
	<label id="subcategory-error" class="error" for="subcategory" ></label>
	</div></div>
	<div class="row">
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
    <label for="pack_description" >Pack Description</label>
	<?php
	  $sql ="SELECT item_ID, item_quantity FROM pack_description_table";
	  $result= mysqli_query($conn, $sql);
	  ?>
	  <select class="form-control" name="pack_description" >   
		<option value="">Select Pack Description</option>
		<?php 
		if($result){
		while ($row = mysqli_fetch_assoc($result)){
		$selected=($row['item_ID']==$id)?'selected':'';
		echo '<option '.$selected.'  value="'.$row['item_ID'].'">'.$row['item_quantity'].$quantity.'</option>';
		}
		}
		?>
	</select>
<label id="pack_description-error" class="error" for="pack_description" ></label>
</div>

<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">	
	  <label for="item_mrp" >Item MRP:</label>
			<input type="text" class="form-control" id="item_mrp" name="item_mrp" placeholder="Enter Item MRP" value ="<?php echo (isset($item_mrp))?$item_mrp:'';?>">
	 	<label id="item_mrp-error" class="error" for="item_mrp" style = ".error: ; color: red !important;"></label>
	</div>
	
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
		<label for="tax_type" >Tax Type:</label>
		<?php
		  $sql ="SELECT tax_id, tax_name, tax_code, tax_rate FROM tax_type_master_table";
		  $result= mysqli_query($conn, $sql);
		  ?>
		  <select class="form-control" name="tax_type" >   
			<option value="">Select Tax Type</option>
			<?php 
			if($result){
			while ($row = mysqli_fetch_assoc($result)){
			$selected=($row['tax_id']==$id)?'selected':'';
			echo '<option '.$selected.'  value="'.$row['tax_id'].'">'.$row['tax_name'].$name.',  '.$row['tax_code'].$code.',  '.$row['tax_rate'].$rate.'</option>';
			}
			}
			?>
		</select>
		<label id="tax_type-error" class="error" for="tax_type" ></label></div>
		</div>
		
<div class="row">
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">		
	  <label for="fixed_mrp">Is Fixed MRP? :</label><br>
	  <div class="form-control" style="border:0px !important;">
	  <div class="radio-inline">
      <label class="radio-inline" for="fixed_mrp">
		<input type="radio" class="radio" id="fixed_mrp" name="fixed_mrp" value="1" <?php echo($fixed_mrp=='1')?"checked":""?>>YES
      </label>
	  <label class="radio-inline" for="fixed_mrp">
		<input type="radio" class="radio" id="fixed_mrp" name="fixed_mrp" value="2" <?php echo($fixed_mrp=='2')?"checked":""?>>NO
      </label>
	  </div></div>
	  <label id="fixed_mrp-error" class="error" for="fixed_mrp" ></label>
	  </div>
	  
	
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
	  <label for="non_expiry_item" >Non Expiry Item? :</label><br>
	  <div class="form-control" style="border:0px !important">
	  <div class="radio-inline">
      <label class="radio-inline" for="non_expiry_item">
		<input type="radio" class="radio" id="expiry_yes" name="non_expiry_item" value="1" <?php echo($non_expiry_item=='1')?"checked":""?>>YES
      </label>
	  <label class="radio-inline" for="fixed_mrp">
		<input type="radio" class="radio" id="expiry_no" name="non_expiry_item" value="2" <?php echo($non_expiry_item=='2')?"checked":""?>>NO
      </label>
	</div></div>	

	<label id="non_expiry_item-error" class="error" for="non_expiry_item" ></label></div>
	
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">	
	  <label for="non_batch_item" >Non Batch Item? :</label><br>
	  <div class="form-control" style="border: 0px !important">
	  <div class="radio-inline">
      <label class="radio-inline" for="fixed_mrp">
		<input type="radio" class="radio" id="batch_yes" name="non_batch_item" value="1" <?php echo($non_batch_item=='1')?"checked":""?>>YES
      </label>
	  <label class="radio-inline" for="fixed_mrp">
		<input type="radio" class="radio" id="batch_no" name="non_batch_item" value="2" <?php echo($non_batch_item=='2')?"checked":""?>>NO
      </label>
    </div></div>
	<label id="non_batch_item-error" class="error" for="non_batch_item" ></label>
	</div></div>
	<div class="row">
	<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">	
	  <label for="non_mrp_item" >Non MRP Item? :</label><br>
	  <div class="form-control" style="border: 0px !important">
	  <div class="radio-inline">
      <label class="radio-inline" for="non_mrp_item">
		<input type="radio" class="radio" id="non_mrp_yes" name="non_mrp_item" value="1" <?php echo($non_mrp_item=='1')?"checked":""?>>YES
      </label>
	  <label class="radio-inline" for="non_expiry_item">
		<input type="radio" class="radio" id="mrp_no" name="non_mrp_item" value="2" <?php echo($non_mrp_item=='2')?"checked":""?>>NO
      </label>
	  
    </div></div><label id="non_mrp_item-error" class="error" for="non_mrp_item" ></label>
	</div>

	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label></label></div>
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label></label></div>
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label></label></div>
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label></label></div>
	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3"><label></label></div>

	<div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
			<input type="hidden" name="mode" value="<?php echo $change_mode;?>">
			<input type="hidden" name="update_key" value="<?php echo $item_id;?>">
			<button  type="submit" class="btn btn-md btn-success btn-block" style="margin-bottom: auto;" a href="item_master.php?item_id='.$item_id.'&mode=save">Save</a></button>

     </div></div>
</form>
<?php
}
?>
</div>
</div>
</div>
</div></div></div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

<script>
 function fill(Value) {
    $('#search').val(Value);
 }
 $(document).ready(function() {
    $("#search").keyup(function() {
        var item_name = $('#search').val();
        if (item_name == "") {
            $("#search").html("");	
        }
        else {
            $.ajax({
                type: "POST",
                url: "pagination_ajax.php",  
                data: {search: item_name},
                success: function(html) {
                    $("#searchTableBody").html(html).show();
               }
           });
        }
   });
 });
</script>
<?php
$encounter_limit =10;
$sql = "SELECT COUNT(*) FROM item_table_master";   
        $rs_result = mysqli_query($conn,$sql);   
        $row = mysqli_fetch_row($rs_result);   
        $encounter_records = $row[0];   
        $encounter_pages = ceil($encounter_records / $encounter_limit); 
?>  

<script>
$(function(){
		$('.pagination').pagination({
		items:<?=$encounter_records?>,
		itemsOnPage:5,
		cssStyle: 'dark-theme',
		currentPage:1,
		onPageClick : function(pageNumber) {
			jQuery("#searchTableBody").html('loading...');
			jQuery("#searchTableBody").load("pagination_ajax.php?page="+pageNumber+"&limit=<?php echo $encounter_limit;?>");
		},
		onInit :function(){
			jQuery("#searchTableBody").html('loading...');
			jQuery("#searchTableBody").load("pagination_ajax.php?page=1&limit=<?php echo $encounter_limit;?>");
		}
	});
});	


</script>

<div class="panel panel-default">
<div class="panel-heading">
    <ul class="pagination"> 
</ul> 
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
	<input type="text" id="search" placeholder="Search by Item Name...." class="form-control"/>	
		</div> 
</div>
<div id="collapse2" >
<div class="panel-body">

<?php
$sql = "SELECT id, item_type, item_form, pack_description, fixed_mrp, non_batch_item, item_name, category, item_mrp, non_expiry_item, item_code, sub_category, tax_type
		, non_mrp_item, hsn_code FROM item_table_master";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows ($result)>0){
	echo '<table class="table table-striped" id="table">';
	echo '<thead>';
	echo '<tr><th>SNo.</th><th>Item Type</th><th>Item Form</th><th>Pack Description</th><th>Is Fixed Price?</th><th>Non Batch Item?</th>
			<th>Item Name</th><th>Category</th><th>Item MRP</th><th>Non-Expiry Item?</th><th>Item Code</th><th>Sub-Category</th><th>Tax Type</th>
			<th>Non MRP Item?</th><th>HSN Code</th><th>Edits</th><th>Info</info></tr>';
	echo '</thead>';
	echo '<tbody id="searchTableBody">';
	
	while($row = mysqli_fetch_assoc($result)){
	
	}	
	echo '</tbody>';
	echo '</table>';	
}else {
	echo "0 results";
}

mysqli_close($conn);
?>
</div>
</div>
</div>
</div>
</body>
</html>