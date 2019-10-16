<?php
include("Canteen_Connection.php");
?>
<?php
    $sql="select * from sub_category_master_table where category_id ='$_POST[cat]'";
	$result=mysqli_query($conn, $sql);
	?>
	<select class="form-control" name="sub_category" id="subcategory">
    <option value="">Select Sub Category</option>
	<?php
    while($row=mysqli_fetch_assoc($result))
	{
	?>
    <option value="<?php echo $row['category_id'];?>" <?php if($row['category_id']==$row['sub_category_id']){ echo "selected";}?>><?php echo $row['sub_category_name'];?></option>
    <?php
	}
	?>