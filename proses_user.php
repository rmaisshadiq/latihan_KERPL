<?php
require "koneksi.php";

if (isset($_GET['process']) == 'save') {
    if (isset($_POST['submit'])) {
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];

        $querySV = mysqli_query($db, "INSERT INTO user 
            (nama_lengkap, email, password, level)
            VALUE ('$nama_lengkap', '$email', '$password', '$level')");

        if ($querySV) {
            echo
            "<script>
                window.location = 'index.php?page=user';
            </script>";
        }
        else {
            echo
            "<script>
                window.location = 'index.php?page=user&action=create';
            </script>";
        }
    }
}
if (isset($_GET['process']) == 'edit') {
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $nama_lengkap = $_POST['nama_lengkap'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];

        $queryUP = mysqli_query($db, "UPDATE user SET
            nama_lengkap = '$nama_lengkap',
            email = '$email',
            password = '$password',
            level = '$level'
            WHERE id = '$id'");
        
        if ($queryUP) {
            echo "
            <script>
                window.location = 'index.php?page=user';
            </script>
            ";
        }
        else {
            echo
            "<script>
                window.location = 'index.php?page=user';
            </script>";
        }
    }
}
if (isset($_GET['process']) == 'delete') {
    $id = $_GET['id'];
    $queryDEL = mysqli_query($db, "DELETE FROM user WHERE id = $id");
    if ($queryDEL) {
        echo
        "<script>
            window.location = 'index.php?page=user';
        </script>";
    }
    else {
        echo
        "<script>
            window.location = 'index.php?page=user';
        </script>";
    }
}
?>