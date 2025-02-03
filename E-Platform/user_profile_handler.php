<?php include_once('./header.php'); ?>
<?php
include_once 'db.php';
//session_start();
$userID = $_SESSION["id"];
?>
<meta charset="utf-8">
<script src="jquery.js"></script>
<?php

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        $add[0] = $_POST['add1'];
        $add[1] = $_POST['add2'];
        $add[2] = $_POST['add3'];
        $add[3] = $_POST['add4'];
        $add[4] = "Hong Kong";

        $address = $add[0]."<br>".$add[1]."<br>".$add[2]."<br>".$add[3]."<br>".$add[4];

        //find any same record include username, phone, email in database
        $sql = "SELECT * FROM user_info WHERE (username='$username' OR phone='$phone' OR email='$email') AND userID!='$userID' ";
        $result = mysqli_query($conn, $sql);

        $phone_length = strlen((string)$phone);
        $x = true;


        while ($row = mysqli_fetch_array($result)) {
                //check the username with database
                if(strcmp($row["username"],$username)  == 0) {
                    $x = false;
                    ?>
                    <div class="alert alert-danger">
                        <a href="user_profile.php" class="alert-link">This username already exists!</a>
                    </div>
                    <script>
                        if(<?=strcmp($row["username"],$username)?> == 0) {
                            window.setTimeout(function(){
                                window.location.href = "user_profile.php";
                            }, 1500);
                        }
                    </script>
                    <?php
                    //check the phone with database
                }else if (strcmp($row["phone"],$phone)  == 0) {
                    $x = false;
                    ?>
                    <div class="alert alert-danger">
                        <a href="user_profile.php" class="alert-link">This phone number already exists!</a>
                    </div>
                    <script>
                        if(<?=strcmp($row["phone"],$phone)?> == 0) {
                            window.setTimeout(function(){
                                window.location.href = "user_profile.php";
                            }, 1500);
                        }
                    </script>
                    <?php
                    //check the email with database
                }else if (strcmp($row["email"],$email) == 0) {
                    $x = false;
                    ?>
                    <div class="alert alert-danger">
                        <a href="user_profile.php" class="alert-link">This email already exists!</a>
                    </div>
                    <script>
                        if(<?=strcmp($row["email"],$email)?> == 0) {
                            window.setTimeout(function(){
                                window.location.href = "user_profile.php";
                            }, 1500);
                        }
                    </script>
                    <?php
                }

        }
                //check the wrong phone length
                if ($phone_length != 8 && $x){
                    ?>
                    <div class="alert alert-danger">
                        <a href="user_profile.php" class="alert-link">Phone length Wrong!</a>
                    </div>
                    <script>
                        if(<?=strlen((string)$_POST["phone"])?> != 8) {
                            window.setTimeout(function(){
                                window.location.href = "user_profile.php";
                            }, 1500);
                        }
                    </script>
                    <?php
                //correct
                }else if ($x){
                    $update = "UPDATE user_info SET username='$username',password='$password',address='$address',phone='$phone',email='$email' WHERE userID = $userID";
                    $results = mysqli_query($conn, $update);
                    $_SESSION["username"] = $username;
                    $_SESSION["password"] = $password;

                    $_SESSION["address"] = $address;
                    $_SESSION["phone"] = $phone;
                    $_SESSION["email"] = $email;
                    ?>
                    <div class="alert alert-success">
                        <a href="productList.php" class="alert-link">Change successful!</a>
                    </div>
                    <script>
                        if(<?=strlen((string)$_POST["phone"])?> == 8) {
                            window.setTimeout(function(){
                                window.location.href = "productList.php";
                            }, 1500);
                        }
                    </script>
                    <?php
                }

//need login first
}else {
    ?>
    <div class="alert alert-danger">
        <a href="login.php" class="alert-link">Please Login First!</a>
    </div>
    <script>
        if(<?=empty($_SESSION["id"])?>) {
            window.setTimeout(function(){
                window.location.href = "login.php";
            }, 1500);
        }
    </script>
    <?php
}
