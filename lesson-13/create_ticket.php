<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <title>New Ticket</title>
</head>
<body>
<div class="container">
    <form action="" id="ticketform" method="POST" enctype="multipart/form-data">
        <div class="col">
            <textarea rows="4" cols="50" name="comment" form="ticketform" class="form-control" id="comment" placeholder="Comment"></textarea>
        </div>
        <div class="col">
            <div class="input-group">
                <div class="custom-file">
                        <input class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" type="file" name="picture" required accept="image/jpeg, image/png, image/gif">
                        <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                <button class="btn btn-outline-secondary" id="inputGroupFileAddon04" type="submit" name="submit">Upload</button>
                </form>
            </div>

        <?php
            $uid = 2; // get it from the $_SESSION
            $comment = "empty";
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $target_dir = 'pics/';
            $file = @$_FILES["picture"];
            $picname = explode(".", @$_FILES["picture"]["name"]);
            $target_file = $target_dir . $picname[0] . "_". $timestamp . "." . end($picname);
            //$target_file = $target_dir . $timestamp . "_". basename(@$_FILES["picture"]["name"]);
            $uploadStatus = 1;
            $acceptedtype = ["jpg", "jpeg", "png", "gif"];

            if (isset($_POST["submit"])) {
                if (isset($_POST["comment"]) && !empty($_POST["comment"])) {
                    $comment = $_POST["comment"];
                }

                // Check type
                $uploadExt = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                if (!in_array($uploadExt, $acceptedtype)) {
                    echo "<div class='red'>Sorry, only image-files can be accepted!</div>";
                    $uploadStatus = 0;
                }

                // Check file size
                if ($file["size"] > 15000000) {
                    echo "<div class='red'>Sorry, your file is too big! The maximum file size is 15MB!</div>";
                    $uploadStatus = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "<div class='red'>Sorry, this file already exists!</div>";
                    $uploadStatus = 0;
                }

                // Check if $uploadStatus is 0
                if ($uploadStatus == 0) {
                    echo "Please try again.<br>";
                }

                // If everything is OK, upload the file
                else {
                    if (move_uploaded_file($file["tmp_name"], $target_file)) {
                        createDBentry($comment, $target_file, $uid);
                    } else {
                        echo "<div class='red'>Sorry, something went wrong during the upload.</div>";
                    }
                }
            }

            function createDBentry($c, $path, $user_id) {
                require_once ('dbaccess.php');

                $db_obj = new mysqli($host, $user, $password, $database);
                $sql = "INSERT INTO `tickets` (`file_path`, `comment`, `user_id`) VALUES (?, ?, ?)";
                $stmt = $db_obj->prepare($sql);
                $stmt-> bind_param("ssi", $path, $c, $user_id);

                if ($stmt->execute()) {
                    echo "<div class='green'>The picture has been uploaded.</div>";
                }
                else {
                    echo "<div class='red'>Sorry, something went wrong during the upload.</div>";
                }
                $stmt->close();
                $db_obj->close();
            }

        ?>
    </div>
</div>
</body>
</html>