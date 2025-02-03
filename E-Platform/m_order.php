<?php include_once('./m_header.php'); ?>
    <meta charset="utf-8">
    <script src="jquery.js"></script>
<?php
include_once 'db.php';

?>
    <table border="1" class="table table-striped table-hover" >
        <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Delivery ID</th>		
            <th scope="col">User Name</th>
            <th scope="col">Order Time</th>
            <th scope="col">Delivery Type</th>
            <th scope="col">Discount</th>
            <th scope="col">Total Price</th>
            <th scope="col">Order Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $select = "Select * From user_order";
        $result=mysqli_query($conn,$select);
        $num_rows = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $orderID = $row["orderID"];
            $userID = $row["userID"];
            $type_name = $row["type_name"];
            $order_time = $row["order_time"];
            $quantity = $row["quantity"];
            $cashpoint = $row["cashpoint"];
            $totalPrice = $row["totalPrice"];
            $discount = $row["discount"];
            $n_totalPrice = $row["n_totalPrice"];
            $order_status = $row["order_status"];


            //converts seconds into a specific format
            $sec = strtotime($order_time);
            $newdate = date ("Y/d/m H:i", $sec);

            //get the username
            $select2 = "Select username From user_info WHERE userID = '$userID'";
            $results=mysqli_query($conn,$select2);
            while ($rows = mysqli_fetch_assoc($results)) {
                $username = $rows["username"];
            }

            echo "<form method='POST' action='m_order_handler.php'><tr>";
            echo "<input type='hidden' name='orderID' value='$orderID' >";
            echo "<input type='hidden' name='deliveryID' value='$orderID' >";
            echo "<input type='hidden' name='newdate' value='$newdate' >";
            echo "<input type='hidden' name='old_status' value='$order_status' >";
            echo "<input type='hidden' name='action' value='change'>";
            echo "<td >"."$orderID"."</td>";
            echo "<td >"."$orderID"."</td>";
            echo "<td >"."$username"."</td>";
            echo "<td >"."$newdate"."</td>";
            echo "<td >".$type_name."</td>";
            echo "<td >".$discount."</td>";
            echo "<td >$n_totalPrice</td>";
            ?>
            <td>
        <select name="status" id="p_state" value="<?=$order_status?>">
            <option value="completed" <?php if($order_status=="completed") echo 'selected="selected"'; ?>>completed</option>
            <option value="self-picked up" <?php if($order_status=="self-picked up") echo 'selected="selected"'; ?>>self-picked up</option>
            <option value="delivered" <?php if($order_status=="delivered") echo 'selected="selected"'; ?>>delivered</option>
            <option value="cancel" <?php if($order_status=="cancel") echo 'selected="selected"'; ?>>cancel</option>
        </select>
        </td>
        <?php
echo "<td>";
echo "<input name='editStatus' type='submit' value='Edit order'>";
echo "<input name='submit' type='submit' value='View detail'>";
echo "<input name='delete' type='submit' value='Delete order' onclick=\"return confirm('Confirm delete order?')\">";
echo "<br>";
echo "</td>";
echo "</form></tr>";
        }
        ?>
        </tbody>
    </table>








