<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>

<body>
    <h3 class="text-danger mb-4">Delete Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto text-danger" name="delete" value="Delete Account">
        </div>
    </form>
</body>

</html>
<?php
$user_session = $_SESSION['username'];
if (isset($_POST['delete'])) {
    $delete_query = "Delete from user where user_name = '$user_session'";
    $res = mysqli_query($con, $delete_query);
    if ($res) {
        session_destroy();
        echo "<script>alert('Account deleted Successfully')</script>";
        echo "<script>window.open('./index.php','_self')</script>";
    }
}

?>