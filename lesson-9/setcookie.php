<?php
    $value = 'something from somewhere';
    setcookie("TestCookie", $value);
    /* expire in 1 hour */ 
    setcookie("TestCookie", $value, time()+3600);
?>