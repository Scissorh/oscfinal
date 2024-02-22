<?php

if(isset($_GET['delete_brands'])){
	$delete_brand = $_GET['delete_brands'];

	$delete_query = "Delete from brands where brand_id=$delete_brand ";
	$result = mysqli_query($con,$delete_query);
	if($result){
		echo "<script>alert('Brand deleted Successfully')</script>";
		echo "<script>window.open('./index.php?view_brands','_self')</script>";
	}
}

?>