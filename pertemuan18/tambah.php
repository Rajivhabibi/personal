<?php
session_start();

if (!isset($_SESSION['login'])) {

    header('Location: login.php');
    exit;
}
require "functions.php";


// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {


    // Cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Failed');
                document.location.href = 'index.php';
            </script>
        ";
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="bootstrap/css/login.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
</head>

<body>



    <div class="wrapper">
        <form class="form-signin" action="" method="post" enctype="multipart/form-data">
            <h2 class="form-signin-header text-center"> Add Anime</h2><br>

            <input class="form-control" type="text" name="judul" required placeholder="Title">
            <input class="form-control" type="text" name="rilis" required placeholder="Release">
            <input class="form-control" type="text" name="director" required placeholder="Director">
            <input class="form-control" type="text" name="rottentomatoes" required placeholder="Rottentomatoes">
            <input type="file" name="gambar">
            <br><br>

            <button class="btn btn-danger btn-block" type="submit" name="submit"> Add !</button>


        </form>
    </div>

</body>

</html>