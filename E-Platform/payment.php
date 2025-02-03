<html>
<head>
    <meta charset="utf-8">
    <script src="jquery.js"></script>
</head>
<?php include_once('./header.php');
include_once 'db.php';

$action = $_POST['action'];
$totalPrice = $_POST['totalPrice'];
setcookie("totalPrice", "$totalPrice", time()+3600);
$userID = $_SESSION["id"];
$type = $_COOKIE["type"];

?>
    <table border="1" class="table table-striped">
        <thead>
        <tr>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
        <th scope="col">Product quantity</th>
        <th scope="col">Total Price</th>
        </tr>
        </thead>
        <tbody>
<?php
$i=0;
//get product detail from session
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
//display product detail
echo "<tr>";
//echo "<input type='hidden' name='p_id' value='$product_id' >";
//echo "<input type='hidden' name='action' value='change' >";
echo "<td >"."<img src='$p_img' style=\"max-width:30%\">"."</td>";
echo "<td >".$p_name."</td>";
echo "<td >".$p_cashpoint."</td>";
echo "<td >"."$cart_quantity"."</td>";
echo "<td >"."$total"."</td>";
echo "</tr>";
$i++;
}
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><h3><?=$i?> items</h3></td>
        <td><h3><?=$totalPrice?> HKD$</h3></td>
    </tr>
    </tbody>
    </table>
    <br>
    <br>

<form method="POST" action="confirm.php" class="container">
<div class="row container">

  <?php
  //base on delf pick up and delivery way, calculate the price
  if ((isset($_COOKIE["type"]) && !empty($_COOKIE["type"]))) {
    if($type == "self") {
      $n_totalPrice = $totalPrice*0.95;
      $discount = $totalPrice*0.05;
      setcookie("discount", "$discount", time()+3600);
      $remainder = $_SESSION["cashpoint"] - $n_totalPrice;
      setcookie("n_totalPrice", "$n_totalPrice", time()+3600);

    }else {
      $remainder = $_SESSION["cashpoint"] - $totalPrice;
    }

    if ($remainder < 0) {
      $remainder = "NOT ENOUGH CASHPOINT!";
      header("Location: ./shoppingCart.php");
    }

    $cashpoint = $_SESSION["cashpoint"];
    setcookie("cashpoint", "$cashpoint", time()+3600);
    setcookie("remainder", "$remainder", time()+3600);
    ?>

    <div class="col-lg-6 col-md-6 col-sm-12">
      <h2>Calculation</h2>
      <table class="table table-striped table-sm" >
        <thead class="table-light">
        <tr>
          <th scope="col" >#</th>
          <th scope="col" >HKD$</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <th scope="row" style="width: 2%">Client Credit</th>
          <td style="width: 2%"><?=$_SESSION["cashpoint"]?></td>

        </tr>
        <?php
        //self pick up
        if ($type == "self") { ?>
        <tr>
          <th scope="row" >Costs</th>
          <td ><?=$totalPrice?></td>
        </tr>
        <?php
        //delivery
        }else { ?>
        <tr>
          <th scope="row" >Costs</th>
          <td ><?=$totalPrice?></td>
        </tr>
         <?php }?>
        <tfoot>
        <tr>
          <th scope="row" >Remainder</th>
          <td ><?=$remainder?></td>
        </tr>
        </tfoot>
        </tbody>
      </table>
      <?php
      //self pick up, show discount
      if ($type == "self") { ?>
        <p class="fs-6">Payment Terms: 7 Day Credit</p>
      <?php } ?>
    </div>

<?php
//self pick up, choose delivery date, time and branch location
if ($type == "self") { ?>

    <div class="col-lg-6 col-md-6 col-sm-12">
      <h2>Self pick-up</h2>
      Branch: <select id="selfPick" name="option" required>
        <option value="-1" selected>[choose yours]</option>
        <option value="Tsing Yi">Tsing Yi</option>
        <option value="Tuen Mun">Tuen Mun</option>
        <option value="Sha Tin">Shatin</option>
        <option value="Chai Wan">Chai Wan</option>
        <option value="Tseung Kwan O">Tseung Kwan O</option>
      </select>

      <br><br>
      Pick-Up Date: <input type="date" id="pickupDate" name="pickupDate" min="<?= date('Y-m-d', strtotime('+1 days')); ?>" max="<?= date('Y-m-d', strtotime('+30 days')); ?>" required><br>
      Pick-Up Time: <input type="time" id="pickupTime" name="pickupTime" min="09:00" max="21:00" required><br>
      Our Branch Opening Hour: 0900-2100<br>
    </div>

<?php
//delivery, choose delivery date, time
}else { ?>

    <div class="col-lg-6 col-md-6 col-sm-12">
      <h2>Delivery</h2>
      Delivery Date: <input type="date" id="deliveryDate" name="deliveryDate" min="<?= date('Y-m-d', strtotime('+3 days')); ?>" max="<?= date('Y-m-d', strtotime('+30 days')); ?>" required><br>
      Delivery Time: <input type="time" id="deliveryTime" name="deliveryTime" min="09:00" max="18:00" required><br>
      Delivery time: 0900-1800<br>
    </div>
<?php } ?>
  <div class="d-grid gap-2 col-6 mx-auto">
      <input type="submit" id="submit" name="submit" value="Confirm" class="btn btn-primary btn-primary btn-lg">
    <a href="shoppingCart.php" class="btn btn-info btn-primary btn-lg">Back</a>
  </div>
  </form>
</div>
</div>
</html>
<?php }
?>