<?php
$link = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query)
{
    global $link;
    $result = mysqli_query($link, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}





function tambah($data)
{
    // Ambil data dari tiap elemen dalam form
    global $link;

    $judul = htmlspecialchars($data["judul"]);
    $rilis = htmlspecialchars($data["rilis"]);
    $director = htmlspecialchars($data["director"]);
    $rottentomatoes = htmlspecialchars($data["rottentomatoes"]);

    // Upload Gambar

    $gambar = upload();
    if (!$gambar) {
        return false;
    }



    $query = "INSERT INTO daftaranime
                VALUES 
                ('' ,'$judul' , '$rilis' , '$director', '$rottentomatoes', '$gambar' )
                ";

    mysqli_query($link, $query);

    return mysqli_affected_rows($link);
}
function hapus($id)
{
    global $link;
    mysqli_query($link, "DELETE FROM daftaranime WHERE id = $id");
    return mysqli_affected_rows($link);
}

function ubah($data)
{
    global $link;
    $id = $data["id"];

    $judul = htmlspecialchars($data["judul"]);
    $rilis = htmlspecialchars($data["rilis"]);
    $director = htmlspecialchars($data["director"]);
    $rottentomatoes = htmlspecialchars($data["rottentomatoes"]);
    $oldgambar = $data["oldgambar"];

    // Cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $oldgambar;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE daftaranime 
            SET  
            judul = '$judul' , 
            rilis = '$rilis' ,
            director = '$director',
            rottentomatoes = '$rottentomatoes',
            gambar = '$gambar' 
           
            
            WHERE id = $id ";

    mysqli_query($link, $query);
    return mysqli_affected_rows($link);
}

function search($cari)
{

    $query = "SELECT * FROM daftaranime
    WHERE 
    judul LIKE '%$cari%' OR 
    rilis LIKE '%$cari%' OR
    director LIKE '%$cari%' OR
    rottentomatoes LIKE '%$cari%'
    ";

    return query($query);
}


function upload()
{
    $namefile = $_FILES['gambar']['name'];
    $filesize = $_FILES['gambar']['size'];
    $failed = $_FILES['gambar']['error'];
    $tmpname = $_FILES['gambar']['tmp_name'];

    // Cek apakah tidak ada gambar yang diupload

    if ($failed === 4) {
        echo "<script> 

    alert('Pilih gambar dulu');

    </script>";
        return false;
    }

    // Cek ekstensi file. gambar bukan
    $gambarvalid = ['jpg', 'jpeg', 'png'];
    $exgambar = explode('.', $namefile);
    $exgambar = strtolower(end($exgambar));
    if (!in_array($exgambar, $gambarvalid)) {
        echo "<script> 

    alert('Yang diupload bukan gambar');

    </script>";
    }


    // cek jika ukuran terlalu besar
    if ($filesize > 2000000) {
        echo "<script> 

    alert('Ukuran gambar terlalu besar');

    </script>";
    }


    // Lolos pengecekan, gambar siap diupload
    // Generate nama gambar baru
    $newnamefile = uniqid();
    $newnamefile .= '.';
    $newnamefile .= $exgambar;




    move_uploaded_file($tmpname, 'img/' . $newnamefile);
    return $newnamefile;
}

function register($data)
{

    global $link;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($link, $data['password']);
    $password2 = mysqli_real_escape_string($link, $data['password2']);

    // Cek username sudah ada atau belum

    $result = mysqli_query($link, "SELECT username FROM users 
    WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
    alert('Username sudah didaftarkan')
    </script>";
        return false;
    }




    // Cek konfirmasi password
    if ($password !== $password2) {

        echo "<script>
            alert('Confirmed password unmatch');
            </script>";
        return false;
    }


    // Enkripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database

    mysqli_query($link, "INSERT INTO users VALUES('' , '$username' , '$password')");


    return mysqli_affected_rows($link);
}
