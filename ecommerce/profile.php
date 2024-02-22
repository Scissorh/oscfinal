<?php

include('includes/conn.php');
include('functions/common_fun.php');
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'];  ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
    <style>
        body {
            overflow-x: hidden;
        }

        .profile_img {}
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="">
                    <img src="./images/logo.jpg" alt="logo" class="logo">
                </a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link text-white active" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./user_register.php">My account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();  ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Total Price: <?php total_cart_price();  ?>/-</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get" style="margin-left: 520px;">
                        <input class="form-control m-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
                        <input type="submit" value="search" class="btn border border-white text-white py-0" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>

        <!-- first child -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

                <?php
                if (!isset($_SESSION['username'])) {
                    echo
                    "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome guest</a>
                </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href=''>Welcome " . $_SESSION['username'] . "</a>
                        </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='./user_login.php'>Login</a>
                        </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='./logout.php'>Logout</a>
                        </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- second child -->

        <div class="bg-light">
            <h3 class="text-center m-2">Shopping Store</h3>
        </div>

        <!-- third child -->
        <div class="row my-4">
            <div class="col-md-2 col-lg-2">
                <ul class="navbar-nav bg-secondary text-center" style="height: 100vh;">
                    <li class="nav-item bg-info my-2">
                        <a class="nav-link text-white" href="#">
                            <h4>Your Profile</h4>
                        </a>
                    </li>
                    <?php
                    $username = $_SESSION['username'];
                    $fetch_image = "Select * from user where user_name = '$username'";
                    $result_fetch = mysqli_query($con, $fetch_image);
                    $row = mysqli_fetch_array($result_fetch);
                    $user_image = $row['user_image'];
                    echo
                    "<li class='nav-item'>
                        <img src='./user_images/$user_image' alt='imag class='profile_img' style=' width: 83%;
                        margin: auto;
                        display: block;
                        height: 90%;'>
                    </li>";
                    ?>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="profile.php">
                            Pending Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profile.php?edit_account">
                            Edit account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profile.php?my_orders">
                            My Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="profile.php?delete_account">
                            Delete account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./logout.php">
                            Logout
                        </a>
                    </li>
                </ul>


            </div>
            <div class="col-md-10 col-lg-10 text-center">
                <?php
                get_order();
                if (isset($_GET['edit_account'])) {
                    include('./edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    include('./user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('./delete_account.php');
                }
                ?>
            </div>
        </div>

        <!-- third child ends -->


    </div>

    <?php
    include('./includes/footer.php')
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>