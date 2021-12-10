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
        if(isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
            //echo $delete_id;
        } else {
            $delete_id = 0;
            //echo $delete_id;
        }
        
        //Same functionality using ternary operator
        //$delete_id = (isset($_POST['delete_id']))?$_POST['delete_id']:NULL;

        require_once ('dbaccess.php');

        $db_obj = new mysqli($host, $user, $password, $database);
        if ($db_obj->connect_error) {
            echo "Connection Error: " . $db_obj->connect_error;
            exit();
        }

        if ($delete_id > 0) { // delete a table entry
		    $deletesql = "DELETE FROM users WHERE id = $delete_id";
            $result = $db_obj->query($deletesql);
		    echo "<div class=redbg>User with ID $delete_id has been deleted.</div>";
            header('Refresh: 2;');
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
        <th><img src="drop_b.svg"></th>

    <?php
        while ($zeile = $result->fetch_array()) {
            $tbl_id = $zeile['id'];

            echo "<tr>";
            echo "<td>" . $tbl_id . "</td>";
            echo "<td>" . $zeile['username'] . "</td>";
            echo "<td>" . $zeile['password'] . "</td>";
            echo "<td>" . $zeile['useremail'] . "</td>";
            echo '<td><form action="' . $_SERVER["PHP_SELF"]. '" method="post"><INPUT TYPE="image" SRC="drop.svg" BORDER="0" ALT="Submit Form"><input name="delete_id" type="hidden" value=' . $tbl_id . '></form></td>';
            //echo '<td><a href="' . $_SERVER['PHP_SELF'] . '?delete_id=' . $tbl_id .'"><img border=0 src=drop.png></a></td>';
            echo "</tr>";
        }
    ?>
    </table>

</body>
</html>