<?php
    require_once ('dbaccess.php'); //to retrieve connection details

    $db_obj = new mysqli($host, $user, $password, $database);

    if ($db_obj->connect_error) {
        echo "Connection Error: " . $db_obj->connect_error;
        exit();
    }

    $sql = "INSERT INTO `users` (`username`, `password`, `useremail`) VALUES ('Sheldon', 'Cooper', 'sheldon@cooper.com');";
    $result = $db_obj->query($sql);

    //question marks (?) are parameters used for later variables bindings. $sql is like a template
    $sql = "INSERT INTO `users` (`username`, `password`, `useremail`) VALUES (?, ?, ?)";

    //use prepare function
    $stmt = $db_obj->prepare($sql);

    //"s" stands for string (string datatype is expected) ... i for integer, d for double
    //followed by the variables which will be bound to the parameters
    $stmt-> bind_param("sss", $uname, $pass, $mail);

    $uname = "Sheldon"; 
    $pass = "Cooper"; 
    $mail = "sheldon@cooper.com";
    $stmt->execute();

    $uname = "Leonard"; 
    $pass = "Hofstadter"; 
    $mail = "leonard@hofstadter.com"; 
    $stmt->execute();

    // sql injection - prevented
    // $uname = "test1', 'test2', 'test3'); DELETE FROM users; INSERT INTO users (username, password, useremail) VALUES ('ddeed"; 
    // $pass = "Cooper"; 
    // $mail = "sheldon@cooper.com";
    // $stmt->execute();

    // sql injection - executed
    // $name = "test1', 'test2', 'test3'); DELETE FROM users; INSERT INTO users (username, password, useremail) VALUES ('ddeed";
    // $sql = "INSERT INTO users (username, password, useremail) VALUES ('$name', 'Cooper', 'sheldon@cooper.com');";
    // print $sql;
    // $result = $db_obj->multi_query($sql);
    
?>