
<?php
    include "connection.php";
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
            $sqlInsert = "INSERT into users (userName,firstName,lastName)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "')";
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
<title>Welcome Home</title>
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
$sqlSelect = "SELECT * FROM users";
$result = mysqli_query($conn, $sqlSelect);
            
if (mysqli_num_rows($result) > 0) {
?>
<table id='userTable'>
    <thead>
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>

        </tr>
    </thead>
    <?php
	while ($row = mysqli_fetch_array($result)) {
    ?>

    <tbody>
        <tr>
            <td><?php  echo $row['userId']; ?></td>
            <td><?php  echo $row['userName']; ?></td>
            <td><?php  echo $row['firstName']; ?></td>
            <td><?php  echo $row['lastName']; ?></td>
        </tr>
     <?php
     }
     ?>
    </tbody>
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