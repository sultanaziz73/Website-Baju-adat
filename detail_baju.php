<?php
include 'config.php';

// Mengambil ID dari URL dan validasi
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    // Jika ID tidak valid, arahkan kembali ke halaman utama atau tampilkan pesan error
    header("Location: index.php");
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM baju_adat WHERE id = ?');
$stmt->execute([$id]);
$baju = $stmt->fetch();

// Pastikan bahwa query mendapatkan hasil
if (!$baju) {
    // Jika tidak ada hasil, bisa diarahkan kembali atau tampilkan pesan error
    header("Location: index.php");
    exit();
}

// Get other baju adat to display below
$stmt_other = $pdo->prepare('SELECT * FROM baju_adat WHERE id != ? ORDER BY RAND() LIMIT 3');
$stmt_other->execute([$id]);
$otherBajuAdat = $stmt_other->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Baju Adat - <?= htmlspecialchars($baju['nama']) ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary text-white">

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images/logo.png" alt="Logo" class="d-none d-lg-block" style="height: 50px;">
                <span class="h2 font-weight-bold mb-0 d-none d-lg-block">SISTEM INFORMASI BAJU ADAT</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Detail Baju Adat Section -->
    <div class="container py-5">
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="uploads/<?= htmlspecialchars($baju['gambar']) ?>" alt="<?= htmlspecialchars($baju['nama']) ?>" class="img-fluid rounded mb-4">
            </div>
            <div class="col-md-6">
                <h1 class="display-4"><?= htmlspecialchars($baju['nama']) ?></h1>
                <p class="lead"><?= htmlspecialchars($baju['asal']) ?>, <?= htmlspecialchars($baju['kabupaten']) ?></p> <!-- Menampilkan asal dan kabupaten -->
                <p><?= htmlspecialchars($baju['deskripsi']) ?></p>
                <a href="index.php" class="btn btn-light mt-4">Kembali ke Halaman Utama</a>
            </div>
        </div>

        <!-- Other Baju Adat Section -->
        <h3 class="text-center mb-4">Lihat Baju Adat Lainnya</h3>
        <div class="row">
            <?php foreach ($otherBajuAdat as $otherBaju): ?>
                <div class="col-md-4 mb-4">
                    <a href="detail_baju.php?id=<?= $otherBaju['id'] ?>" class="text-decoration-none text-white">
                        <div class="card bg-primary text-white h-100 border-0 shadow">
                            <img src="uploads/<?= htmlspecialchars($otherBaju['gambar']) ?>" alt="<?= htmlspecialchars($otherBaju['nama']) ?>" class="card-img-top img-fluid rounded-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h3 class="h5 card-title font-weight-bold"><?= htmlspecialchars($otherBaju['nama']) ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
