<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

include 'connect.php';

    if (!isset( $_POST['Submit'] )) {
        echo "<p>ERROR - form was not submitted</p>";
    }
    else {
        $insertquery = "INSERT INTO users SET firstname=?, surname=?,     email=?, password=?";
    
        $insertstmt = $mysqli->prepare($insertquery);

        $hashedpassword = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        $insertstmt->bind_param('ssss', $_POST['fname'], $_POST['sname'], $_POST['email'], $hashedpassword);

        if (!$insertstmt->execute()) {
            echo "Error: ".$mysqli->error;
        }
        else {
            echo "New user creation was successful<br>";
            echo "<a href=\"display.php\">display</a>";
        }

$mysqli->close();
    }
}
else {
?>
<!DOCTYPE html>
<html>
<head>
<title>Add User</title>
</head>
<body>
<h1>Add record</h1>
<form action="newuser.php" method="post" >
    Firstname: <input type="text" id="fname" name="fname"/>
    Surname:   <input type="text" id="sname" name="sname"/>
    Email:     <input type="text" id="email" name="email"/>
    Password:  <input type="text" id="pass"  name="pass" />
    <input type="submit" id="Submit" name="Submit" value="Submit"/>
</form>
</body>
</html>
<?php
}
?>

