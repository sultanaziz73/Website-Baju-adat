<?php include '../includes/header.php'; ?>

<h2 class="text-3xl font-bold text-center mb-8">Tambah Baju Adat</h2>
<div class="container mx-auto px-4">
    <form action="proses_tambah.php" method="post" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label for="nama" class="block text-gray-700">Nama Baju Adat:</label>
            <input type="text" id="nama" name="nama" class="w-full border border-gray-300 p-2 rounded" required>
        </div>
        <div>
            <label for="asal" class="block text-gray-700">Asal:</label>
            <select id="asal" name="asal" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Pilih Asal Provinsi</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Jawa Tengah">Jawa Tengah</option>
                <option value="Jawa Timur">Jawa Timur</option>
                <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                <option value="Aceh">Aceh</option>
                <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                <option value="Bali">Bali</option>
                <option value="Bangka Belitung">Bangka Belitung</option>
                <option value="Sumatera Utara">Sumatera Utara</option>
                <option value="Bengkulu">Bengkulu</option>
                <option value="DKI Jakarta">DKI Jakarta</option>
                <option value="Gorontalo">Gorontalo</option>
                <option value="Jambi">Jambi</option>
                <option value="Kalimantan Barat">Kalimantan Barat</option>
                <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                <option value="Kalimantan Tengah">Kalimantan tengah</option>
                <option value="Kalimantan Timur">Kalimantan timur</option>
                <option value="Kalimantan Utara">Kalimantan Utara</option>
                <option value="Kepulauan Riau">Kepulauan Riau</option>
                <option value="Lampung">Lampung</option>
                <option value="Maluku Utara">Maluku Utara</option>
                <option value="Maluku">Maluku</option>
                <option value="Riau">Riau</option>
                <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                <option value="Papua Barat">Papua Barat</option>
                <option value="Papua">Papua</option>
                <option value="Sumatera Barat">Sumatera Barat</option>
                <option value="Sulawesi Barat">Sulawesi Barat</option>
                <option value="Sulawesi Utara">Sulawesi Utara</option>
                <option value="Sumatera Selatan">Sumatera Selatan</option>
                <option value="Yogyakarta">Yogyakarta</option>
                <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                <option value="Papua Selatan">Papua Selatan</option>
                <!-- Tambahkan provinsi lainnya sesuai kebutuhan kasih sesuai urutannya sama yang di bawah -->
            </select>
        </div>
        <div>
            <label for="kabupaten" class="block text-gray-700">Kabupaten:</label>
            <select id="kabupaten" name="kabupaten" class="w-full border border-gray-300 p-2 rounded" required>
                <option value="">Pilih Kabupaten / Kota</option>
                <!-- Kabupaten akan diisi berdasarkan pilihan asal -->
            </select>
        </div>
        <div>
            <label for="deskripsi" class="block text-gray-700">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" class="w-full border border-gray-300 p-2 rounded" required></textarea>
        </div>
        <div>
            <label for="gambar" class="block text-gray-700">Gambar:</label>
            <input type="file" id="gambar" name="gambar" class="w-full border border-gray-300 p-2 rounded" required>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
        </div>
    </form>
</div>

<script>
    const kabupatenData = {
        "Jawa Barat": ["Bandung", "Bekasi", "Bogor", "Cirebon"],
        "Jawa Tengah": ["Semarang", "Surakarta", "Magelang", "Purwokerto"],
        "Jawa Timur": ["Surabaya", "Malang", "Kediri", "Madiun"],
        "Sulawesi Selatan": ["Makassar", "Toraja", "Maros", "Enrekang"],
        "Aceh": ["Banda Aceh", "Aceh Besar", "Aceh Jaya", "Aceh Selatan"],
        "Sulawesi Tenggara": ["Buton", "Muna", "Kolaka", "Kolaka Utara"],
        "Bali": ["Denpasar", "Badung", "Buleleng", "Kolaka Utara"],
        "Bangka Belitung": ["Bangka", "Badung", "Buleleng", "Kolaka Utara"],
        "Sumatera Utara": ["Bangka", "Badung", "Buleleng", "Kolaka Utara"],
        "Bengkulu": ["Bengkulu", "Badung", "Buleleng", "Kolaka Utara"],
        "DKI Jakarta": ["Jakarta", "Badung", "Buleleng", "Kolaka Utara"],
        "Gorontalo": ["Gorontalo", "Badung", "Buleleng", "Kolaka Utara"],
        "Jambi": ["Jambi", "Badung", "Buleleng", "Kolaka Utara"],
        "Kalimantan Barat": ["Pontianak", "Badung", "Buleleng", "Kolaka Utara"],
        "Kalimantan Selatan": ["Banjarmasin", "Badung", "Buleleng", "Kolaka Utara"],
        "Kalimantan Tengah": ["Palangkarya", "Badung", "Buleleng", "Kolaka Utara"],
        "Kalimantan Timur": ["Samarinda", "Badung", "Buleleng", "Kolaka Utara"],
        "Kalimantan Utara": ["Tarakan", "Badung", "Buleleng", "Kolaka Utara"],
        "Kepulauan Riau": ["Riau", "Badung", "Buleleng", "Kolaka Utara"],
        "Lampung": ["Lampung", "Badung", "Buleleng", "Kolaka Utara"],
        "Maluku Utara": ["Ternate", "Badung", "Buleleng", "Kolaka Utara"],
        "Maluku": ["Ambon", "Badung", "Buleleng", "Kolaka Utara"],
        "Riau": ["Riau", "Badung", "Buleleng", "Kolaka Utara"],
        "Nusa Tenggara Barat": ["Mataram", "Bima", "Buleleng", "Kolaka Utara"],
        "Nusa Tenggara Timur": ["Kupang", "Bima", "Buleleng", "Kolaka Utara"],
        "Papua Barat": ["Manokwari", "Fakfak", "Buleleng", "Kolaka Utara"],
        "Papua Barat": ["Manokwari", "Fakfak", "Buleleng", "Kolaka Utara"],
        "Papua": ["Papua", "Fakfak", "Buleleng", "Kolaka Utara"],
        "Sumatera Barat": ["Padang", "Payakumbuah", "Buleleng", "Kolaka Utara"],
        "Sulawesi Barat": ["Majene", "Mamuju", "Pasangkayu", "Polewali Mandar"],
        "Sulawesi Utara": ["Minahasa", "Kotamobagu", "Bitung", "Manado"],
        "Sumatera Selatan": ["Palembang", "Kotamobagu", "Bitung", "Manado"],
        "Yogyakarta": ["Yogyakarta", "Kulonprogo", "Gunung Kidul", "Manado"],
        "Sulawesi Tengah": ["Banggai", "Kulonprogo", "Gunung Kidul", "Manado"],
        "Papua Selatan": ["Merauke", "Kulonprogo", "Gunung Kidul", "Manado"],


        // Tambahkan kabupaten lainnya sesuai kebutuhan ikuti saja di atas ini salin
    };

    const asalSelect = document.getElementById('asal');
    const kabupatenSelect = document.getElementById('kabupaten');

    asalSelect.addEventListener('change', function () {
        const selectedAsal = this.value;
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten / Kota</option>'; // Reset kabupaten options

        if (kabupatenData[selectedAsal]) {
            kabupatenData[selectedAsal].forEach(function (kabupaten) {
                const option = document.createElement('option');
                option.value = kabupaten;
                option.textContent = kabupaten;
                kabupatenSelect.appendChild(option);
            });
        }
    });
</script>

<?php include '../includes/footer.php'; ?>
