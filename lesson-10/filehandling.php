<?php
    $uploadDir = "uploads/";

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
        
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <title>File Upload</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>File Upload</h1>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input class="form-control" type="file" id="file" name="file">
                </div>
                <button class="btn btn-primary" type="submit">Upload</button>
            </form>
            <div class="row mt-3">
                <div class="col">
                    <h2>Files</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-group">
                    <?php
                        if (file_exists($uploadDir)) {
                            $files = scandir($uploadDir);

                            for ($i = 2; isset($files[$i]); $i++) {
                                echo '<li class="list-group-item">' . $files[$i] .'</li>';
                            }

                            if (count($files) == 2) {
                                echo '<li class="list-group-item">No files...</li>';
                            }
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </body>
</html>