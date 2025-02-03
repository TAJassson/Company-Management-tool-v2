<?php include_once('./header.php'); ?>
<html>
<head>
    <style>
        .form-horizontal{
            display:block;
            width:50%;
            margin:0 auto;
        }
    </style>
</head>
<meta charset="utf-8">
<script src="jquery.js"></script>

<?php
include_once 'db.php';

if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {

$userID = $_SESSION["id"];
$select = "Select * From user_info WHERE userID = '$userID'";
$result=mysqli_query($conn,$select);

while ($row = mysqli_fetch_assoc($result)) {
        $userID = $row["userID"];
        $username = $row["username"];
        $password = $row["password"];
        $cashpoint = $row["cashpoint"];
        $address = $row["address"];
        $phone = $row["phone"];
        $email = $row["email"];

        $add = explode("<br>", $address);

}

?>
    <body>
    <form class="row w-50 p-3 form-horizontal" action="user_profile_handler.php" method="POST">
        <h1>Profile</h1>
        <div class="col-md-9">
            <label for="inputName" class="form-label">User name:</label>
            <input type="text" class="form-control" id="inputName" name="username" value="<?=$username?>">
        </div>
        <div class="col-9">
            <label for="cashpoint" class="form-label">Client credit limit:</label>
            <input type="text" class="form-control" id="input_cof_pass" name="cashpoint" value="<?=$cashpoint?>" disabled>
        </div>
        <div class="col-9">
            <label for="inputPhone" class="form-label">Phone:</label>
            <input type="text" class="form-control" id="inputPhone" name="phone" value="<?=$phone?>">
        </div>
        <div class="col-md-9">
            <label for="inputEmail" class="form-label">Email:</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?=$email?>">
        </div>

        <br>
        <h2>Address</h2>
        <div class="col-md-9">
            <label for="inputAdd1" class="form-label">Your Name:</label>
            <input type="text" class="form-control" id="inputAdd1" name="add1" value="<?=$add[0]?>">
        </div>
        <div class="col-md-9">
            <label for="inputAdd2" class="form-label">Unit, Floor, Building:</label>
            <input type="text" class="form-control" id="inputAdd2" name="add2" value="<?=$add[1]?>">
        </div>
        <div class="col-md-9">
            <label for="inputAdd3" class="form-label">Estate, Street,  Street No:</label>
            <input type="text" class="form-control" id="inputAdd3" name="add3" value="<?=$add[2]?>">
        </div>
        <div class="col-md-9">
            <label for="inputAdd4" class="form-label">District, Region OR Area</label>
            <input type="text" class="form-control" id="inputAdd4" name="add4" value="<?=$add[3]?>">
        </div>
        <div class="col-md-9">
            <label for="inputAdd5" class="form-label">District, Region OR Area</label>
            <input type="text" class="form-control" id="inputAdd5" value="Hong Kong" disabled>
        </div>
        <br><br>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Change</button>
            <a href='productList.php'>Click Here go to product list</a>
        </div>
    </form>
    </body>

<?php
//if user don't login
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
?>

