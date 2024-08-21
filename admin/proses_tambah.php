<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    $kabupaten = $_POST['kabupaten']; // Menangkap data kabupaten dari form
    $deskripsi = $_POST['deskripsi'];
    
    // Upload file
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

    // Insert data ke database
    $sql = "INSERT INTO baju_adat (nama, asal, kabupaten, deskripsi, gambar) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nama, $asal, $kabupaten, $deskripsi, basename($_FILES["gambar"]["name"])]);

    header("Location: index.php");
}
?>
