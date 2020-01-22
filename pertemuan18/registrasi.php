<?php

require 'functions.php';

if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo "<script>
        alert('Berhasil mendaftar');
            </script>";
    } else {

        echo mysqli_error($link);
    }
}







?>



<style type="text/css"></style>



<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="bootstrap/css/registrasi.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Registrasi</title>
    <br>



</head>

<body>


    <div class="wrapper">
        <form class="form-signin" action="" method="post">
            <h2 class="form-signin-heading text-center">Sign Up</h2>


            <input class="form-control" type="text" name="username" placeholder="Username" required>


            <input class="form-control" type="password" name="password" placeholder="Password" required>
            <input class="form-control" type="password" name="password2" required placeholder="Confirm Password">



            <button class="btn btn-danger btn-block" type="submit" name="register">Register</button>

        </form>
    </div>
</body>

</html>