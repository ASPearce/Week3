<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $_SESSION['isLoggedIn'] = FALSE;
        
        if (!isset( $_POST['Submit'] )) 
           {
             echo "<p>ERROR - Login Failed</p>";    
           }
        else {                
            $stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?");

            $stmt->bind_param('s', $_POST['email']);

            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();

            if (!empty($user['email'])) {
                if (password_verify($_POST['password'], $user['password'])) {

            echo "<p> login successful </p>";
            session_start();
            $_SESSION['isLoggedIn'] = TRUE;
            $_SESSION['user'] = $user['email'];
            
            if ($_SESSION['isLoggedIn'] === TRUE)
                {
                    echo "<p>Welcome ".$_SESSION['user'];
                }
                else { header("Location: login.php"); }

            } else { echo "<p>Login Failed</p>"; }            
        } else { echo "<p>This user does not exist</p>"; }
        $stmt->close();
        $mysqli->close(); 
    }
}
else {
?>
<h1>Login to your account</h1>
<form action="login.php" method="POST" >
    Email:<br>
    <input type="text" id="email" name="email"/>
    <br>
    Password:<br>
    <input type="text" id="password" name="password"/>
    <br>
    <input type="submit" name="Submit" value="Login"/>
    <?php echo "<a href=\"newuser.php\">New User?</a>"; ?>
</form>
</body>
</html>
<?php
}
?>
