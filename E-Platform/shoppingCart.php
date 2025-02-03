<?php include_once('./header.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="jquery.js"></script>
</head>
<body>
<?php
include_once 'db.php';

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
    $username = $_SESSION["username"];
    $userID = $_SESSION["id"];
?>
        <table border="1" class="table table-striped table-hover" >
        <thead>
        <tr>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product Cashpoint</th>
        <th scope="col">Product quantity</th>
        <th scope="col">Total Price</th>
        <th scope="col">Button</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $enable = "enable";
        $search = "SELECT product_info.p_id, p_img, p_name, p_cashpoint, quantity FROM product_info, shoppingcart WHERE product_info.p_id = shoppingcart.p_id and product_info.p_state='enable' and shoppingcart.userID='$userID'";
        $result=mysqli_query($conn,$search);
        $numOfRecord = mysqli_num_rows($result);
        $i=0;
        $totalPrice=0;

        while ($row = mysqli_fetch_assoc($result)) {
            $p_id = $row["p_id"];
            $p_name = $row["p_name"];
            $p_cashpoint = $row["p_cashpoint"];
            $p_img = $row["p_img"];
            $cart_quantity = $row["quantity"];

            $total = $p_cashpoint * $cart_quantity;
            $totalPrice += $total;
            $i++;

            echo "<form method='POST' action='addCart.php'><tr>";
            echo "<input type='hidden' name='p_id' value='$p_id' >";
            echo "<input type='hidden' name='action' value='change' >";
            echo "<td >"."<img src='$p_img' style=\"max-width:30%\">"."</td>";
            echo "<td >".$p_name."</td>";
            echo "<td >".$p_cashpoint."</td>";
            echo "<td ><input id='number' type='number' name='quantity' value='$cart_quantity' min='1' max='10000'></td>";
            echo "<td >"."$total"."</td>";
            echo "<td >"."<input name='submit' type='submit' value='Change quantity' class=\"btn btn-info\"><br>";
            echo "<br>"."<input name='submit' type='submit' value='Delete item' class=\"btn btn-danger\">"."</td>";
            echo "</form></tr>";

            // use in payment.php
            $_SESSION['cart'][$p_id] = array (
                'p_img' => $p_img,
                'p_name' => $p_name,
                'p_cashpoint' => $p_cashpoint,
                'cart_quantity' => $cart_quantity,
                'total' => $total
            );
        }
        ?>

        <tr>
            <td><a href='productList.php'><button type="button" class="btn btn-primary">Back</button> </a></td>
            <td></td>
            <td></td>
            <td>
                <form method="POST" action="payment.php">
                <h5>Type:</h5>
                <label class="radio">
                    <input type="radio" name="choice" id="self" value="self">
                    Self pick-up
                </label><br>
                <label class="radio">
                    <input type="radio" name="choice" id="delivery" value="delivery">
                    Delivery
                </label>
            </td>
            <td><h5><?=$numOfRecord?> items,<br> Total <?=$totalPrice?> HKD$</h5></td>

            <input type='hidden' name='action' value='payment'>
            <input type='hidden' name='totalPrice' value='<?=$totalPrice?>'>
            <td><input type="submit" value="Confirm order" class="btn btn-success" id="submit"></td>
            </form>

        </tr>

        <script>
        //hide and show the submit button
        $(document).ready(function(){
            $("#submit").hide();
            $('input[type="radio"]').click(function () {
                var inputValue = $(this).attr("value");
                if (inputValue == "self") {
                    document.cookie = "type=self";
                    $("#submit").show();
                } else {
                    document.cookie = "type=delivery";
                    $("#submit").show();
                }
            });
        });
        </script>

<?php
}else {
    ?>
    <div class="alert alert-danger">
        <a href="login.php" class="alert-link">You need to login first!</a>
    </div>

    <script>
        if(<?=$_SESSION["id"]?> == "") {
            window.setTimeout(function(){
                window.location.href = "login.php";
            }, 2000);
        }
    </script>
    <?php
    //header("Location: ./login.php");
}
?>
</tbody>
</table>
</body>
</html>
