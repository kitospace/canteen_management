<?php
include("Canteen_Connection.php");
if(isset($_POST)){
if (isset($_POST['search'])) {
	
   $item_name = $_POST['search'];
   $sql = "SELECT * FROM item_table_master WHERE item_name LIKE '%$item_name%' LIMIT 5";
   $result = mysqli_query($conn, $sql);  
		if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_assoc($result)){
		echo '<table id="table"><tr><td>'.$row['id'].'</td><td>'.$row['item_type'].'</td><td>'.$row["item_form"].'</td><td>'.$row['pack_description'].'</td>
			<td>'.$row["fixed_mrp"].'</td><td>'.$row["non_batch_item"].'</td><td>'.$row["item_name"].'</td><td>'.$row["category"].'</td><td>'.$row["item_mrp"].'</td>
			<td>'.$row["non_expiry_item"].'</td><td>'.$row["item_code"].'</td><td>'.$row["sub_category"].'</td><td>'.$row["tax_type"].'</td><td>'.$row["non_mrp_item"].'</td>
			<td>'.$row["hsn_code"].'</td>
			<td><a href="item_master.php?item_id='.$row['id'].'&mode=edit" class="btn btn-info btn-sm panel-collapse" onclick="update()">Edit</a></td>
			<td><a href="item_master.php?item_id='.$row['id'].'&mode=info" class="btn btn-danger btn-sm panel-collapse">Info</a></td></tr></table>';
}}}}
?> 
