<?php
session_start();

if (!isset($_SESSION['login'])) {

    header('Location: login.php');
    exit;
}
require "functions.php";

// Pagination
// Konfigurasi

$jumlahdataperhalaman = 2;
$jumlahdata = count(query("SELECT * FROM daftaranime"));
$jumlahhalaman = ceil($jumlahdata / $jumlahdataperhalaman);
$halamanaktif = (isset($_GET["p"])) ? $_GET["p"] : 1;

$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;





$daftar = query("SELECT * FROM daftaranime LIMIT $awaldata,$jumlahdataperhalaman");

// Tombol cari ditekan
if (isset($_GET["search"])) {
    $daftar = search($_GET["cari"]);
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Admin</title>
</head>

<body>

    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <h1 class="display-4">Daftar tabel anime</h1>
            <p>Daftar anime favorit keluaran mulai 2001 - 2019 akhir</p>
        </div>
    </div>






    <a href="index.php">
        <h1 class="text-center era">Daftar Anime</h1>
    </a>
    <a href="logout.php" class="khua">Logout</a>
    <br>
    <br>

    <p class="text-center era"><a href="tambah.php">Tambah Data Anime</a></p>


    <form action="" method="get">

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="input-group">
                        <input class="form-control" type="text" name="cari" autofocus placeholder="Search" autocomplete="off">
                        <span class="input-group-btn">
                            <button class="btn btn-dark btn_space" type="submit" name="search">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <!-- Navigasi -->

    <?php if ($halamanaktif > 1) : ?>
        <a href="?p=<?= $halamanaktif - 1; ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
        <?php if ($i == $halamanaktif) : ?>
            <a href="?p=<?= $i; ?>" style="font-weight:bold; color:red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?p=<?= $i;  ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if ($halamanaktif < $jumlahhalaman) : ?>
        <a href="?p=<?= $halamanaktif + 1; ?>">&raquo;</a>
    <?php endif; ?>











    <br>
    <div class=" container">
        <table class="table table-striped table-dark table table-bordered">

            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Aksi</th>
                <th class="text-center">Gambar</th>
                <th class="text-center">Judul</th>
                <th class="text-center">Rilis</th>
                <th class="text-center">Director</th>
                <th class="text-center">Rotten Tomatoes</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($daftar as $row) :   ?>

                <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <button type="button" class="btn btn-info "><a class="ea text-center" href="ubah.php?id=<?= $row["id"]; ?>">UBAH</a> </button>
                        <button type="button" class="btn btn-danger"> <a class="ea" href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('U Sure ?');">Delete</a></button>
                    </td>
                    <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                    <td><?= $row["judul"]; ?></td>
                    <td align="center"><?= $row["rilis"]; ?></td>
                    <td><?= $row["director"]; ?></td>
                    <td align="center"><?= $row["rottentomatoes"]; ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>