<?php
    session_start();

    if (isset($_GET["logout"]) && $_GET["logout"] === "true") {
        unset($_SESSION["user"]);
        header("Location: ".strtok("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", "?"));
        die();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["username"]) && isset($_POST["password"])
            && $_POST["username"] === "admin"
            && $_POST["password"] === "admin"
            ) {
                $_SESSION["user"] = "admin";
            }
    }
?>

<?php echo json_encode($_SESSION)?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Login</h1>
                </div>
            </div>
            <?php if (!isset($_SESSION["user"])): ?>
    	        <form method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                    <button class="btn btn-primary" type="submit">Login</button>
                </form>
            <?php else: ?>
                <h2>Hello <span class="badge bg-secondary"><?php echo $_SESSION["user"] ?></span></h2>
                <a class="btn btn-primary" href="?logout=true">Logout</a>
            <?php endif ?>    
        </div>
    </body>
</html>