<?php
    // Konfigurasi database
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "web_trpl2d";

    // Membuat koneksi ke database
    $db = mysqli_connect($host, $user, $password, $database);

    // Memeriksa apakah koneksi berhasil atau tidak
    if (!$db) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }