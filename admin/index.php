<?php
include '../config.php';
include '../includes/header.php';

$stmt = $pdo->query('SELECT * FROM baju_adat');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Admin - Daftar Baju Adat</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center my-5">Admin - Daftar Baju Adat</h2>
    <div class="text-right mb-4">
        <a href="tambah.php" class="btn btn-primary">Tambah Baju Adat</a>
    </div>
    <div class="row">
        <?php while ($row = $stmt->fetch()): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?= htmlspecialchars('../uploads/' . basename($row['gambar'])) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($row['asal']) ?></h6>
                        <p class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($row['kabupaten']) ?></p> <!-- Tambahkan baris ini untuk menampilkan kabupaten -->
                        <p class="card-text"><?= htmlspecialchars($row['deskripsi']) ?></p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?');">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php include '../includes/footer.php'; ?>
</body>
</html>
