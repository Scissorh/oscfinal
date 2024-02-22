<?php
if(isset($_GET['edit_products']))
{
	$edit = $_GET['edit_products'];
	//echo $edit;
	$get_data = "Select * from products where product_id= $edit";
	$result = mysqli_query($con,$get_data);
	$row = mysqli_fetch_assoc($result);
	$product_title = $row['product_title'];
	$product_description = $row['product_description'];
	$product_keyword= $row['product_keyword'];
	$category_id = $row['category_id'];
	$brand_id = $row['brand_id'];
	$product_image = $row['product_image'];
	$product_price = $row['product_price'];

	// fetching category name
	$select_category = "Select * from categories where category_id = $category_id";
	$result_category = mysqli_query($con,$select_category);
	$row_category = mysqli_fetch_assoc($result_category);
	$category_title = $row_category['category_title'];
	//echo $category_title;

	// fetching brands name
	$select_brand = "Select * from brands where brand_id = $brand_id";
	$result_brand = mysqli_query($con,$select_brand);
	$row_brand = mysqli_fetch_assoc($result_brand);
	$brand_title = $row_brand['brand_title'];
	//echo $brand_title;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Document</title>
</head>
<body>
	<div class="container mt-5">
		<h2 class="text-center">Edit Product</h2>	
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_title" class="form-label">Product Title</label>
				<input type="text" name="product_title" value="<?php echo $product_title;  ?>" id="product_title" class="form-control" required>
			</div>
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_desc" class="form-label">Product Description</label>
				<input type="text" name="product_desc" value="<?php echo $product_description;  ?>" id="product_desc" class="form-control" required>
			</div>
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_keywords" class="form-label">Product Keywords</label>
				<input type="text" name="product_keyword" id="product_keywords" value="<?php echo $product_keyword;  ?>" class="form-control" required>
			</div>
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_category" class="form-label">Product Category</label>
				<select name="product_category" class="form-select">
						<option value="<?php echo $category_title  ?>"><?php echo $category_title  ?></option>
						<?php
							$select_category_all = "Select * from categories";
	                        $result_category_all = mysqli_query($con,$select_category_all);
	                        while($row_category_all = mysqli_fetch_assoc($result_category_all)){
		                    $category_title_mix = $row_category_all['category_title'];
		                    $category_id_mix = $row_category_all['category_id']	;
		                    echo "<option value='$category_id_mix'>$category_title_mix</option>					";
	                          }
	
						?>
						
				</select>
			</div>
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_brands" class="form-label">Product brands</label>
				<select name="product_brands" class="form-select">
						<option value="<?php echo $brand_title  ?>"><?php echo $brand_title  ?></option>
						<?php
							$select_brand_all = "Select * from brands";
	                        $result_brand_all = mysqli_query($con,$select_brand_all);
	                        while($row_brand_all = mysqli_fetch_assoc($result_brand_all)){
		                    $brand_title_mix = $row_brand_all['brand_title'];
		                    $brand_id_mix = $row_brand_all['brand_id']	;
		                    echo "<option value='$brand_id_mix'>$brand_title_mix</option>					";
	                          }
	
						?>
				</select>
			</div>
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_image" class="form-label">Product Image</label>
				<input type="file" name="product_image" id="product_image" class="form-control">
			</div>
			<div class="form-outline w-50 m-auto mb-4">
				<label for="product_price" class="form-label">Product Price</label>
				<input type="text" name="product_price" value="<?php echo $product_price;  ?>" id="product_price" class="form-control" required>
			</div>
			<div class="text-center">
				<input type="submit" name="edit_product" value="Update Product" class="btn btn-info px-3 mb-3">
			</div>
		</form>
	</div>

	<?php
	if(isset($_POST['edit_product'])){
		$product_title = $_POST['product_title'];
		$product_desc = $_POST['product_desc'];
		$product_keyword = $_POST['product_keyword'];
		$product_category = $_POST['product_category'];
		$product_brands = $_POST['product_brands'];
		$product_image = $_FILES['product_image'];
		$product_price = $_POST['product_price'];

		$product_image = $_FILES['product_image']['name'];
		$temp_image = $_FILES['product_image']['tmp_name'];

		if($product_title == '' or $product_desc == '' or $product_keyword == '' or $product_category == '' or $product_brands == '' or $product_image == '' or $product_price == ''){
			echo "<script>alert('Please fill all the fields')</script>";
		}else{

		
		
			move_uploaded_file($temp_image,"./product_images/$product_image");
			// query to update products
			$update_products = "update products set product_title = '$product_title', product_description = '$product_desc', product_keyword = '$product_keyword', category_id = $product_category,brand_id = $product_brands , product_image = '$product_image',product_price = $product_price,date = NOW() where product_id=$edit ";
			$run_query = mysqli_query($con,$update_products);
			if($run_query){
				echo "<script>alert('Product updated successfully')</script>";	
				echo "<script>window.open('./index.php?insert_products','_self')</script>";
			}

		}
	}

	?>
</body>
</html>