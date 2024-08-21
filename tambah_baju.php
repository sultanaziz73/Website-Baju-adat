<?php
include 'config.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $asal = $_POST['asal'];
    $deskripsi = $_POST['deskripsi'];
    
    // Proses upload file
    $target_dir = __DIR__ . "/uploads/";
    $file_name = basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . time() . '_' . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Cek apakah file gambar
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }

    // Cek ukuran file
    if ($_FILES["gambar"]["size"] > 500000) {
        echo "Maaf, file terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan format file tertentu
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
        $uploadOk = 0;
    }

    // Upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $stmt = $pdo->prepare('INSERT INTO baju_adat (nama, asal, deskripsi, gambar) VALUES (?, ?, ?, ?)');
            $stmt->execute([$nama, $asal, $deskripsi, $target_file]);
            header('Location: baju_adat.php');
            exit;
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
}
?>

<h2 class="text-2xl font-bold mb-4">Tambah Baju Adat</h2>
<form action="" method="post" enctype="multipart/form-data" class="max-w-lg">
    <div class="mb-4">
        <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Baju</label>
        <input type="text" id="nama" name="nama" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="asal" class="block text-gray-700 text-sm font-bold mb-2">Asal Daerah</label>
        <input type="text" id="asal" name="asal" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <div class="mb-4">
        <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>
    <div class="mb-4">
        <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Foto Baju Adat</label>
        <input type="file" id="gambar" name="gambar" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Tambah Baju Adat
    </button>
</form>

<?php include 'includes/footer.php'; ?>