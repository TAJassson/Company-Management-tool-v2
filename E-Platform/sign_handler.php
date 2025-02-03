<?php include_once('./header.php'); ?>
<?php
include_once 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$cof_Password = $_POST['cof_Password'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$add3 = $_POST['add3'];
$add4 = $_POST['add4'];

$br = $_POST['br'];
$bank = $_POST['bank'];

$address = $add1."<br>".$add2."<br>".$add3."<br>".$add4."<br>"."Hong Kong";


$sql = "SELECT * FROM user_info WHERE username='$username' OR phone='$phone' OR email='$email'";
$result = mysqli_query($conn, $sql);

$phone_length = strlen((string)$phone);
$numOfRecord = mysqli_num_rows($result);

while ($row = mysqli_fetch_array($result)) {
    //check the username with database
    if(strcmp($row["username"],$username)  == 0) {
        ?>
        <div class="alert alert-danger">
            <a href="sign.php" class="alert-link">This username already exists!</a>
        </div>
        <script>
            if(<?=strcmp($row["username"],$username)?> == 0) {
                window.setTimeout(function(){
                    window.location.href = "sign.php";
                }, 1500);
            }
        </script>
        <?php
        //check the phone with database
    }else if (strcmp($row["phone"],$phone)  == 0) {
            ?>
            <div class="alert alert-danger">
                <a href="sign.php" class="alert-link">This phone number already exists!</a>
            </div>
            <script>
                if(<?=strcmp($row["phone"],$phone)?> == 0) {
                    window.setTimeout(function(){
                        window.location.href = "sign.php";
                    }, 1500);
                }
            </script>
            <?php
            //check the email with database
    }else if (strcmp($row["email"],$email) == 0) {
        ?>
        <div class="alert alert-danger">
            <a href="sign.php" class="alert-link">This email already exists!</a>
        </div>
        <script>
            if(<?=strcmp($row["email"],$email)?> == 0) {
                window.setTimeout(function(){
                    window.location.href = "sign.php";
                }, 1500);
            }
        </script>
        <?php
    }
}

if ($numOfRecord == 0) {
    //check phone number length
    if ($phone_length != 8) {
    ?>
    <div class="alert alert-danger">
        <a href="sign.php" class="alert-link">phone number length should be 8!</a>
    </div>
    <script>
        if(<?=$phone_length?> != 8) {
            window.setTimeout(function(){
                window.location.href = "sign.php";
            }, 1500);
        }
    </script>
    <?php
    //check password and confirm password
    }else if(strcmp($password,$cof_Password) != 0) {
        ?>
        <div class="alert alert-danger">
            <a href="sign.php" class="alert-link">password and confirm password should be same!</a>
        </div>
        <script>
            if(<?=strcmp($password,$cof_Password)?> != 0) {
                window.setTimeout(function(){
                    window.location.href = "sign.php";
                }, 1500);
            }
        </script>
        <?php
    }else {
        $hashed_password = hash('sha256', $password);
        $insert = "INSERT INTO user_info VALUES ('','1','$username','$hashed_password','100000','$address','$phone','$email','$br','$bank','enable')";
        $result = mysqli_query($conn, $insert);
        ?>
        <div class="alert alert-success">
            <a href="login.php" class="alert-link">Successful! Please Login</a>
        </div>
        <script>
            if(<?=strcmp($password,$cof_Password)?> == 0) {
                window.setTimeout(function(){
                    window.location.href = "login.php";
                }, 1500);
            }
        </script>
        <?php
    }
}
?>


