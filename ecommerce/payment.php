<?php
include('includes/conn.php');
include('functions/common_fun.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        img {
            width: 100%;
        }
    </style>
</head>

<?php
$user_ip = getIPAddress();
$get_user = "Select * from user where user_ip ='$user_ip' ";
$res = mysqli_query($con, $get_user);
$array = mysqli_fetch_array($res);
$user_id = $array['user_id'];

?>
<?php
include('./includes/header.php');
?>
<div class="container">
    <h2 class="text-center text-info">Payment Options</h2>
    <div class="row d-flex justify-content-center align-items-center my-5">
        <div class="col-lg-6 col-md-6">
            <a href="https://www.paypal.com" target="_blank"><img src="./images/upi.jpg" alt=""></a>
        </div>
        <div class="col-lg-6 col-md-6">
            <a href="order.php?user_id=<?php echo $user_id; ?>" target="_blank">
                <h2 class="text-center">Pay Offline</h2>
            </a>
        </div>

    </div>
</div>

<?php
include('./includes/footer.php')
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<body>

</body>

</html>