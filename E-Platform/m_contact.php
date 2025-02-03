<?php include_once('./m_header.php'); ?>
    <meta charset="utf-8">
    <script src="jquery.js"></script>
<?php
include_once 'db.php';

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    if ($_GET["submit"] == 'Delete') {
        $id = $_GET["id"];
        $select = "DELETE FROM `contactus` WHERE id='$id'";
        $result = mysqli_query($conn, $select);

    }
}

?>
    <table border="1" class="table table-striped table-hover" >
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Textarea</th>
        </tr>
        </thead>
        <tbody>
<?php
$select = "Select * From contactus";
$result=mysqli_query($conn,$select);


while ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id"];
    $name = $row["name"];
    $phone = $row["phone"];
    $email = $row["email"];
    $textarea = $row["textarea"];

    echo "<form method='GET' action=''><tr>";
    echo "<input type='hidden' name='id' value='$id' >";
    echo "<td >"."$id"."</td>";
    echo "<td >"."$name"."</td>";
    echo "<td >"."$phone"."</td>";
    echo "<td >".$email."</td>";
    echo "<td >".$textarea."</td>";
    echo "<td >"."<input name='submit' type='submit' value='Delete' ><br>"."</td>";
    echo "</form></tr>";
}
?>
        </tbody>
    </table>

