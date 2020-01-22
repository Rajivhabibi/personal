<?php
session_start();

if (!isset($_SESSION['login'])) {

    header('Location: login.php');
    exit;
}
require "functions.php";

// Ambil data di url
$id = $_GET["id"];

// Query data anime berdasarkan id
$anm = query("SELECT * FROM daftaranime WHERE id = $id")[0];



// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // Cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        echo "
            <script>
                alert('Success');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Failed');
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
    <title>Ubah Data</title>
</head>

<body>

    <div class="wrapper">
        <form class="form-signin" action="" method="post" enctype="multipart/form-data">
            <h2 class="form-signin-heading text-center"> Change Data</h2>
            <input type="hidden" name="id" value="<?= $anm["id"]; ?> ">
            <input type="hidden" name="oldgambar" value="<?= $anm["gambar"]; ?> ">





            <input class="form-control" placeholder="Title" type="text" name="judul" required value="<?= $anm["judul"]; ?>">
            <input class="form-control" placeholder="Release" type="text" name="rilis" required value="<?= $anm["rilis"]; ?>">
            <input class="form-control" placeholder="Director" type="text" name="director" required value="<?= $anm["director"]; ?>">
            <input class="form-control" placeholder="Rottentomatoes" type="text" name="rottentomatoes" required value="<?= $anm["rottentomatoes"]; ?>">

            <img src="img/<? $anm['gambar']; ?>" width="30">
            <input type="file" name="gambar" class="form-control">
            <br>




            <button class="btn btn-danger btn-block" type="submit" name="submit"> Ubah data !</button>

    </div>
    </form>

</body>

</html>