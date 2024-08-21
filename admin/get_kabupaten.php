<?php
include '../config.php';

$asal = $_GET['asal'];
$kabupatenStmt = $pdo->prepare('SELECT DISTINCT kabupaten FROM baju_adat WHERE asal = ? ORDER BY kabupaten ASC');
$kabupatenStmt->execute([$asal]);
$kabupatenList = $kabupatenStmt->fetchAll(PDO::FETCH_COLUMN);

echo json_encode($kabupatenList);

?>
