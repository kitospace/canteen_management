<?php


	if(isset($_GET['mode'])&&$_GET['mode']=='info'){
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
			header('Location:item_master.php');
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



		<table style="width=100%" align="center">
		<tr>
			<td><b>Item Type   :</b></td>
			<td><?php echo (isset($item_type))?$item_type:'';?></td>

			<td><b>Item Name   :</b></td>
			<td><?php echo (isset($item_name))?$item_name:'';?></td>
		</tr>
		<tr>
			<td><b>Item Code   :</b></td>
			<td><?php echo (isset($item_code))?$item_code:'';?></td>
		
			<td><b>HSN Code    : </b></td>
			<td><?php echo (isset($hsn_code))?$hsn_code:'';?></td>
		</tr>
		<tr>
			<td><b>Item Form   :</b></td>
			<td><?php echo (isset($item_form))?$item_form:'';?></td>
		
			<td><b>Category    : </b></td>
			<td><?php echo (isset($category))?$category:'';?></td>
		</tr>
		<tr>
			<td><b>Sub-Category : </b></td>
			<td><?php echo (isset($sub_category))?$sub_category:'';?></td>
		
			<td><b>Pack Description: </b></td>
			<td><?php echo (isset($pack_description))?$pack_description:'';?></td>
		</tr>
		<tr>
			<td><b>Item MRP      : </b></td>
			<td><?php echo (isset($item_mrp))?$item_mrp:'';?></td>
		
			<td><b>Tax Type      : </b></td>
			<td><?php echo (isset($tax_type))?$tax_type:'';?></td>
		</tr>
		<tr>
			<td><b>Fixed MRP      : </b></td>
			<td><?php echo (isset($fixed_mrp))?$fixed_mrp:'';?></td>
		
			<td><b>Non-Expiry Item  : </b></td>
			<td><?php echo (isset($non_expiry_item))?$non_expiry_item:'';?></td>
		</tr>
		<tr>
			<td><b>Non-Batch Item  :</b></td>
			<td><?php echo (isset($non_batch_item))?$non_batch_item:'';?></td>
		
			<td><b>Non-MRP Item    :</b></td>
			<td><?php echo (isset($non_mrp_item))?$non_mrp_item:'';?></td>
		</tr>		
		</table>
		<table style="width=100%" align="right">
		<tr><?php
			echo '<td><a href="item_master.php?item_id='.$item_id.'&mode=edit" class="btn btn-info btn-md btn-block" onclick="update()">Edit</a></td>
			<td><a href="item_master.php?item_id='.$item_id.'&mode=new" class="btn btn-warning btn-block btn-md">New </a></td>';
            ?> 
		</tr>
		</table>
		




