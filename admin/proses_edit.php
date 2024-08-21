<?php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    $kabupaten = $_POST['kabupaten']; // Tambahkan kabupaten
    $deskripsi = $_POST['deskripsi'];

    // Jika ada file gambar yang diunggah, proses upload dan update nama file
    if ($_FILES['gambar']['name']) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        // Update data dengan gambar
        $sql = "UPDATE baju_adat SET nama = ?, asal = ?, kabupaten = ?, deskripsi = ?, gambar = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $asal, $kabupaten, $deskripsi, basename($_FILES["gambar"]["name"]), $id]);
    } else {
        // Update data tanpa mengganti gambar
        $sql = "UPDATE baju_adat SET nama = ?, asal = ?, kabupaten = ?, deskripsi = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $asal, $kabupaten, $deskripsi, $id]);
    }

    header("Location: index.php");
    exit();
}
?>
