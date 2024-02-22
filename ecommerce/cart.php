<?php

include('includes/conn.php');
include('functions/common_fun.php');
session_start()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Detail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
    <style>
        .cart-img {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }
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
                            <a class="nav-link text-white active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./user_register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();  ?></sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
        cart();
        ?>

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
                        <a class='nav-link' href='user_login.php'>Login</a>
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

        <div class="bg-light mb-4 mt-2">
            <h3 class="text-center">Shopping Store</h3>

        </div>

        <!-- Third Child -->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center">

                        <?php

                        $get_ip_address = getIPAddress();
                        $total = 0;
                        $query = "Select * from `cart_detail` where ip_address = '$get_ip_address' ";
                        $res = mysqli_query($con, $query);
                        $result_count = mysqli_num_rows($res);
                        if ($result_count > 0) {
                            echo "
                                    <thead>
                                    <tr>
                                        <th>Product Title</th>
                                        <th>Product Image</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                        <th>Remove</th>
                                        <th colspan='2'>Operations</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
                            while ($row = mysqli_fetch_array($res)) {
                                $product_id = $row['product_id'];
                                $select_roduct = "Select * from products where product_id = $product_id";
                                $select_res = mysqli_query($con, $select_roduct);
                                while ($row_product_price = mysqli_fetch_array($select_res)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image = $row_product_price['product_image'];
                                    $product_sum = array_sum($product_price);
                                    $total = $total + $product_sum;


                        ?>
                                    <tr>
                                        <td><?php echo $product_title; ?></td>
                                        <td><img src="./admin/product_images/<?php echo $product_image; ?>" alt="#" class="cart-img"></td>
                                        <td><input type="text" name="quantity"></td>
                                        <?php
                                        $get_ip_address = getIPAddress();
                                        if (isset($_POST['update_cart'])) {
                                            $quantity = $_POST['quantity'];
                                            $upadte_cart = "update cart_detail set quantity=$quantity where ip_address =  '$get_ip_address'";
                                            $res_update = mysqli_query($con, $upadte_cart);
                                            $total = $total * $quantity;
                                        }
                                        ?>
                                        <td><?php echo $price_table; ?>/-</td>
                                        <td><input type="checkbox" name="removeItem[]" value="<?php echo $product_id; ?>"></td>

                                        <td>

                                            <input type="submit" value="Update cart" name="update_cart" class="bg-info p-2 border-0">
                                            <input type="submit" value="Remove cart" name="remove_cart" class="bg-info p-2 border-0">
                                        </td>
                                    </tr>
                        <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Cart is Empty</h2> ";
                        }
                        ?>
                        </tbody>
                    </table>
                    <!-- total -->
                    <div class="d-flex mb-5">
                        <?php
                        $get_ip_address = getIPAddress();
                        $total = 0;
                        $query = "Select * from `cart_detail` where ip_address = '$get_ip_address' ";
                        $res = mysqli_query($con, $query);
                        $result_count = mysqli_num_rows($res);
                        if ($result_count > 0) {
                            echo "
                            <h4 class='px-3'>Total : <strong> $total/-</strong></h4>
                        <button class='bg-secondary p-2 border-0' style='margin-right : 5px; '><a href='./checkout.php' class='text-light text-decoration-none'>Checkout</a></button>
                        <button class='bg-info p-2 border-0'><a href='./payment.php' class='text-light text-decoration-none'>Payment</a></button>   
                            ";
                        }
                        ?>

                    </div>

            </div>
        </div>
        </form>

        <!-- function to remove item -->
        <?php
        function remove_cart_item()
        {
            global $con;
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeItem'] as $remove_id) {
                    echo $remove_id;
                    $delete_query = "Delete from cart_detail where product_id = $remove_id";
                    $run_delete = mysqli_query($con, $delete_query);
                    if ($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        echo $removeitem = remove_cart_item();
        ?>
        <!-- footer Section -->

        <div class="footer bg-dark">
            <p style="padding: 22px; color : white; text-align:center; font-size:18px">All Rights Reserved &copy;</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>