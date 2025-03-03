<?php
require 'koneksi.php';

if (isset($_GET['process']) == 'save') {
    if (isset($_POST['submit'])) {
        $nama_prodi = $_POST['nama_prodi'];
        $jenjang = $_POST['jenjang'];
        $keterangan = $_POST['keterangan'];


        $querySV = mysqli_query($db, "INSERT INTO prodi 
                (nama_prodi, jenjang, keterangan)
                VALUE ('$nama_prodi', '$jenjang', '$keterangan')");

        if ($querySV) {
            echo
            "<script>
                    window.location = 'index.php?page=prodi';
                </script>";
        } else {
            echo
            "<script>
                    window.location = 'index.php?page=prodi&action=create';
                </script>";
        }
    }
}

if (isset($_GET['process']) == 'edit') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_prodi = $_POST['nama_prodi'];
        $jenjang = $_POST['jenjang'];
        $keterangan = $_POST['keterangan'];


        $queryUP = mysqli_query($db, "UPDATE prodi SET nama_prodi='$nama_prodi', jenjang='$jenjang', keterangan='$keterangan' WHERE id='$id'");

        if ($queryUP) {
            echo
            "<script>
                    window.location = 'index.php?page=prodi';
                </script>";
        } else {
            echo
            "<script>
                    alert('Data gagal diedit.');
                    window.location = 'index.php?page=prodi';
                </script>";
        }
    }
}

if (isset($_GET['process']) == 'delete') {
    $id = $_GET['id'];
    $queryDEL = mysqli_query($db, "DELETE FROM prodi WHERE id=$id");

    if ($queryDEL) {
        echo
        "<script>
                window.location = 'index.php?page=prodi';
            </script>";
    } else {
        echo
        "<script>
                alert('Data gagal dihapus.');
                window.location = 'index.php?page=prodi';
            </script>";
    }
}
