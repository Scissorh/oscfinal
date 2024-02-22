<?php
@session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<style>
    body {
        overflow-y: hidden;
    }
</style>

<body>

    <div class="container-fluid my-3">
        <h2 class="text-center mb-5">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-md-12">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" id="user_name" class="form-control" placeholder="Enter your username" name="user_name" required>
                    </div>

                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" name="user_password" required>
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Login" class="bg-dark text-light py-2 px-2 border-0 mb-2" name="user_login">
                        <p>Don't have an account ? <a href="user_register.php" class="text-decoration-none">Register</a> </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include('./includes/conn.php');
include('./functions/common_fun.php');

if (isset($_POST['user_login'])) {
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];

    $select_query = "Select * from user where user_name='$username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    //cart
    $select_cart = "Select * from cart_detail where ip_address = '$user_ip'";
    $run_query = mysqli_query($con, $select_cart);
    $row_count_cart = mysqli_num_rows($run_query);
    if ($row_count > 0) {
        $_SESSION['username'] = $username;
        if (password_verify($password, $row_data['user_password'])) {
            if ($row_count == 1 and $row_count_cart == 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('./profile.php','_self')</script>";
            } else {
                $_SESSION['username'] = $username;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('./profile.php','_self')</script>";
            }
            //
        } else {
            echo "<script>alert('Password and username does not match')</script>";
        }
    } else {
        echo "<script>alert('Password and username does not match')</script>";
    }
}

?>