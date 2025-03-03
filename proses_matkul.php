<?php
require 'koneksi.php';

if (isset($_GET['process']) == 'save') {
    if (isset($_POST['submit'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];
        $dosen_nip = $_POST['nip'];
        $semester = $_POST['semester'];


        $querySV = mysqli_query($db, "INSERT INTO mata_kuliah
            (kode_mk, nama_mk, sks, dosen_nip, semester)
            VALUE ('$kode_mk', '$nama_mk', '$sks', '$dosen_nip', '$semester')");

        if ($querySV) {
            echo
            "<script>
                window.location = 'index.php?page=matkul';
            </script>";
        } else {
            echo
            "<script>
                window.location = 'index.php?page=matkul';
            </script>";
        }
    }
}

if (isset($_GET['process']) == 'edit') {
    if (isset($_POST['update'])) {
        $kode_mk = $_POST['kode_mk'];
        $nama_mk = $_POST['nama_mk'];
        $sks = $_POST['sks'];
        $dosen_nip = $_POST['nip'];
        $semester = $_POST['semester'];

        $queryUP = mysqli_query($db, "UPDATE mata_kuliah
            SET kode_mk='$kode_mk',
            nama_mk='$nama_mk',
            sks='$sks',
            dosen_nip='$dosen_nip',
            semester='$semester'
            WHERE kode_mk='$kode_mk'");

        if ($queryUP) {
            echo
            "<script>
        window.location = 'index.php?page=matkul';
    </script>";
        } else {
            echo
            "<script>
        window.location = 'index.php?page=matkul';
    </script>";
        }
    }
}

if (isset($_GET['process']) == 'delete') {
    $kode_mk = $_GET['id'];
    $queryDEL = mysqli_query($db, "DELETE FROM mata_kuliah WHERE kode_mk = $kode_mk");

    if ($queryDEL) {
        echo
        "<script>
    window.location = 'index.php?page=matkul';
</script>";
    } else {
        echo
        "<script>
    window.location = 'index.php?page=matkul';
</script>";
    }
}
