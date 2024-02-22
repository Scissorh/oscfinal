<?php
if (isset($_GET['edit_account'])) {
    $user_name = $_SESSION['username'];
    $select_query = "Select * from user where user_name = '$user_name' ";
    $run_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($run_query);
    $user_id = $row['user_id'];
    $username = $row['user_name'];
    $email = $row['user_email'];
    $address = $row['user_address'];
    $mobile = $row['user_mobile'];
}
if (isset($_POST['user_update'])) {
    $update_id = $user_id;
    $user_name = $_POST['username'];
    $user_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_mobile = $_POST['mobile'];
    $userimage = $_FILES['image']['name'];
    $userimage_tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($userimage_tmp, "./user_images/$userimage");

    //update query
    $update_table = "Update user SET user_name='$user_name', user_email ='$user_email',
        user_image = '$userimage', user_address = '$u_address',user_mobile = '$u_mobile' where user_id = $update_id";
    $run_query_update = mysqli_query($con, $update_table);
    if ($run_query_update) {
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('./logout.php','_self')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success mb-4">
        Edit Account
    </h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center" autocomplete="off">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="file" class="form-control w-50 m-auto" name="image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="address" value="<?php echo $address; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="number" class="form-control w-50 m-auto" name="mobile" value="<?php echo $mobile; ?>">
        </div>

        <input type="submit" value="update" class="bg-secondary py-2 px-3 border-0 text-light" name="user_update">
    </form>
</body>

</html>