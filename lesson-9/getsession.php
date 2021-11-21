<?php
    session_start();
    echo "theme is: " . $_SESSION["theme"]; 
    echo "<br>";
    echo "username is: " . $_SESSION["username"]; 
    echo "<br>";
    echo "visits count is: " . $_SESSION["visits"];
?>
