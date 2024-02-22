<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-md-12">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" id="user_name" class="form-control" placeholder="Enter your username" name="user_name" required>
                    </div>
                    <!-- email -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email" name="user_email" required>
                    </div>
                    <!-- for image -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-label">User Iamge</label>
                        <input type="file" id="user_image" class="form-control" name="user_image">
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" name="user_password" required>
                    </div>
                    <!-- confirm password -->
                    <div class="form-outline mb-4">
                        <label for="user_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="user_confirm_password" class="form-control" placeholder="confirm password" name="user_confirm_password" required>
                    </div>
                    <!-- address field -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" name="user_address" required>
                    </div>
                    <!-- mobile number -->
                    <div class="form-outline mb-4">
                        <label for="user_mobile" class="form-label">Mobile Number</label>
                        <input type="text" id="user_mobile" class="form-control" placeholder="Enter your number" name="user_mobile" required>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="register" class="bg-dark text-light py-2 px-2 border-0 mb-2" name="user_register">
                        <p>Already have an account ? <a href="user_login.php" class="text-decoration-none">Login</a> </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!-- php code -->
<?php

include('./includes/conn.php');
include('./functions/common_fun.php');

if (isset($_POST['user_register'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $hash_password = password_hash($user_password, PASSWORD_DEFAULT);
    $user_confirm_password = $_POST['user_confirm_password'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];

    $user_ip = getIPAddress();

    move_uploaded_file($user_image_tmp, "./user_images/$user_image");

    // select query

    $select_query = "Select * from user where user_name = '$user_name' or user_email = '$user_email'";
    $result_select = mysqli_query($con, $select_query);
    $count_rows = mysqli_num_rows($result_select);

    if ($count_rows > 0) {
        echo "<script>alert('UserName and Email exists already')</script>";
    } else if ($user_password != $user_confirm_password) {
        echo "<script>alert('Password does not match')</script>";
    } else {
        // insert query
        $insert_query = "INSERT INTO `user`( `user_name`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES ('$user_name','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_mobile')";
        $execute = mysqli_query($con, $insert_query);

        if ($execute) {
            echo "<script>alert('Data inserted Successfully')</script>";
        } else {
            echo "Error";
        }
    }

    //Selecting the cart items
    $select_cart_item = "Select * from cart_detail where ip_address = '$user_ip'";
    $result = mysqli_query($con, $select_cart_item);
    $count_row = mysqli_num_rows($result);
    if ($count_row > 0) {
        $_SESSION['username'] = $user_name;
        echo "<script>alert('You have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('./index.php','_self')</script>";
    }
}

?>