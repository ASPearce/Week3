<!DOCTYPE html>
<html>
<head>
<title>Display Users</title>
</head>
<body>
<?php
include 'connect.php';

$sql = "SELECT ID, firstname, surname, email FROM users";
$result = $mysqli->query ($sql);
if ($result){
if ($result->num_rows > 0) {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th>ID</th>";
                                echo "<th>firstname</th>";
                                echo "<th>surname</th>";
                                echo "<th>email</th>";
                                echo "</tr>";
while($row = $result->fetch_assoc())
{
    echo "<tr>";
    echo "<td>".$row['ID']."</td>";
    echo "<td>".$row['firstname']."</td>";
    echo "<td>".$row['surname']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "</tr>";
}
echo "</table>";

} else {
    echo "0 results";
}
$result->close();
$mysqli->close();
}
?>
</body>
</html>
