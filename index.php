<?php
include 'config.php';
$stmt = $pdo->query('SELECT * FROM baju_adat ORDER BY RAND() LIMIT 3');
$featuredBajuAdat = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d9247fd719.js" crossorigin="anonymous"></script>
    <title>Sistem Informasi Baju Adat</title>
</head>

<style>
    #border {
        max-width: 450px;
    }
</style>
<body class="bg-primary text-white">

    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="images/logo.png" alt="Logo" class="d-none d-lg-block" style="height: 50px;">
                <span class="h2 font-weight-bold mb-0 d-none d-lg-block">SISTEM INFORMASI BAJU ADAT INDONESIA</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item d-lg-none">
                        <a class="nav-link" href="#">
                            <img src="images/logo.png" alt="Logo" class="h-12 mr-3">
                            SISTEM INFORMASI BAJU ADAT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="berita.php">Berita</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 font-weight-bold text-center text-lg-left">Selamat Datang di Sistem Informasi Baju Adat Indonesia</h1>
                <div class="text-center text-lg-left">
                <a href="search.php" class="btn btn-light text-primary mt-3">Cari Baju Adat</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                    <img  id="border" src="images/sulawesiselatan.png" alt="baju" class="img-fluid rounded" >
            </div>
        </div>
    </div>

    <!-- Baju Adat List Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="h3 font-weight-bold mb-3">Tentang Jenis Baju Adat</h2>
            <p>Jelajahi kekayaan budaya Indonesia melalui ragam jenis pakaian adat yang unik di setiap provinsi. Mulai dari kebaya hingga baju bodo, ada begitu banyak yang bisa Anda pelajari dan nikmati!</p>
        </div>

         <!-- Additional Sections -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="h3 font-weight-bold mb-3">Eksplorasi Jenis Baju Adat</h2>
            <p>Kami menyajikan ragam jenis pakaian adat dari setiap provinsi di Indonesia, lengkap dengan sejarah dan maknanya. Temukan keindahan dan keunikan dalam setiap helai kain dan corak yang mengagumkan!</p>
        </div>

        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <i class="fas fa-tshirt fa-3x mb-3"></i>
                <h3 class="h5 font-weight-bold">Jenis Pakaian Tradisional</h3>
                <p>Dari Bali hingga Sumatera, kita akan membahas beragam jenis pakaian adat yang memikat hati Anda.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fa-solid fa-file-lines fa-3x mb-3"></i>
                <h3 class="h5 font-weight-bold">Sejarah dan Makna</h3>
                <p>Kisah di balik setiap potongan kain dan detail pada pakaian adat akan membuat Anda terpesona.</p>
            </div>
            <div class="col-md-4 mb-4">
                <i class="fas fa-images fa-3x mb-3"></i>
                <h3 class="h5 font-weight-bold">Eksplorasi Budaya</h3>
                <p>Jelajahi keindahan budaya dan tradisi Indonesia melalui pakaian adat yang memukau.</p>
            </div>
        </div>
    </div>

         <!-- Baju Adat List Section -->
    <div class="container py-5">
        <h2 class="h3 font-weight-bold text-center mb-5">Pakaian Adat dari Seluruh Nusantara</h2>
        <p class="text-center mb-5">Lihatlah beberapa contoh pakaian adat yang menakjubkan dari provinsi-provinsi di Indonesia.</p>
        <div class="row">
            <?php foreach ($featuredBajuAdat as $baju): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="detail_baju.php?id=<?= $baju['id'] ?>" class="text-decoration-none text-white">
                        <div class="card bg-primary text-white h-100 border-0 shadow">
                            <img src="uploads/<?= htmlspecialchars($baju['gambar']) ?>" alt="<?= htmlspecialchars($baju['nama']) ?>" class="card-img-top img-fluid rounded-top" style="height: 300px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h3 class="h5 card-title font-weight-bold"><?= htmlspecialchars($baju['nama']) ?></h3>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    </div>

    <!-- Contact Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="h3 font-weight-bold mb-3">Hubungi Kami</h2>
            <p>Jika Anda memiliki pertanyaan atau ingin berbagi informasi, jangan ragu untuk menghubungi kami.</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="bg-primary text-white p-4 rounded mb-4">
                    <h3 class="h5 font-weight-bold">Informasi Kontak</h3>
                    <p>Email: <a href="mailto:fiqramadhan53@gmail.com" class="text-white">fiqramadhan53@gmail.com</a></p>
                    <p>Telepon: 082296025819</p>
                    <p>Alamat: Jl. Delima Blok A1 No.8 Perumahan Paccerakkang. Kota Makassar, Biring Kanaya, Sulawesi Selatan</p>
                </div>
            </div>
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="email" class="text-white">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="firstName" class="text-white">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="text-white">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="message" class="text-white">Message</label>
                        <textarea class="form-control" id="message" rows="3" placeholder="Enter Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-light text-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-primary text-white py-4">
        <div class="container text-center">
            <p class="mb-2">&copy; 2024 Sistem Informasi Baju Adat</p>
            <p>Hubungi Kami: <a href="fiqramadhan53@gmail.com" class="text-white text-decoration-underline">fiqramadhan53@gmail.com</a></p>
        </div>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
