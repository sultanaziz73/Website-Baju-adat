<?php
include '../config.php';

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM baju_adat WHERE id = ?');
$stmt->execute([$id]);
$row = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Baju Adat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Edit Baju Adat</h2>
            <form action="proses_edit.php" method="post" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                
                <div>
                    <label for="nama" class="block text-gray-700 font-medium">Nama Baju Adat:</label>
                    <input type="text" id="nama" name="nama" class="w-full mt-1 border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200 focus:border-blue-500" value="<?= htmlspecialchars($row['nama']) ?>" required>
                </div>
                
                <div>
                    <label for="asal" class="block text-gray-700 font-medium">Asal:</label>
                    <select id="asal" name="asal" class="w-full mt-1 border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                        <option value="">Pilih Asal Provinsi</option>
                        <option value="Jawa Barat" <?= $row['asal'] == "Jawa Barat" ? 'selected' : '' ?>>Jawa Barat</option>
                        <option value="Jawa Tengah" <?= $row['asal'] == "Jawa Tengah" ? 'selected' : '' ?>>Jawa Tengah</option>
                        <option value="Jawa Timur" <?= $row['asal'] == "Jawa Timur" ? 'selected' : '' ?>>Jawa Timur</option>
                        <!-- Tambahkan provinsi lainnya sesuai kebutuhan -->
                    </select>
                </div>
                
                <div>
                    <label for="kabupaten" class="block text-gray-700 font-medium">Kabupaten:</label>
                    <select id="kabupaten" name="kabupaten" class="w-full mt-1 border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200 focus:border-blue-500" required>
                        <!-- Kabupaten akan diisi secara dinamis melalui JavaScript -->
                    </select>
                </div>
                
                <div>
                    <label for="deskripsi" class="block text-gray-700 font-medium">Deskripsi:</label>
                    <textarea id="deskripsi" name="deskripsi" class="w-full mt-1 border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200 focus:border-blue-500" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                </div>
                
                <div>
                    <label for="gambar" class="block text-gray-700 font-medium">Gambar (biarkan kosong jika tidak ingin mengganti):</label>
                    <input type="file" id="gambar" name="gambar" class="w-full mt-1 border border-gray-300 p-2 rounded focus:ring focus:ring-blue-200 focus:border-blue-500">
                </div>
                
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-200">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const kabupatenData = {
            "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Cirebon"],
            "Jawa Tengah": ["Semarang", "Surakarta", "Magelang", "Purwokerto"],
            "Jawa Timur": ["Surabaya", "Malang", "Kediri", "Madiun"],
            "Sulawesi Selatan": ["Makassar", "Toraja", "Maros", "Enrekang"],
            "Aceh": ["Aceh Barat", "Aceh Besar", "Aceh Jaya", "Aceh Selatan"],
            // Tambahkan kabupaten lainnya sesuai kebutuhan
        };

        const asalSelect = document.getElementById('asal');
        const kabupatenSelect = document.getElementById('kabupaten');

        // Fungsi untuk mengisi kabupaten berdasarkan asal yang dipilih
        function updateKabupaten() {
            const selectedAsal = asalSelect.value;
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>'; // Reset kabupaten options

            if (kabupatenData[selectedAsal]) {
                kabupatenData[selectedAsal].forEach(function (kabupaten) {
                    const option = document.createElement('option');
                    option.value = kabupaten;
                    option.textContent = kabupaten;
                    kabupatenSelect.appendChild(option);
                });
            }

            // Set value kabupaten yang telah ada sebelumnya
            kabupatenSelect.value = '<?= $row['kabupaten'] ?>';
        }

        // Panggil fungsi updateKabupaten ketika halaman dimuat
        window.onload = function () {
            updateKabupaten(); // Panggil fungsi saat halaman dimuat
        };

        // Tambahkan event listener ketika asal berubah
        asalSelect.addEventListener('change', updateKabupaten);
    </script>
</body>
</html>
