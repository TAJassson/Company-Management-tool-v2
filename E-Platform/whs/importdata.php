
<?php
    include "db.php";
    include "whs_header.php";
if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        $find_header=0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $find_header++; //update counter
            //this ensures we skip the header
            if( $find_header > 1 ) {
                //the column variable corresponds with the ones in your csv file
                $sqlInsert = "INSERT into stock_info (p_id, p_name, p_category, p_stock, p_img, p_state)
               values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "')";
            $result = mysqli_query($conn, $sqlInsert);
            
            if (!empty($result)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Import data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">  
    <div class="jumbotron">
    <h1 class="display-4">Import data</h1>
    <p class="lead">This is an AJAX platform for partnership to import the CSV file to our database (Only for uploading new products. If you need to update warehouse stock records, please click <a href="http://localhost/whs_stockmanagement.php">here</a>).</p>
    <p>Please click <a href="http://localhost/whs/doc/template.csv" download>here</a> to download the CSV template!</p>
    <p>After upload the data please click "Edit" to upload the product image. Stock database will be verify to web admin and it'll be update in customer page (It may take 7 days)
    </p>
    </div>   

<form class="form-horizontal" action="" method="post" name="uploadCSV"
    enctype="multipart/form-data">
    <div class="input-row">
        <label class="col-md-4 control-label">Choose CSV File</label> <input
            type="file" name="file" id="file" accept=".csv">
        <button type="submit" id="submit" name="import"
            class="btn-submit">Import</button>
        <br />

    </div>
    <div id="labelError"></div>
</form>
</div>
<hr>
<br>
<?php
$sqlSelect = "SELECT * FROM stock_info";
$result = mysqli_query($conn, $sqlSelect);
            
if (mysqli_num_rows($result) > 0) {
?>
<?php include_once('./whs_header.php'); ?>
<?php

include_once 'db.php';

//show all products
$sql = "SELECT * FROM stock_info";
$result = mysqli_query($conn, $sql);
$numOfRecord = mysqli_num_rows($result);

?>

    <table  class="table"  align='center' width="15%">
        <tr>
            <th align='center' width="12%"> </th>
            <th align='center' width="12%"> Product ID</th>
            <th align='center' width="12%"> Product Name</th>
            <th align='center' width="12%"> Product Category</th>
            <th align='center' width="12%"> Product Stock</th>
            <th align='center' width="12%"> Product State</th>
            <th align='center' width="12%"> Button</th>
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
    echo "<td align='center'>"."<img src='http://localhost/$p_img' style=\"max-width:30%\">"."</td>";
    echo "<td align='center'>".$p_id."</td>";
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
echo "<td></td>";
?>
<form method='post' action='m_stock_handler.php'>
</form>
<br>


</table>

<?php } ?>
<script type="text/javascript">
	$(document).ready(
	function() {
		$("#frmCSVImport").on(
		"submit",
		function() {

			$("#response").attr("class", "");
			$("#response").html("");
			var fileType = ".csv";
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+("
					+ fileType + ")$");
			if (!regex.test($("#file").val().toLowerCase())) {
				$("#response").addClass("error");
				$("#response").addClass("display-block");
				$("#response").html(
						"Invalid File. Upload : <b>" + fileType
								+ "</b> Files.");
				return false;
			}
			return true;
		});
	});
</script>
</body> 
</html>