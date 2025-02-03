<?php include_once('./whs_header.php'); ?>
<?php

include_once 'db.php';

//show all products
$sql = "SELECT * FROM stock_info";
$result = mysqli_query($conn, $sql);
$numOfRecord = mysqli_num_rows($result);

?>

    <table  class="table"  align='center' width="18%">
        <tr>
            <th align='center' width="18%">Product Image</th>
            <th align='center' width="18%">Product Name</th>
            <th align='center' width="18%">Product Category</th>
            <th align='center' width="18%">Product Stock</th>
            <th align='center' width="18%">Product State</th>
            <th align='center' width="18%">Button</th>
        </tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    $p_id = $row["p_id"];
    $p_name = $row["p_name"];
    $p_category = $row["p_category"];
    $p_stock = $row["p_stock"];
    $p_img = $row["p_img"];
    $p_state = $row["p_state"];

    echo "<form method='post' action='m_stock_handler.php'><tr>";
    echo "<input type='hidden' name='p_id' value='$p_id' id='p_id'>";
    echo "<input type='hidden' name='p_name' value='$p_name'>";
    echo "<input type='hidden' name='p_img' value='$p_img'>";
    echo "<input type='hidden' name='p_category' value='$p_category'>";
    echo "<input type='hidden' name='p_state' value='$p_stock'>";
    echo "<input type='hidden' name='p_state' value='$p_state'>";
    echo "<td align='center'>"."<img src='$p_img' style=\"max-width:30%\">"."</td>";
    echo "<td align='center'>".$p_name."</td>";
    echo "<td align='center'>".$p_category."</td>";
    echo "<td align='center'>".$p_stock."</td>";
    echo "<td align='center'>".$p_state."</td>";
    echo "<td align='center'>"."<input type='submit' name='action' value='edit' /><br>";
    echo "<input type='submit' name='action' value='delete' />"."</td>";
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
<form method='post' action='m_stock_handler.php'>
<td align='center'>
    <input type='submit' name='action' value='Add Product'/>
</td>
</form>
<br>


</table>
