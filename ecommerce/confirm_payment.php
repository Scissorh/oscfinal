<?php
include('includes/conn.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-secondary">
    <?php

    //$order_id = $_GET['order_id'];
    //echo "hello";
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        //echo $order_id;
        $select_data = "Select * from orders where order_id = $order_id";
        $result = mysqli_query($con, $select_data);
        $row = mysqli_fetch_assoc($result);
        $invoice_number = $row['invoice_number'];
        $amount = $row['amount_due'];
    }
    if (isset($_POST['confirm_payment'])) {
        $invoice_number = $_POST['invoice_number'];
        $amount = $_POST['amount'];
        $payment_mode = $_POST['payment_mode'];
        $insert_query = "INSERT INTO `user_payments`( `order_id`, `invoice_number`, `amount`, `payment_mode`) VALUES ($order_id,$invoice_number,$amount,'$payment_mode')";
        $res = mysqli_query($con, $insert_query);
        if ($res) {
            echo "<h3 class='text-center text-light'>Payment successful</h3>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";
        }
        $update_orders = "update orders  set status = 'Complete' where order_id = $order_id";
        $res_update = mysqli_query($con, $update_orders);
    }
    ?>
    <h1 class="text-center text-light">Confirm Payment</h1>

    <div class="container my-5">
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number;  ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light">Amount:</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount;  ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment mode</option>
                    <option>UPI</option>
                    <option>Paypal</option>
                    <option>Netbanking</option>
                    <option>Cash on Delivery</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" name="confirm_payment" class="bg-info py-2 px-3 border-0" value="Confirm">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>