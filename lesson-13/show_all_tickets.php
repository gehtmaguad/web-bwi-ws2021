<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>All tickets</title>
</head>
<body>

    <?php
        require_once ('dbaccess.php');

        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        $sql = "SELECT * FROM tickets";
        $stmt = $db_obj->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($ticketID, $file_path, $comment, $user_id);
    ?>

    <h1>Tickets</h1>
    <table border="1">
        <th>Ticket ID</th>
        <th>User ID</th>
        <th>Comment</th>
        <th>Picture</th>

        <?php
            while ($stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $ticketID . "</td>";
                echo "<td>" . $user_id . "</td>";
                echo "<td>" . $comment . "</td>";
                echo "<td><a href='" . $file_path . "' target='_blank'><img src='$file_path' alt='picture' height='50'></a>". "</td>";
                echo "</tr>";
            }
            $stmt->close();
            $db_obj->close();
        ?>
    </table>

</body>
</html>