<?php include_once('./header.php'); ?>
<html>
<head>
    <meta charset="utf-8">
    <script src="jquery.js"></script>
</head>
<body>
<?php
include_once 'db.php';
$userID = $_SESSION["id"];
$orderID = $_POST['orderID'];
$newdate = $_POST['newdate'];

$select = "Select * From user_order WHERE orderID = '$orderID';";
$result=mysqli_query($conn,$select);
$num_rows = mysqli_num_rows($result);
?>
    <table border="1" class="table table-striped table-hover" >
    <thead>
    <tr>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product HKD$</th>
        <th scope="col">Product quantity</th>
        <th scope="col">Total Price</th>
    </tr>
    </thead>
    <tbody>

<?php
while ($row = mysqli_fetch_assoc($result)) {

    $type_name = $row["type_name"];

    $p_id = $row["p_id"];
    $quantity = $row["quantity"];
    $cashpoint = $row["cashpoint"];
    $p_img = $row["p_img"];
    $p_name = $row["p_name"];

    $totalPrice = $row["totalPrice"];
    $discount = $row["discount"];
    $n_totalPrice = $row["n_totalPrice"];
    $order_status = $row["order_status"];

    $p_id = explode("<br>", $p_id);
    $p_id_count = count($p_id);

    foreach($p_id as $i =>$key) {
        $n_p_id[$i] = $key;
    }

    $quantity = explode("<br>", $quantity);
    $quantity_count = count($quantity);

    foreach($quantity as $i =>$key) {
        $n_quantity[$i] = $key;
    }

    $cashpoint = explode("<br>", $cashpoint);
    $cashpoint_count = count($cashpoint);

    foreach($cashpoint as $i =>$key) {
        $n_cashpoint[$i] = $key;
    }



    $p_img = explode("<br>", $p_img);
    $p_img_count = count($p_img);

    foreach($p_img as $i =>$key) {
        $n_p_img[$i] = $key;
    }

    $p_name = explode("<br>", $p_name);
    $p_name_count = count($p_name);

    foreach($p_name as $i =>$key) {
        $n_p_name[$i] = $key;
    }

    if ($type_name == "Self Pick-up") {
        $b_name = $row["b_name"];
        $b_address = $row["b_address"];
        $getDate = $row["getDate"];
        $getTime = $row["getTime"];
        $getTime = date("G:i", strtotime($getTime));

    }else if($type_name == "Delivery") {
        $user_address = $row["user_address"];
        $getDate = $row["getDate"];
        $getTime = $row["getTime"];
        $getTime = date("G:i", strtotime($getTime));

    }

    $x=0;
    while ($x < $p_id_count) {
        echo "<td >"."<img src='$n_p_img[$x]' style=\"max-width:30%\">"."</td>";
        echo "<td >".$n_p_name[$i]."</td>";
        echo "<td >".$n_cashpoint[$x]."</td>";
        echo "<td >"."$n_quantity[$x]"."</td>";
        $total = $n_quantity[$x]*$n_cashpoint[$x];
        echo "<td >"."$total"."</td>";
        echo "</tr>";
        $x++;
    }

}

if ($type_name == "Self Pick-up") { ?>
<tr>
    <td>5% DISCOUNT OFF!</td>
    <td></td>
    <td></td>
    <td><h3><?=$p_id_count?> items</h3></td>
    <td><h3><S><?=$totalPrice?> HKD$</S><br><?=$n_totalPrice?> HKD$</h3></td>
</tr>
<?php }else { ?>
<tr>
<td></td>
<td></td>
<td></td>
<td><h3><?=$p_id_count?> items</h3></td>
<td><h3><?=$totalPrice?> HKD$</h3></td>
</tr>
<?php } ?>
</tbody>
</table>
<br>
<br>



<?php if ($type_name == "Self Pick-up") { ?>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Information</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Phone</th>
                <td><?=$_SESSION["phone"]?></td>
            </tr>

            <tr>
                <th scope="row">Email</th>
                <td><?=$_SESSION["email"]?></td>
            </tr>

            <tr>
                <th scope="row">Type</th>
                <td><?=$type_name?></td>
            </tr>

            <tr>
                <th scope="row">Location</th>
                <td><?=$b_name?></td>
            </tr>

            <tr>
                <th scope="row">Pick-Up Date:</th>
                <td colspan="2"><?=$getDate?></td>
            </tr>

            <tr>
                <th scope="row">Pick-Up Time:</th>
                <td colspan="2"><?=$getTime?></td>
            </tr>
            <tr>
                <th scope="row">Self pick-up Address:</th>
                <td colspan="2"><?=$b_address?></td>
            </tr>
            </tbody>
        </table>
    </div>


<?php }else {?>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Information</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Phone</th>
                <td><?=$_SESSION["phone"]?></td>
            </tr>

            <tr>
                <th scope="row">Email</th>
                <td><?=$_SESSION["email"]?></td>
            </tr>

            <tr>
                <th scope="row">Type</th>
                <td><?=$type_name?></td>
            </tr>

            <tr>
                <th scope="row">Pick-Up Date:</th>
                <td colspan="2"><?=$getDate?></td>
            </tr>

            <tr>
                <th scope="row">Pick-Up Time:</th>
                <td colspan="2"><?=$getTime?></td>
            </tr>
            <tr>
                <th scope="row">Self pick-up Address:</th>
                <td colspan="2"><?=$user_address?></td>
            </tr>
            </tbody>
        </table>
    </div>

<?php } ?>
<a href="view_order.php" class="btn btn-info">Back</a>
</body>
</html>
