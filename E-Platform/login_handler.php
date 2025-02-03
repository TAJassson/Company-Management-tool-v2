<?php include_once('./header.php'); ?>
<html>
<head>
<meta charset="utf-8">
<script src="jquery.js"></script>
</head>
</html>
<?php
include_once 'db.php';
//get from login.php
$username = $_POST["username"];
$password = $_POST["password"];
$hashed_password = hash('sha256', $password);
$sql = "SELECT * FROM user_info WHERE username = '$username' AND password = '$hashed_password'";
$result = mysqli_query($conn, $sql);
$numOfRecord = mysqli_num_rows($result);

if (strcmp($username,"manager") == 0 && strcmp($hashed_password,"6ee4a469cd4e91053847f5d3fcb61dbcc91e8f0ef10be7748da4c4a1ba382d17") == 0) {
    $_SESSION["username"] = "Admin";
    $_SESSION["id"] = "Admin";  
    ?>
    <div class="alert alert-success">
        <a href="/sys/m_control.php" class="alert-link">Entering webmaster page...</a>
    </div>
    <script>
        if(<?=strcmp($username,"manager")?> == 0) {
            window.setTimeout(function(){
                window.location.href = "m_control.php";
            }, 2000);
        }
    </script>
    <?php
}else if (strcmp($username,"warehouse") == 0 && strcmp($hashed_password,"ae1fd358c7612a02fdc6d923fd40308ebefb0e954c7ddb6f9a8bcdd1f3b00c3b") == 0) {
    $_SESSION["username"] = "Admin";
    $_SESSION["id"] = "Admin";
    ?>
    <div class="alert alert-success">
        <a href="sys/m_control.php" class="alert-link">Welcome operation!</a>
    </div>
    <script>
        if(<?=strcmp($username,"warehouse")?> == 0) {
            window.setTimeout(function(){
                window.location.href = "whs_stockmanagement.php";
            }, 2000);
        }
    </script>
    <?php

}else if ($numOfRecord == 1) {
    while ($row = mysqli_fetch_array($result)) {
        $_SESSION["id"] = $row["userID"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["cashpoint"] = $row["cashpoint"];
        $_SESSION["password"] = $row["password"];

        $_SESSION["address"] = $row["address"];
        $_SESSION["phone"] = $row["phone"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["status"] = $row["status"];

        //state is disable
        if (strcmp($row["status"],"disable") == 0) {
            ?>
            <div class="alert alert-danger">
                <a href="productList.php" class="alert-link">Please contact Our admin!</a>
            </div>
            <script>
                if(<?=strcmp($row["status"],"disable")?> == 0) {
                    window.setTimeout(function(){
                        window.location.href = "productList.php";
                    }, 2000);
                }
            </script>
            <?php
            session_destroy();
        //can be login
        }else if($_SESSION["username"] == $username && $_SESSION["password"] == $hashed_password) {
            $name = $_SESSION["username"];
            ?>
            <div class="alert alert-success">
                <a href="productList.php" class="alert-link">Welcome <?=$name?>!</a>
            </div>
            <script>
                if(<?=strcmp($row["username"],"$username")?> == 0 && <?=strcmp($row["password"],"$hashed_password")?> == 0) {
                    window.setTimeout(function(){
                        window.location.href = "productList.php";
                    }, 30);
                }
            </script>
            <?php
        }
    }
//invalid password or username / password + username
}else {
?>
        <div class="alert alert-danger">
            <a href="login.php" class="alert-link">invalid UserName or Password!</a>
        </div>
        <script>
            if(<?=$numOfRecord?> == 0) {
                window.setTimeout(function () {
                    window.location.href = "login.php";
                }, 2000);
            }
        </script>
        <?php

}
?>



