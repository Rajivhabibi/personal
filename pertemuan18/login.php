<?php
session_start();
require 'functions.php';


// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Ambil username berdasarkan id
    $result = mysqli_query($link, "SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    // Cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header('Location: index.php');
    exit;
}


if (isset($_POST["login"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($link, "SELECT * FROM users 
    WHERE username = '$username'");

    // Cek username
    if (mysqli_num_rows($result) === 1) {

        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION['login'] = true;

            // Cek remember me
            if (isset($_POST['remember'])) {
                // Buat Cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash(sha256, $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>












<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="bootstrap/css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/stile.css">

    <title>Halaman Login</title>

    <style type="text/css">
        a {
            margin-left: 115px;
            color: black;
            text-decoration: none;

        }

        a:hover {
            text-decoration: none;
            color: rgb(36, 26, 26);
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <form class="form-signin" action="" method="post">
            <h2 class="form-signin-heading text-center"> Sign In</h2>

            <?php if (isset($error)) : ?>
                <p>Sorry the credentials you are using are invalid</p>
            <?php endif; ?>

            <input class="form-control" type="text" name="username" placeholder="Username" required>
            <input class="form-control" type="password" name="password" placeholder="Password" required>

            <label class="checkbox">
                <input for="remember" type="checkbox" name="remember" value="remember-me" id="rememberme"> Remember Me

                <a href="registrasi.php">Register</a>
            </label>
            <button class="btn btn-danger btn-block" type="submit" name="login"> Sign In</button>
        </form>
    </div>

</body>

</html>