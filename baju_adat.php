<?php
include 'config.php';
include 'includes/header.php';

$stmt = $pdo->query('SELECT * FROM baju_adat');
?>

<h2 class="text-3xl font-bold text-center mb-8">Daftar Baju Adat</h2>
<div class="container mx-auto px-4">
    <div class="space-y-8">
        <?php while ($row = $stmt->fetch()): ?>
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                <img src="<?= htmlspecialchars('/uploads/' . basename($row['gambar'])) ?>" alt="<?= htmlspecialchars($row['nama']) ?>" class="w-full md:w-1/3 h-48 object-cover rounded-lg shadow-md">
                <div class="flex-1">
                    <h3 class="text-2xl font-semibold mb-2"><?= htmlspecialchars($row['nama']) ?></h3>
                    <p class="text-gray-500 mb-4"><?= htmlspecialchars($row['asal']) ?></p>
                    <p class="text-gray-700"><?= htmlspecialchars($row['deskripsi']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
