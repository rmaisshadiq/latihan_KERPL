<?php
require "koneksi.php";

if (isset($_GET['process']) == 'save') {
    if (isset($_POST['submit'])) {
        $nip = $_POST['nip'];
        $nama_dosen = $_POST['nama_dosen'];
        $prodi_id = $_POST['prodi'];
        $filename = $_FILES['foto']['name'];
        $tempname = $_FILES['foto']['tmp_name'];
        $folder = "./image/" . $filename;

        move_uploaded_file($tempname, $folder);

        $sqlSV = "INSERT INTO dosen
            (nip, nama_dosen, prodi_id, foto)
            VALUE ('$nip', '$nama_dosen', '$prodi_id', '$filename')";

        

        $querySV = mysqli_query($db, $sqlSV);

        if ($querySV) {
            echo
            "<script>
                window.location = 'index.php?page=dosen';
            </script>";
        } else {
            echo
            "<script>
                alert('GAGAL!');
                window.location = 'index.php?page=dosen';
            </script>";
        }
    }
}
