<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Document</title>
</head>
<body>

    <?php
        require_once ('dbaccess.php');

        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $sql = "SELECT * FROM users";
        $result = $db_obj->query($sql);
    ?>

    <h1>Entries in table <i>users</i></h1>
    <table border="1">
        <th>id</th>
        <th>username</th>
        <th>password</th>
        <th>useremail</th>

        <?php
            while ($zeile = $result->fetch_array()) {
                echo "<tr>";
                echo "<td>" . $zeile['id'] . "</td>";
                echo "<td>" . $zeile['username'] . "</td>";
                echo "<td>" . $zeile['password'] . "</td>";
                echo "<td>" . $zeile['useremail'] . "</td>";
                echo "</tr>";
            }
        ?>
    </table>

</body>
</html>