<?php
require_once ('dbaccess.php');

if(isset($_POST["username"]) && !empty($_POST["username"])
    && isset($_POST["password"]) && !empty($_POST["password"])
    && isset($_POST["useremail"]) && !empty($_POST["useremail"])) {
    
    echo "<pre>". '$_POST ' . print_r($_POST, true)."</pre>";

    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT); //https://www.php.net/manual/de/function.password-hash.php
    //to verify the output of password_hash() --> use password_verify //https://www.php.net/manual/de/function.password-verify.php
    //--> simple string comparison will not work!
    //$_POST["password"] = crypt ($_POST["password"], "xc14"); //https://www.php.net/manual/de/function.crypt.php

    //https://www.php.net/manual/de/function.hash.php
    //$_POST["password"] = hash('sha256', $_POST["password"]);
    //$_POST["password"] = hash('sha512', $_POST["password"]);
    //$_POST["password"] = hash('md5', $_POST["password"]); //MD5 is not save anymore!

    echo "<pre>". '$_POST ' . print_r($_POST, true)."</pre>";

    $db_obj = new mysqli($host, $user, $password, $database);

    //https://www.w3schools.com/php/php_mysql_prepared_statements.asp
    //https://www.php.net/manual/de/mysqli-stmt.bind-param.php

    //question marks (?) are parameters used for later variables bindings. $sql is like a template
    $sql = "INSERT INTO `users` (`username`, `password`, `useremail`) VALUES (?, ?, ?)";

    //use prepare function
    $stmt = $db_obj->prepare($sql);

    //"s" stands for string (string datatype is expected) ... i for integer, d for double
    //followed by the variables which will be bound to the parameters
    $stmt-> bind_param("sss", $uname, $pass, $mail);

    $uname = $_POST["username"];
    $pass = $_POST["password"];
    $mail = $_POST["useremail"];

    //executes the statement, if successful --> echo
    if ($stmt->execute()) {
        echo "New user created";
        //trigger forwarding to welcome-page, get-started tutorial,
        //confimation email with username (but without chosen password!), etc.
    }
    else {
        echo "Error";
        //or specific error-page
    }

    //close the statement
    $stmt->close();
    //close the connection
    $db_obj->close();
    header('Refresh: 1; URL =register.html');
}
?>