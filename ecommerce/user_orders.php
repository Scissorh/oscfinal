<?php
$user_name = $_SESSION['username'];
$select_query = "Select * from user where user_name = '$user_name' ";
$run_query = mysqli_query($con, $select_query);
$row = mysqli_fetch_assoc($run_query);
$user_id = $row['user_id'];

?>
<h3 class="text-center text-success mb-4">
    All my orders
</h3>

<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr>
            <th>SI no</th>
            <th>Amount due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/not</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody class="bg-secondary">
        <?php
        $get_orders = "Select * from orders where user_id = $user_id ";
        $result = mysqli_query($con, $get_orders);
        $num = 1;
        while ($row = mysqli_fetch_assoc($result)) {

            $order_id = $row['order_id'];
            $amout = $row['amount_due'];
            $invoice = $row['invoice_number'];
            $total_products = $row['total_products'];
            $date = $row['order_date'];
            $status = $row['status'];
            if ($status == 'pending') {
                $status = 'Incomplete';
            } else {
                $status = 'Complete';
            }

            echo "
                <tr>
                <td>$num</td>
                <td>$amout</td>
                <td>$total_products</td>
                <td>$invoice</td>
                <td>$date</td>
                <td>$status</td>";
        ?>
        <?php
            if ($status == 'Complete') {
                echo "<td>Paid</td>";
            } else {
                echo "<td><a href='confirm_payment.php?order_id=$order_id'>Confirm </a></td>";
            }
            "
            </tr>
            ";
            $num++;
        }
        ?>

    </tbody>
</table>