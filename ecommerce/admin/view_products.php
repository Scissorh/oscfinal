<<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
	<style type="text/css">
		.productimg {
            width: 55px;
            height: 55px;
            object-fit: contain;
        }
	</style>
</head>
<body>
<h3 class="text-center text-success">All Products</h3>
<table class="table table-bordered mt-5">
	<thead class="bg-info">
		<tr>
			<th class="bg-info">Product Id</th>
			<th class="bg-info">Product Title</th>
			<th class="bg-info">Product Image</th>
			<th class="bg-info">Product Price</th>
			<!--<th class="bg-info">Total Sold</th>-->
			<th class="bg-info">Status</th>
			<th class="bg-info">Edit</th>
			<th class="bg-info">Delete</th> 
		</tr>
	</thead>
	<tbody>
		<?php
		global $con;
		$get_products = "Select * from products";
		$res = mysqli_query($con,$get_products);
		$num =0;
		while ($row=mysqli_fetch_assoc($res)) {
			$product_id = $row['product_id'];
			$product_title = $row['product_title'];
			$product_image = $row['product_image'];
			$product_price = $row['product_price'];
			$status = $row['status'];
			$num++;
			echo "
			<tr class='text-center'>
			<td class='bg-secondary text-light'>$product_id</td>
			<td class='bg-secondary text-light'>$product_title</td>
			<td class='bg-secondary text-light'><img src='./product_images/$product_image' class='productimg'/></td>
			<td class='bg-secondary text-light'>$product_price /-</td>
			
			<td class='bg-secondary text-light'>$status</td>
			<td class='bg-secondary text-light'><a href='index.php?edit_products=$product_id' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
			<td class='bg-secondary text-light'><a href='index.php?delete_products=$product_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
		</tr>	
			";
			
		}
		?>
		
	</tbody>
</table>
</body>
</html>


