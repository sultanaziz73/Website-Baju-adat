<?php
include 'config.php';

// Ambil parameter pencarian dan filter asal jika ada
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$filterAsal = isset($_GET['asal']) ? $_GET['asal'] : '';
$filterKabupaten = isset($_GET['kabupaten']) ? $_GET['kabupaten'] : '';

// Buat query untuk mengambil data asal yang unik
$asalStmt = $pdo->query("SELECT DISTINCT asal FROM baju_adat ORDER BY asal ASC");
$asalList = $asalStmt->fetchAll();

// Buat query untuk mengambil data kabupaten berdasarkan filter asal
$kabupatenStmt = null;
$kabupatenList = [];
if ($filterAsal) {
    $kabupatenStmt = $pdo->prepare("SELECT DISTINCT kabupaten FROM baju_adat WHERE asal = ? ORDER BY kabupaten ASC");
    $kabupatenStmt->execute([$filterAsal]);
    $kabupatenList = $kabupatenStmt->fetchAll();
}

// Buat query untuk mengambil data baju adat berdasarkan pencarian dan filter asal/kabupaten
$query = "SELECT * FROM baju_adat WHERE (nama LIKE ? OR asal LIKE ? OR kabupaten LIKE ?)";
$params = ['%' . $searchQuery . '%', '%' . $searchQuery . '%', '%' . $searchQuery . '%'];

if ($filterAsal) {
    $query .= " AND asal = ?";
    $params[] = $filterAsal;
}

if ($filterKabupaten) {
    $query .= " AND kabupaten = ?";
    $params[] = $filterKabupaten;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$bajuAdatList = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Search Baju Adat</title>
</head>
<body class="bg-primary text-white">

    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="images/logo.png" alt="Logo" class="d-none d-lg-block" style="height: 50px;">
                <span class="h2 font-weight-bold mb-0 d-none d-lg-block">SISTEM INFORMASI BAJU ADAT</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" href="#">
                            <img src="images/logo.png" alt="Logo" style="height: 50px;" class="mr-3">
                            SISTEM INFORMASI BAJU ADAT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Search Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="h3 font-weight-bold mb-3">Cari Baju Adat</h2>
            <form action="search.php" method="get" class="form-inline justify-content-center">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari Baju Adat" value="<?= htmlspecialchars($searchQuery) ?>">
                <select id="asal" name="asal" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="">-- Pilih Asal --</option>
                    <?php foreach ($asalList as $asal): ?>
                        <option value="<?= htmlspecialchars($asal['asal']) ?>" <?= $filterAsal == $asal['asal'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($asal['asal']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if ($filterAsal): ?>
                <select id="kabupaten" name="kabupaten" class="form-control mr-2">
                    <option value="">-- Pilih Kabupaten / Kota --</option>
                    <?php foreach ($kabupatenList as $kabupaten): ?>
                        <option value="<?= htmlspecialchars($kabupaten['kabupaten']) ?>" <?= $filterKabupaten == $kabupaten['kabupaten'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kabupaten['kabupaten']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
                <button type="submit" class="btn btn-light text-primary">Cari</button>
            </form>
        </div>

        <!-- Baju Adat List Section -->
        <div class="row">
            <?php foreach ($bajuAdatList as $baju): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="detail_baju.php?id=<?= $baju['id'] ?>">
                        <div class="card bg-primary text-white h-100 border-0 shadow">
                            <img src="<?= htmlspecialchars('uploads/' . basename($baju['gambar'])) ?>" alt="<?= htmlspecialchars($baju['nama']) ?>" class="card-img-top img-fluid rounded-top" style="height: 300px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h3 class="h5 card-title font-weight-bold"><?= htmlspecialchars($baju['nama']) ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-primary text-white py-4">
        <div class="container text-center">
            <p class="mb-2">&copy; 2024 Sistem Informasi Baju Adat</p>
            <p>Hubungi Kami: <a href="mailto:info@example.com" class="text-white text-decoration-underline">info@example.com</a></p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
