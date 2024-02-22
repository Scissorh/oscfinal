<?php

include('../includes/conn.php');

if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    //select from the database
    $select_query = "Select * from categories where category_title='$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $numCount = mysqli_num_rows($result_select);
    if ($numCount > 0) {
        echo "<script>alert('This Category is present already in database')</script>";
    } else {

        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Category has been inserted successful')</script>";
        }
    }
}

?>
<h2 class="text-center my-2">Insert Categories</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text" id="basic-addon1">@</span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="insert_cat" value="Insert Categories">

    </div>
</form>