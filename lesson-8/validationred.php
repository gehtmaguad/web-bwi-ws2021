<?php
$errors = [];
$errors["username"] = false;
$errors["username_msg"] = null;
$errors["agree"] = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!str_contains($_POST["username"], '@')) {
        $errors["username"] = true;
        $errors["username_msg"] = "Ungültige Email";
    }

    if (empty($_POST["username"])) {
        $errors["username"] = true;
        $errors["username_msg"] = "Keine Email";
    }

    if (!$errors["username"] && !$errors["agree"]) {
        echo "Given Array is empty";
        header('Location: http://127.0.0.1:8080/success.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <title>Validation</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Validation</h1>
            </div>
        </div>
        <form method="post" action="/validation.php">
            <div class="form-floating mb-3">
                <input type="text" class="form-control <?php if ($errors['username']) echo 'is-invalid'; ?>" name="username" id="username" placeholder="Username">
                <label for="username">Username</label>
                <?php  if ($errors['username']) echo '<p style="color: red">'.$errors['username_msg'].'</p>'; ?>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input <?php if ($errors['agree']) echo 'is-invalid'; ?>" name="agree" id="agree">
                <label class="form-check-label" for="agree">Agree</label>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>

</html>