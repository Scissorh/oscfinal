<?php
include('includes/conn.php');
include('functions/common_fun.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

//get the total items and price
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_get_ip = "Select * from cart_detail where ip_address = '$get_ip_address' ";
$res_get_ip = mysqli_query($con, $cart_get_ip);
$invoice_number = mt_rand();
$status = 'pending';

$count_products = mysqli_num_rows($res_get_ip);
while ($row_price = mysqli_fetch_array($res_get_ip)) {
    $product_id = $row_price['product_id'];
    $select_product = "Select * from products where product_id = $product_id";
    $res_product = mysqli_query($con, $select_product);
    while ($row_product_price = mysqli_fetch_array($res_product)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price += $product_values;
    }
}

//get quantity from cart

$get_cart = "select * from cart_detail";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quan = mysqli_fetch_array($run_cart);
$quantity = $get_item_quan['quantity'];
if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;
} else {
    $quantity = $quantity;
    $subtotal = $total_price * $quantity;
}

//inserting the data into order table

$insert_orders = "INSERT INTO orders (`user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `status`) VALUES ($user_id,$subtotal,$invoice_number,$count_products,NOW(),'$status')";
$result_insert = mysqli_query($con, $insert_orders);
if ($result_insert) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php','_self')</script>";
}

//insert pending order

$insert_orders_pending = "INSERT INTO orders_pending (`user_id`, `invoice_number`, `product_id`, `quantity`, `status`) VALUES ($user_id,$invoice_number,$product_id,$quantity,'$status') ";
$result_pending = mysqli_query($con, $insert_orders_pending);

//delete items from the cart

$empty_cart = "Delete from cart_detail where ip_address = '$get_ip_address'";
$delete_cart = mysqli_query($con, $empty_cart);
