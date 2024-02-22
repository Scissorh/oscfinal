<?php
include('includes/conn.php');

function getProducts()
{
    global $con;

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $query = "Select * from products order by rand() limit 0,6";
            $res = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_keyword = $row['product_keyword'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image = $row['product_image'];
                $product_price = $row['product_price'];
                // $date = $row['Date'];
                // $status = $row['status'];
                echo "
                        <div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>
                        ";
            }
        }
    }
}

//Getting All the products

function get_All_Products()
{
    global $con;

    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $query = "Select * from products order by rand()";
            $res = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($res)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_keyword = $row['product_keyword'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                $product_image = $row['product_image'];
                $product_price = $row['product_price'];
                // $date = $row['Date'];
                // $status = $row['status'];
                echo "
                        <div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>
                        ";
            }
        }
    }
}

//Getting unique categories

function getUniqueCategories()
{
    global $con;

    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $query = "Select * from products where category_id = $category_id";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        if ($rows == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($res)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
            // $date = $row['Date'];
            // $status = $row['status'];
            echo "
                        <div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>
                        ";
        }
    }
}

//Getting brand categories

function getUniqueBrands()
{
    global $con;

    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $query = "Select * from products where brand_id = $brand_id";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        if ($rows == 0) {
            echo "<h2 class='text-center text-danger'>No Brand available</h2>";
        }
        while ($row = mysqli_fetch_assoc($res)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
            // $date = $row['Date'];
            // $status = $row['status'];
            echo "
                        <div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>
                        ";
        }
    }
}


function getBrands()
{
    global $con;
    $brands = "Select * from `brands`";
    $res_brand = mysqli_query($con, $brands);

    while ($fetch = mysqli_fetch_assoc($res_brand)) {
        $brand_title = $fetch['brand_title'];
        $brand_id = $fetch['brand_id'];
        echo "<li class='nav-item'>
                        <a href='index.php?brand=$brand_id' class='nav-link text-light'>
                        $brand_title
                        </a>
                    </li>";
    }
}

function getCategories()
{
    global $con;
    $cats = "Select * from categories";
    $res = mysqli_query($con, $cats);

    while ($fetch = mysqli_fetch_assoc($res)) {
        $cat_title = $fetch['category_title'];
        $cat_id = $fetch['category_id'];
        echo "<li class='nav-item'>
        <a href='index.php?category=$cat_id' class='nav-link text-light'>
        $cat_title
        </a>
    </li>";
    }
}

//Seaching Products
function search_product()
{
    global $con;

    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $searchQuery = "Select * from products where product_keyword like '%$search_data_value%'";
        $res = mysqli_query($con, $searchQuery);
        $rows = mysqli_num_rows($res);
        if ($rows == 0) {
            echo "<h2 class='text-center text-danger'>No results match</h2>";
        }
        while ($row = mysqli_fetch_assoc($res)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_keyword = $row['product_keyword'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_image = $row['product_image'];
            $product_price = $row['product_price'];
            // $date = $row['Date'];
            // $status = $row['status'];
            echo "
                        <div class='col-md-4 mb-3'>
                        <div class='card'>
                            <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                                <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price/-</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
                                <a href='#' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>
                        ";
        }
    }
}
// get ip address

function getIPAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// cart function
function cart()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_address = getIPAddress();
        $get_product_id = $_GET['add_to_cart'];
        $query = "Select * from `cart_detail` where ip_address = '$get_ip_address' and product_id = $get_product_id";
        $res = mysqli_query($con, $query);
        $rows = mysqli_num_rows($res);
        if ($rows > 0) {
            echo "<script>alert('This item is alredy add to cart')</script>";
            echo "<script>window.open('index.php')</script>";
        } else {
            $insert_query = "Insert Into cart_detail (product_id,ip_address,quantity) Values ($get_product_id,'$get_ip_address',0)";
            $res = mysqli_query($con, $insert_query);
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php')</script>";
        }
    }
}

// func to get item num

function cart_item()
{
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_address = getIPAddress();
        $query = "Select * from `cart_detail` where ip_address = '$get_ip_address' ";
        $res = mysqli_query($con, $query);
        $count_cart_items = mysqli_num_rows($res);
    } else {
        global $con;
        $get_ip_address = getIPAddress();
        $query = "Select * from `cart_detail` where ip_address = '$get_ip_address' ";
        $res = mysqli_query($con, $query);
        $count_cart_items = mysqli_num_rows($res);
    }
    echo $count_cart_items;
}

// total price function

function total_cart_price()
{
    global $con;
    $get_ip_address = getIPAddress();
    $total = 0;
    $query = "Select * from `cart_detail` where ip_address = '$get_ip_address' ";
    $res = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($res)) {
        $product_id = $row['product_id'];
        $select_roduct = "Select * from products where product_id = $product_id";
        $select_res = mysqli_query($con, $select_roduct);
        while ($row_product_price = mysqli_fetch_array($select_res)) {
            $product_price = array($row_product_price['product_price']);
            $product_sum = array_sum($product_price);
            $total = $total + $product_sum;
        }
    }
    echo $total;
}

//get user order details
function get_order()
{
    global $con;
    $username = $_SESSION['username'];
    $get_details = "Select * from user where user_name = '$username'";
    $run_query = mysqli_query($con, $get_details);
    while ($row = mysqli_fetch_array($run_query)) {
        $user_id = $row['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "Select * from orders where user_id = $user_id and status = 'pending'";
                    $run_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($run_order_query);
                    if ($row_count > 0) {
                        echo "<h3 class='text-center my-2'>You have <span class='text-danger'>$row_count</span> pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>Order Details</a></p>
                        ";
                    } else {
                        echo "<h3 class='text-center my-2'>You have 0 pending orders</h3>
                        <p class='text-center'><a href='index.php' class='text-dark'>Explore products</a></p>
                        ";
                    }
                }
            }
        }
    }
}
