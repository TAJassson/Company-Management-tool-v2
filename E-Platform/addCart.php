<?php include_once('./header.php'); ?>
<html>
<head>
<script src="jquery.js"></script>
</head>
</html>
<?php
include_once 'db.php';


$action = $_POST['action'];
$p_id = $_POST['p_id'];
$quantity = $_POST['quantity'];
$submit = $_POST['submit'];

//productList and shoppingcart handler file
if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
    $userID = $_SESSION["id"];
    //delete
    if($submit == "Delete item") {
            $cart = "DELETE FROM shoppingcart WHERE p_id = '$p_id'";
            $result = mysqli_query($conn, $cart);
            unset($_SESSION['cart'][$p_id]);
            ?>
            <div class="alert alert-success">
                <a href="shoppingCart.php" class="alert-link">DELETE successful!</a>
            </div>
            <script>
                if(<?=strcmp($submit,"Delete item")?> == 0) {
                    window.setTimeout(function(){
                        window.location.href = "shoppingCart.php";
                    }, 1500);
                }
            </script>
            <?php
    //change
    }else if ($action == 'change'){
        $change = "UPDATE shoppingcart SET quantity = '$quantity' WHERE userID = '$userID' and p_id = '$p_id'";
        $result=mysqli_query($conn,$change);
        $x=true;
        ?>
        <div class="alert alert-success">
            <a href="shoppingCart.php" class="alert-link">UPDATE already!</a>
        </div>
        <script>
            if(<?=strcmp($action,'change')?> == 0) {
                window.setTimeout(function(){
                    window.location.href = "shoppingCart.php";
                }, 2000);
            }
        </script>
        <?php
    //add
    }else if ($action == 'add'){
        $search = "SELECT * FROM `shoppingcart` WHERE userID = '$userID' and p_id = '$p_id'";
        $result = mysqli_query($conn,$search);
        $num_rows = mysqli_num_rows($result);

        if ($num_rows == 1) {
            ?>
            <div class="alert alert-info">
                <a href="shoppingCart.php" class="alert-link">This product exist in shopping cart already!</a>
            </div>
            <script>
            if(<?=$num_rows?> == 1) {
                window.setTimeout(function(){
                    window.location.href = "shoppingCart.php";
                }, 2000);
            }
            </script>
        <?php
        }else {
            // userID, p_id, quantity
            $sql = "INSERT INTO shoppingcart VALUES ('$userID','$p_id','$quantity')";
            $result=mysqli_query($conn,$sql);//result is a PHP array

            setcookie("product_id", $p_id, time()+3600);

            ?>
            <div class="alert alert-success">
                <a href="shoppingCart.php" class="alert-link">This product add in shopping cart Successful!</a>
            </div>
            <script>
                if(<?=$num_rows?> != 1) {
                    window.setTimeout(function(){
                        window.location.href = "ProductList.php";
                    }, 2000);
                }
            </script>
            <?php
        }
    }

//need login
} else {
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
}
?>

