<?php
    session_start();
    $_SESSION["theme"] = "dark"; 
    $_SESSION["username"] = "exampleuser"; 
    $_SESSION["visits"] = ++$_SESSION["visits"];
?>
