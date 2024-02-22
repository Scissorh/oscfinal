<?php

include('../includes/conn.php');

if (isset($_POST['insert_brands'])) {
    $brand_title = $_POST['brand_title'];

    //select from the database
    $select_query = "Select * from brands where brand_title='$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $numCount = mysqli_num_rows($result_select);
    if ($numCount > 0) {
        echo "<script>alert('This Brand is present already in database')</script>";
    } else {

        $insert_query = "INSERT INTO `brands` (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Brand has been inserted successful')</script>";
        }
    }
}

?>

<h2 class="text-center m-2">Insert Brands</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <!-- <input type="submit" class="form-control bg-info" name="insert_cat" value="Insert Categories"> -->
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_brands" value="Insert Brands">
    </div>
</form>