<?php
include_once('./m_header.php');
include_once 'db.php';

?>
<head>
        <style>
            .form-horizontal{
                display:block;
                width:50%;
                margin:0 auto;
            }
        </style>
    <meta charset="utf-8">
</head>
<?php
if (isset($_POST["action"]) && !empty($_POST["action"])) {
    $action = $_POST['action'];

    if (strcmp($action,"Add User") == 0) {
        ?>
        <div id="pricing" class="container-fluid">
            <table class="table table-bordered table-striped text-center">
                <h1>Add New User below:</h1><br>
                <form action="" method="GET">
                    <input type='hidden' name='action' value='Add User_done'>
                    <input type='hidden' name='p_id' value=''>
                    Username:<input type="text" name="username" value="" required><br>
                    password:<input type="password" name="password" value="" required><br>
                    cashpoint:<input type="text" name="cashpoint" value="" required><br>


                    Phone:<input type="text" name="phone" value="" required><br>
                    Email:<input type="email" name="email" value="" required><br>
                    status:<select name="status" id="status">
                        <option value="enable">enable</option>
                        <option value="disable">disable</option>
                    </select>
                    <br>
                    <h2>Address:</h2>
                    Your Name:<input type="text" name="address1" value="" required><br>
                    Unit, Floor, Building:<input type="text" name="address2" value="" required><br>
                    Estate, Street,  Street No:<input type="text" name="address3" value="" required><br>
                    District, Region OR Area:<input type="text" name="address4" value="" required><br>
                    City/Country:<input type="text" name="address5" value="Hong Kong" required><br>

                    <br>
                    <input type="submit" name="submit" class="btn btn-primary">
                </form>
            </table>
        </div>
        <?php
    }
    if(isset($_POST['userID']) && !empty($_POST['userID'])) {
        $userID = $_POST['userID'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cashpoint = $_POST['cashpoint'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        $address = explode("<br>", $address);
    }

    if (strcmp($action,"Edit") == 0) {
        ?>
            <td>
        <form action="" method="GET" class="row w-50 p-3 form-horizontal">
            <div class="col-md-9">
            <h1 class="mx-auto-text-center">Edit</h1>
            </div>
            <input type='hidden' name='action' value='Edit_done'>
            <input type='hidden' name='p_id' value='<?=$userID?>'>
            <div class="col-md-9 p-1">
        Username:<input type="text" name="username" value="<?=$username?>" required><br>
            </div>
            <div class="col-md-9 p-1">
        password:<input type="text" name="password" value="<?=$password?>" required><br>
            </div>
            <div class="col-md-9 p-1">
        cashpoint:<input type="text" name="cashpoint" value="<?=$cashpoint?>" required><br>
            </div>
            <div class="col-md-9 p-1">
        Phone:<input type="text" name="phone" value="<?=$phone?>" required><br>
            </div>
            <div class="col-md-9 p-1">
        Email:<input type="text" name="email" value="<?=$email?>" required><br>
            </div>
            <div class="col-md-9 p-1">
        status:<select name="status" id="status">
                <option value="enable">enable</option>
                <option value="disable">disable</option>
                </select>
            </div>

            <h2>Address:</h2>
            Your Name:<input type="text" name="address1" value="<?=$address[0]?>" required><br>
            Unit, Floor, Building:<input type="text" name="address2" value="<?=$address[1]?>" required><br>
            Estate, Street,  Street No:<input type="text" name="address3" value="<?=$address[2]?>" required><br>
            District, Region OR Area:<input type="text" name="address4" value="<?=$address[3]?>" required><br>
            City/Country:<input type="text" name="address5" value="Hong Kong" required><br>


                <br>
            <input type="submit" name="submit" class="btn btn-primary">
            </td>
        </form>
<?php
    }else if (strcmp($action,"Delete") == 0) {
        $sql1 = "DELETE FROM shoppingcart WHERE `userID`='$userID'";
        $result = mysqli_query($conn, $sql1);

        $sql2 = "DELETE FROM user_order WHERE `userID`='$userID'";
        $result = mysqli_query($conn, $sql2);

        $sql3 = "DELETE FROM `user_info` WHERE `userID`='$userID'";
        $result = mysqli_query($conn, $sql3);

        header("Location: ./m_control.php");

    }

}else if (isset($_GET["action"]) && !empty($_GET["action"])) {
    $n_userID = $_GET['p_id'];
    $n_action = $_GET['action'];
    $n_username = $_GET['username'];
    $n_password = $_GET['password'];
    $n_cashpoint = $_GET['cashpoint'];
    $n_address = $_GET['address'];
    $n_phone = $_GET['phone'];
    $n_email = $_GET['email'];
    $n_status = $_GET['status'];

    $address1 = $_GET['address1'];
    $address2 = $_GET['address2'];
    $address3 = $_GET['address3'];
    $address4 = $_GET['address4'];
    $address5 = $_GET['address5'];

    $n_address = $address1."<br>".$address2."<br>".$address3."<br>".$address4."<br>".$address5;
    $hashed_password = hash('sha256', $n_password);


    if (strcmp($_GET['action'],"Edit_done") == 0 ) {

        $sql = "UPDATE `user_info` SET `username`='$n_username',`password`='$hashed_password',`cashpoint`='$n_cashpoint',`address`='$n_address',`phone`='$n_phone',`email`='$n_email',`status`='$n_status' WHERE userID = '$n_userID'";
        $result = mysqli_query($conn, $sql);
        //$numOfRecord = mysqli_num_rows($result);
        header("Location: ./m_control.php");

    }else if (strcmp($_GET['action'],"Add User_done") == 0) {
        //(`userID`, `username`, `password`, `cashpoint`, `address`, `phone`, `email`, `status`)
        $sql = "INSERT INTO `user_info` VALUES ('','$n_username','$hashed_password','$n_cashpoint','$n_address','$n_phone','$n_email','$n_status')";
        $result = mysqli_query($conn, $sql);
        header("Location: ./m_control.php");
    }

}
