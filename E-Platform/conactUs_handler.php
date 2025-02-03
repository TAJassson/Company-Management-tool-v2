<?php include_once('./header.php'); ?>
<?php
include_once 'db.php';
//session_start();

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$textarea = $_POST['textarea'];
$num_phone = strlen((string)$phone);

    //(`name`, `phone`, `email`, `textarea`, `id`)
    $sql = "INSERT INTO `contactus` VALUES ('$name','$phone','$email','$textarea','')";
    $result = mysqli_query($conn, $sql);

?>
    <div class="alert alert-success">
        <a href="index.php" class="alert-link">Successful! Thank you your Feedback!</a>
    </div>
    <script>
            window.setTimeout(function(){
                window.location.href = "index.php";
            }, 1500);
    </script>



