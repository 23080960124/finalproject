<?php
session_start();
require_once __DIR__ . '/../helper/connection.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan.");
}
$id_transaksi = (int)$_GET['id'];

$transaksi_result = mysqli_query($conn, "
    SELECT t.*, u.username AS nama_karyawan 
    FROM tbtransaksi t
    JOIN tbuser u ON t.id_karyawan = u.id
    WHERE t.id = $id_transaksi
");

if (!$transaksi_result || mysqli_num_rows($transaksi_result) === 0) {
    die("Transaksi tidak ditemukan.");
}
$transaksi = mysqli_fetch_assoc($transaksi_result);

$detail_result = mysqli_query($conn, "
    SELECT d.*, p.nama_produk AS nama_produk
    FROM tbdetail_transaksi d
    JOIN tbproduk p ON d.id_produk = p.id
    WHERE d.id_transaksi = $id_transaksi
");

if (!$detail_result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container py-4">
    <h2 class="mb-4">Detail Transaksi</h2>

    <div class="mb-3">
        <strong>ID Transaksi:</strong> <?= $transaksi['id'] ?><br>
        <strong>Nama Karyawan:</strong> <?= htmlspecialchars($transaksi['nama_karyawan']) ?><br>
        <strong>Tanggal:</strong> <span class="tanggal"><?= $transaksi['tanggal'] ?></span><br>
        <strong>Total:</strong> <span class="rupiah"><?= $transaksi['total'] ?></span>
    </div>

    <h5>Produk yang Dibeli:</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($detail_result)) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td class="rupiah"><?= $row['subtotal'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Kembali</a>

    <script>
    document.querySelectorAll('.tanggal').forEach(el => {
        const date = new Date(el.textContent.trim());
        el.textContent = date.toLocaleString('id-ID', {
            day: '2-digit', month: 'long', year: 'numeric',
            hour: '2-digit', minute: '2-digit'
        });
    });
    document.querySelectorAll('.rupiah').forEach(el => {
        const val = parseInt(el.textContent);
        el.textContent = new Intl.NumberFormat('id-ID', {
            style: 'currency', currency: 'IDR', minimumFractionDigits: 0
        }).format(val);
    });
    </script>
</body>
</html>
