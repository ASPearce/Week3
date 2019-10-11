<?php

include 'connect.php';

        $stmt = $mysqli->prepare("DELETE FROM users WHERE ID =?");

        $stmt->bind_param('i',$_GET['id']);

     if (!$stmt->execute()) {
            echo "Error: ".$mysqli->error;
     }
      else {
         echo "<p>Record deleted successfully</p>"; 
        }
        $mysqli->close();
?>
