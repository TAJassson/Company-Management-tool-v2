<?php
include_once('./header.php');
include_once 'db.php';
$type = $_COOKIE["type"];
$userID = $_SESSION["id"];

//get data base on type
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
    //self pick up
    if ($type == "self") {
        $option = $_POST['option'];
        $pickupDate = $_POST['pickupDate'];
        $pickupTime = $_POST['pickupTime'];
        $n_totalPrice = $_COOKIE['n_totalPrice'];
        $discount = $_COOKIE['discount'];
        $type_name = "Self pick-up";

      $sql = "SELECT * FROM branches_address WHERE b_location='$option'";
      $result=mysqli_query($conn,$sql);

      while ($row = mysqli_fetch_assoc($result)) {
        $b_location = $row['b_location'];
        $b_address = $row['b_address'];

      }
    //Delivery
    }else if ($_COOKIE["type"] == "delivery") {
        $deliveryDate = $_POST['deliveryDate'];
        $deliveryTime = $_POST['deliveryTime'];
        $type_name = "Delivery";

        $sql = "SELECT * FROM user_info WHERE userID='$userID'";
        $result=mysqli_query($conn,$sql);

        while ($row = mysqli_fetch_assoc($result)) {
          $address = $row['address'];
        }
    }
}

$totalPrice = $_COOKIE['totalPrice'];
$remainder = $_COOKIE["remainder"];

?>
<table border="1" class="table table-striped">
  <thead>
  <tr>
    <th scope="col">Product Image</th>
    <th scope="col">Product Name</th>
    <th scope="col">Product Cashpoint</th>
    <th scope="col">Product quantity</th>
    <th scope="col">Total Price</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $i=0;
  foreach($_SESSION['cart'] as $p_id => $array) {
    $product_id = $p_id;
    foreach($array as $key => $value) {
      switch ($key) {
        case'p_img':
          $p_img = $value;
          break;
        case'p_name':
          $p_name = $value;
          break;
        case'p_cashpoint':
          $p_cashpoint = $value;
          break;
        case'cart_quantity':
          $cart_quantity = $value;
          break;
        case'total':
          $total = $value;
          break;
      }
    }
    echo "<tr>";
    echo "<td >"."<img src='$p_img' style=\"max-width:30%\">"."</td>";
    echo "<td >".$p_name."</td>";
    echo "<td >".$p_cashpoint."</td>";
    echo "<td >"."$cart_quantity"."</td>";
    echo "<td >"."$total"."</td>";
    echo "</tr>";
    $i++;
  }
  //self pick-up
  if ($type == "self") { ?>
   <tr>
     <td><h5>5% DISCOUNT OFF!</h5></td>
    <td></td>
    <td></td>
    <td><h3><?=$i?> items</h3></td>
     <td><h3><S><?=$totalPrice?> cashpoint</S><br><?=$n_totalPrice?> cashpoint</h3></td>
  </tr>

  <?php
  //Delivery
  }else {?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><h3><?=$i?> items</h3></td>
    <td><h3><?=$totalPrice?> cashpoint</h3></td>
  </tr>
  <?php } ?>
  </tbody>
</table>
<br>

<div class="row container mx-auto">
<div class="col-lg-6 col-md-6 col-sm-12">
  <h2>Calculation</h2>
  <table class="table table-striped table-sm" >
    <thead class="table-light">
    <tr>
      <th scope="col" >#</th>
      <th scope="col" >Cashpoint</th>
    </tr>
    </thead>
    <tbody>
    <tr>
      <th scope="row" style="width: 2%">Your Cashpoints</th>
      <td style="width: 2%"><?=$_SESSION["cashpoint"]?></td>

    </tr>
    <?php if ($type == "self") { ?>
      <tr>
        <th scope="row" >Costs(with 5% discount)</th>
        <td ><?=$n_totalPrice?></td>
      </tr>
    <?php }else { ?>
      <tr>
        <th scope="row" >Costs</th>
        <td ><?=$totalPrice?></td>
      </tr>
    <?php } ?>
    <tfoot>
    <tr>
      <th scope="row" >Remainder</th>
      <td class="text-danger"><b><?=$remainder?></b></td>
    </tr>
    </tfoot>
    </tbody>
  </table>
  <?php if ($type == "self") { ?>
      <p class="fs-6 text-success">you save <?=$discount?> cashpoint!</p>
  <?php } ?>

    <div class="d-grid gap-2 col-6 mx-auto">
        <a href="user_profile.php" class="btn btn-primary">Edit personal information</a>
    </div>

</div>


<?php if ($type == "self") { ?>
<div class="col-lg-6 col-md-6 col-sm-12">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Information</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Phone</th>
            <td><?=$_SESSION["phone"]?></td>
        </tr>

        <tr>
            <th scope="row">Email</th>
            <td><?=$_SESSION["email"]?></td>
        </tr>

        <tr>
            <th scope="row">Type</th>
            <td><?=$type_name?></td>
        </tr>

        <tr>
            <th scope="row">Location</th>
            <td><?=$b_location?></td>
        </tr>

        <tr>
            <th scope="row">Pick-Up Date:</th>
            <td colspan="2"><?=$pickupDate?></td>
        </tr>

        <tr>
            <th scope="row">Pick-Up Time:</th>
            <td colspan="2"><?=$pickupTime?></td>
        </tr>
        <tr>
            <th scope="row">Self pick-up Address:</th>
            <td colspan="2"><?=$b_address?></td>
        </tr>
        </tbody>
    </table>
</div>
  <form method="POST" action="confirm_handler.php">
    <input type='hidden' name='pickupDate' value='<?=$pickupDate?>'>
    <input type='hidden' name='pickupTime' value='<?=$pickupTime?>'>
    <input type='hidden' name='type_name' value='<?=$type_name?>'>
    <input type='hidden' name='b_location' value='<?=$b_location?>'>
    <input type='hidden' name='b_address' value='<?=$b_address?>'>
    <div class="d-grid gap-2 col-6 mx-auto">
      <input name='submit' class="btn btn-primary btn-lg" type='submit' value='Confirm'>
    </div>
  </form>


<?php }else { ?>
    <div class="col-lg-6 col-md-6 col-sm-12">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Information</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Phone</th>
                    <td><?=$_SESSION["phone"]?></td>
                </tr>

                <tr>
                    <th scope="row">Email</th>
                    <td><?=$_SESSION["email"]?></td>
                </tr>

                <tr>
                    <th scope="row">Type</th>
                    <td><?=$type_name?></td>
                </tr>

                <tr>
                    <th scope="row">Pick-Up Date:</th>
                    <td><?=$deliveryDate?></td>
                </tr>

                <tr>
                    <th scope="row">Pick-Up Time:</th>
                    <td colspan="2"><?=$deliveryTime?></td>
                </tr>

                <tr>
                    <th scope="row">Delivery Address:</th>
                    <td colspan="2"><?=$address?></td>
                </tr>
                </tbody>
            </table>

</div>
  <form method="POST" action="confirm_handler.php">
    <input type='hidden' name='deliveryDate' value='<?=$deliveryDate?>'>
    <input type='hidden' name='deliveryTime' value='<?=$deliveryTime?>'>
    <input type='hidden' name='type_name' value='<?=$type_name?>'>
    <input type='hidden' name='address' value='<?=$address?>'>
    <div class="d-grid gap-2 col-6 mx-auto">
      <input name='submit' class="btn btn-primary btn-lg" type='submit' value='Confirm'>
    </div>
  </form>


<?php } ?>



</div>

