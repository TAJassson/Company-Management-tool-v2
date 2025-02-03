<?php
include_once('./header.php');
include_once 'db.php';
$type = $_COOKIE["type"];
$userID = $_SESSION["id"];

//set time zone
date_default_timezone_set('Asia/Hong_Kong');
//set time to special format
$time = date('Y-m-d H:i:s');

if (isset($_COOKIE['type']) && !empty($_COOKIE['type'])) {
    $totalPrice = $_COOKIE['totalPrice'];

    $product_id = "";
    $cashpoint = "";
    $quantity = "";
    $p_img = "";
    $p_name = "";
    foreach($_SESSION['cart'] as $p_id => $array) {
        $product_id .= $p_id . "<br>";

        foreach ($array as $key => $value) {
            switch ($key) {
                case'p_name':
                    $p_name = $value . "<br>";
                    break;
                case'p_cashpoint':
                    $cashpoint .= $value . "<br>";
                    break;
                case'cart_quantity':
                    $quantity .= $value . "<br>";
                    break;
                case'p_img':
                    $p_img .= $value . "<br>";
                    break;
            }
        }
    }
    //cut the last <br>
    $p_name = trim($p_name, '<br>');
    $product_id = trim($product_id, '<br>');
    $cashpoint = trim($cashpoint, '<br>');
    $n_quantity = trim($quantity, '<br>');
    $p_img = trim($p_img, '<br>');

    //self pick-up
    if ($type == "self") {
    $b_address = $_POST['b_address'];
    $b_location = $_POST['b_location'];
    $pickupDate = $_POST['pickupDate'];
    $pickupTime = $_POST['pickupTime'];
    $type_name = $_POST['type_name'];

    $n_totalPrice = $_COOKIE['n_totalPrice'];
    $discount = $_COOKIE['discount'];
    $remainder = $_COOKIE["remainder"];

    //insert the order record
    $sql_s= "INSERT INTO `user_order`VALUES ('','$userID','Self Pick-up','$product_id','$n_quantity','$cashpoint','$totalPrice','$discount','$n_totalPrice','$b_location','$b_address','','$time','$pickupDate','$pickupTime', 'self-picked up','$p_img', '$p_name')";
    //(`orderID`, `userID`, `type_name`, `p_id`, `quantity`, `cashpoint`, `totalPrice`, `discount`, `n_totalPrice`, `b_name`, `b_address`, `user_address`, `order_time`, `getDate`, `getTime`, order_status, p_img, p_name)
    $result=mysqli_query($conn,$sql_s);

    //update the cashpoint of user
    $update= "UPDATE `user_info` SET `cashpoint`='$remainder' WHERE `userID`='$userID'";
    $result=mysqli_query($conn,$update);

    //delete the shopping cart
    $cart = "DELETE FROM shoppingcart WHERE userID = '$userID'";
    $result = mysqli_query($conn, $cart);

    //delivery
  }else if ($type == "delivery") {
    $deliveryDate = $_POST['deliveryDate'];
    $deliveryTime = $_POST['deliveryTime'];
    $address = $_POST['address'];
    $type_name = $_POST['type_name'];
    $remainder = $_COOKIE["remainder"];

    //insert the order record
    $sql_d= "INSERT INTO `user_order`VALUES ('','$userID','Delivery','$product_id','$quantity','$cashpoint','$totalPrice','0','$totalPrice','','','$address','$time','$deliveryDate','$deliveryTime', 'delivered','$p_img', '$p_name')";
    //(`orderID`, `userID`, `type_name`, `p_id`, `quantity`, `cashpoint`, `totalPrice`, `discount`, `n_totalPrice`, `b_name`, `b_address`, `user_address`, `order_time`, `getDate`, `getTime`, $p_img, p_name)
    $result=mysqli_query($conn,$sql_d);

        //update the cashpoint of user
        $update= "UPDATE `user_info` SET `cashpoint`='$remainder' WHERE `userID`='$userID'";
        $result=mysqli_query($conn,$update);

        //delete the shopping cart
        $cart = "DELETE FROM shoppingcart WHERE userID = '$userID'";
        $result = mysqli_query($conn, $cart);

  }


    //update the session information
    $cart = "SELECT `username`, `cashpoint`, `address`, `phone`, `email` FROM `user_info` WHERE userID = $userID";
    $result = mysqli_query($conn, $cart);
    while ($row = mysqli_fetch_array($result)) {
        $_SESSION["username"] = $row["username"];
        $_SESSION["cashpoint"] = $row["cashpoint"];
        $_SESSION["address"] = $row["address"];
        $_SESSION["phone"] = $row["phone"];
        $_SESSION["email"] = $row["email"];
    }

    //delete the shopping cart cookie and session
    setcookie("product_id", "", time()-3600);
    setcookie("discount", "", time()-3600);
    setcookie("n_totalPrice", "", time()-3600);
    setcookie("cashpoint", "", time()-3600);
    setcookie("totalPrice", "", time()-3600);
    setcookie("remainder", "", time()-3600);
    unset($_SESSION['cart']);


    ?>
    <div class="alert alert-success">
        <a href="view_order.php" class="alert-link">Successful!</a>
    </div>
    <script>
        if(true) {
            window.setTimeout(function(){
                window.location.href = "view_order.php";
            }, 1500);
        }
    </script>
    <?php


}else {
    echo "WRONG!";

}

