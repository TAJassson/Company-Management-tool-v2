<?php include_once('./m_header.php'); ?>
<html>
<head>
    <meta charset="utf-8">
    <script src="jquery.js"></script>
</head>
<body>
<?php
include_once 'db.php';
$orderID = $_POST['orderID'];
$newdate = $_POST['newdate'];

$select = "Select * From user_order WHERE orderID = '$orderID';";
$result=mysqli_query($conn,$select);
$num_rows = mysqli_num_rows($result);
if (isset($_POST['editStatus']) && !empty($_POST['editStatus'])) {
    if ($_POST['editStatus'] == "Edit Status") {
        $new_status = $_POST['status'];
        $update = "UPDATE `user_order` SET `order_status`='$new_status' WHERE `orderID`='$orderID'";
        $result=mysqli_query($conn,$update);
        header("Location: ./m_control.php");
    }
}
if (isset($_POST['delete']) && !empty($_POST['delete'])) {
    if ($_POST['delete'] == "Delete order") {
        $new_status = $_POST['status'];
        $update = "DELETE FROM `user_order` WHERE `orderID` = '$orderID';";
        $result=mysqli_query($conn,$update);
        header("Location: ./m_control.php");
    }
}
?>

<table border="1" class="table table-striped table-hover" >
    <thead>
    <tr>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Suggest Retails Price</th>
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
            <td><h3><S><?=$totalPrice?> HKD$ </S><br><?=$n_totalPrice?> HKD$ </h3></td>
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
<div class="row">
    <div class="col-6">
        <h2>Type: <?=$type_name?></h2><br>
        <h2>Location: <?=$b_name?></h2><br>
        <h2>Pick-Up Date: <?=$getDate?></h2><br>
        <h2>Pick-Up Time: <?=$getTime?></h2><br>
    </div>
    <div class="col-6">
        <h2><?=$type_name?> Address:</h2>
        <br><?=$b_address?><br>
        <br>
    </div>
</div>

<?php }else {?>
<div class="row">
    <div class="col-6">
        <h2>Type: <?=$type_name?></h2><br>
        <h2>Pick-Up Date: <?=$getDate?></h2><br>
        <h2>Pick-Up Time: <?=$getTime?></h2><br>
    </div>
    <div class="col-6">
        <h2><?=$type_name?> Address:</h2>
        <br><?=$user_address?><br>
        <br>
    </div>
</div>

<?php } ?>

<a href="m_control.php" class="btn btn-info">Back</a>
</body>
</html>
