<?php include_once('./whs_header.php'); ?>
<?php

include_once 'db.php';

//show all products
$sql = "SELECT * FROM `4pl_warehouse`";
$result = mysqli_query($conn, $sql);
$numOfRecord = mysqli_num_rows($result);

?>

    <table  class="table"  align='center' width="15%">
        <tr>
            <th align='center' width="15%">Product Image</th>
            <th align='center' width="15%">Company</th>
            <th align='center' width="15%">Warehouse Address</th>
            <th align='center' width="15%">Product Name</th>
            <th align='center' width="15%">Prices</th>
            <th align='center' width="15%">Stock</th>
            <th align='center' width="15%">State</th>
        </tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    $record_id = $row["record_id"];
    $whs_name = $row["whs_name"];
    $whs_address = $row["whs_address"];
    $whs_token = $row["whs_token"];
    $p_id = $row["p_id"];
    $p_name = $row["p_name"];
    $p_stock = $row["p_stock"];
    $p_img = $row["p_img"];
    $p_cashpoint = $row["p_cashpoint"];
    $p_state = $row["p_state"];
    echo "<form method='post' action='whs_4PL_handler.php'><tr>";
    echo "<input type='hidden' name='record_id' value='$record_id'>";
    echo "<input type='hidden' name='whs_name' value='$whs_name'>";
    echo "<input type='hidden' name='whs_address' value='$whs_address'>";
    echo "<input type='hidden' name='whs_token' value='$whs_token'>";
    echo "<input type='hidden' name='p_id' value='$p_id' id='p_id'>";
    echo "<input type='hidden' name='p_name' value='$p_name'>";
    echo "<input type='hidden' name='p_stock' value='$p_stock'>";
    echo "<input type='hidden' name='p_img' value='$p_img'>";
    echo "<input type='hidden' name='p_cashpoint' value='$p_cashpoint'>";
    echo "<input type='hidden' name='p_state' value='$p_state'>";
    echo "<td align='center'><img src='$p_img' style='max-width:30%'></td>";
    echo "<td align='center'>".$whs_name."</td>";
    echo "<td align='center'>".$whs_address."</td>";
    echo "<td align='center'>".$p_name."</td>";
    echo "<td align='center'>".$p_cashpoint."</td>";
    echo "<td align='center'>".$p_stock."</td>";
    echo "<td align='center'>".$p_state."</td>";
    echo "</tr></form>";
}

echo "<tr>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
?>
<form method='post' action='whs_4PL_handler.php.php'>
</form>
<br>

</table>
