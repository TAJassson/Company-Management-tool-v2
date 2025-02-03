<?php
include_once('./m_header.php');
include_once 'db.php';

$sql = "SELECT * FROM `user_info` WHERE userID LIKE '10%'";
$result = mysqli_query($conn, $sql);
$numOfRecord = mysqli_num_rows($result);
?>

<table border="1" class="table" align='center'>
        <tr>
            <th align='center' width="10%">User ID</th>
            <th align='center' width="10%">User Name</th>
            <th align='center' width="10%">Cashpoint</th>
            <th align='center' width="10%">address</th>
            <th align='center' width="10%">phone</th>
            <th align='center' width="10%">email</th>
            <th align='center' width="10%">Status</th>
            <th align='center' width="10%">Button</th>

        </tr>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    $userID = $row['userID'];
    $username = $row['username'];
    $password = $row['password'];
    $cashpoint = $row['cashpoint'];
    $address = $row['address'];
    $phone = $row['phone'];
    $email = $row['email'];
    $status = $row['status'];

    echo "<form method='post' action='m_user_handler.php'><tr>";
    echo "<input type='hidden' name='userID' value='$userID' id='p_id'>";
    echo "<input type='hidden' name='username' value='$username'>";
    echo "<input type='hidden' name='password' value='$password'>";
    echo "<input type='hidden' name='cashpoint' value='$cashpoint'>";
    echo "<input type='hidden' name='address' value='$address'>";
    echo "<input type='hidden' name='phone' value='$phone'>";
    echo "<input type='hidden' name='email' value='$email'>";
    echo "<input type='hidden' name='status' value='$status'>";

    echo "<td align='center' width='10%'>"."$userID"."</td>";
    echo "<td align='center' width='10%'>".$username."</td>";
    echo "<td align='center' width='10%'>".$password."</td>";
    echo "<td align='center' width='10%'>".$cashpoint."</td>";
    echo "<td align='center' width='10%'>".$address."</td>";
    echo "<td align='center' width='10%'>".$phone."</td>";
    echo "<td align='center' width='10%'>".$email."</td>";
    echo "<td align='center' width='10%'>".$status."</td>";
    echo "<td align='center' width='10%'>"."<input type='submit' name='action' value='Edit'/><br>";
    echo "<input type='submit' name='action' value='Delete'/>"."</td>";
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
<form method='post' action='m_user_handler.php'>
<td align='center'>
    <input type='submit' name='action' value='Add User'/>
</td>
</form>
<br>

</table>
