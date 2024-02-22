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
    <title>ShofSher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style.css">
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
                            <a class="nav-link text-white active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./users/user_register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Contact</a>
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
                        <a class='nav-link' href='./users/user_login.php'>Login</a>
                        </li>";
                } else {
                    echo
                    "<li class='nav-item'>
                        <a class='nav-link' href='./users/logout.php'>Logout</a>
                        </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- second child -->

        <div class="bg-light">
            <h3 class="text-center">Shopping Store</h3>

        </div>
        <!-- forth section -->
        <div class="row">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                    <!-- first card -->
                    <!-- fetching products -->
                    <?php
                    search_product();
                    getUniqueCategories();
                    getUniqueBrands();
                    ?>
                    <!-- first card ends -->
                </div>
                <!-- row ends -->
            </div>
            <!-- col ends -->
            <div class="col-md-2 bg-secondary p-0">
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>
                    <?php
                    getBrands();
                    ?>
                </ul>

                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Categories</h4>
                        </a>
                    </li>
                    <?php
                    getCategories()
                    ?>
                </ul>


            </div>
        </div>
        <div class="footer bg-dark">
            <p style="padding: 22px; color : white; text-align:center; font-size:18px">All Rights Reserved &copy;</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>