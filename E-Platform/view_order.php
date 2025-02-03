<?php include_once('./header.php'); ?>
<meta charset="utf-8">
<script src="jquery.js"></script>
<?php
include_once 'db.php';

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) { ?>
    <table border="1" class="table table-striped table-hover" >
    <thead>
    <tr>
        <th scope="col">Order Time</th>
        <th scope="col">Delivery Type</th>
        <th scope="col">Discount</th>
        <th scope="col">Total Price</th>
        <th scope="col">Order Status</th>
        <th scope="col">Button</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $userID = $_SESSION["id"];
    $select = "Select * From user_order WHERE userID = '$userID' ORDER BY order_time DESC;";
    $result=mysqli_query($conn,$select);
    $num_rows = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $orderID = $row["orderID"];
        $type_name = $row["type_name"];
        $order_time = $row["order_time"];
        $quantity = $row["quantity"];
        $cashpoint = $row["cashpoint"];
        $totalPrice = $row["totalPrice"];
        $discount = $row["discount"];
        $n_totalPrice = $row["n_totalPrice"];
        $order_status = $row["order_status"];

        $sec = strtotime($order_time);
        //converts seconds into a specific format
        $newdate = date ("Y/d/m H:i", $sec);

        echo "<form method='POST' action='view_order_detail.php'><tr>";
        echo "<input type='hidden' name='orderID' value='$orderID' >";
        echo "<input type='hidden' name='newdate' value='$newdate' >";
        echo "<input type='hidden' name='action' value='change' >";
        echo "<td >"."$newdate"."</td>";
        echo "<td >".$type_name."</td>";
        echo "<td >".$discount."</td>";
        echo "<td >$n_totalPrice</td>";
        echo "<td >"."$order_status"."</td>";
        echo "<td >"."<input name='submit' type='submit' value='View Detail' class=\"btn btn-info\"><br>"."</td>";
        echo "</form></tr>";
    }
    ?>
    </tbody>
    </table>

    <?php
}else {
    ?>
    <div class="alert alert-danger">
        <a href="login.php" class="alert-link">Please Login First!</a>
    </div>
    <script>
        if(<?=strcmp($row["email"],$email)?> == 0) {
            window.setTimeout(function(){
                window.location.href = "login.php";
            }, 1500);
        }
    </script>
    <?php
}
