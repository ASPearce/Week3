<?php

include 'connect.php';

if (isset($_POST['Submit']))
{
        $updatequery ="UPDATE users SET firstname=?, surname=?, email=?, password=? WHERE id=?";

        $stmt = $mysqli->prepare($updatequery);

        $stmt->bind_param('ssssi', $_POST['fname'], $_POST['sname'], $_POST['email'], $_POST['pass'], $_GET['id']);

     if (!$stmt->execute()) {
            echo "Error: ".$mysqli->error;
     }
      else {
         echo "<p>Record updated successfully</p>";
         echo "<a href=\"display.php\">display</a>"; 
        }
        $mysqli->close();
}
else {

        $populatequery = "SELECT * from users WHERE ID='".$_GET['id']."'";
        $result = $mysqli->query($populatequery);
        
        if ($result) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc())
                {
                    $fn = $row['firstname'];
                    $sn = $row['surname'];
                    $em = $row['email'];
                    $pw = $row['password'];
                }
            }
        }
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit User</title>
</head>
<body>
<h1>Edit record:</h1>
<form action="edit.php?id=<?php echo $_GET['id'];?>" method="post" >
    Firstname: <input type="text" id="fname" name="fname" value="<?php echo $fn;?> "/>
    Surname:   <input type="text" id="sname" name="sname" value="<?php echo $sn;?> "/>
    Email:     <input type="text" id="email" name="email" value="<?php echo $em;?> "/>
    Password:  <input type="text" id="pass"  name="pass" />
    <input type="submit" id="Submit" name="Submit" value="Submit"/>
</form>
</body>
</html>
<?php
        }
?>
