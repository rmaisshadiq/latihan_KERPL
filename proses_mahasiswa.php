<?php
require "koneksi.php";

if (isset($_GET['process']) == 'save') {
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $gender = $_POST['gender'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];

        // Cek NIM sudah ada atau belum

        $cekNIM = mysqli_query($db, "SELECT nim FROM mahasiswa WHERE nim = '$nim'");
        if (mysqli_num_rows($cekNIM) > 0) {
            echo "<script>alert('NIM sudah terdaftar!');window.location = 'index.php?page=mahasiswa&action=create';</script>";
            exit();
        }

        $querySV = mysqli_query($db, "INSERT INTO mahasiswa 
            (nama, email, nim, prodi_id, gender, hobi, alamat)
            VALUE ('$nama', '$email', '$nim', '$prodi', '$gender', '$hobi', '$alamat')");

        if ($querySV) {
            echo 
            "<script>
                window.location = 'index.php?page=mahasiswa';
            </script>";
        } else {
            echo 
            "<script>
                window.location = 'index.php?page=mahasiswa&action=create';
            </script>";
        }
    }
}
if (isset($_GET['process']) == 'edit') {
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $gender = $_POST['gender'];
        $hobi = implode(", ", $_POST['hobi']);
        $alamat = $_POST['alamat'];


        $queryUP = mysqli_query($db,"UPDATE mahasiswa SET nama='$nama', email='$email', gender='$gender', hobi='$hobi', alamat='$alamat', prodi_id='$prodi' WHERE nim='$nim'");

        if ($queryUP) {
            echo 
            "<script>
                window.location = 'index.php?page=mahasiswa';
            </script>";
        } else {
            echo 
            "<script>
                alert('Data gagal diedit.');
                window.location = 'index.php?page=mahasiswa';
            </script>";
        }
    }
}
if (isset($_GET['process']) == 'delete') {
    $id = $_GET['id'];
    $queryDEL = mysqli_query($db,"DELETE FROM mahasiswa WHERE id = $id");
    if ($queryDEL) {
        echo 
        "<script>
            window.location = 'index.php?page=mahasiswa';
        </script>";
    } else {
        echo 
        "<script>
            alert('Data gagal dihapus.');
            window.location = 'index.php?page=mahasiswa';
        </script>";
    }
}
