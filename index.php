<?php
require_once __DIR__ . '/../helper/connection.php';
require_once __DIR__ . '/../helper/auth_owner.php';
require_once __DIR__ . '/../layout/sidenav.php';

$result = mysqli_query($conn, "SELECT * FROM tbuser ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk | BeeBoo Milkshake</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="../assets/images/logo.png" alt="BeeBoo Logo">
            <h5>BeeBoo Milkshake</h5>
        </div>
       <ul class="nav-list">
        <li><a href="/web/final_project/dashboard/index.php" class="nav-link"><i class="bi bi-house-door"></i> Dashboard</a></li>
        <li><a href="/web/final_project/produk/index.php" class="nav-link"><i class="bi bi-cup-straw"></i> Produk</a></li>
        <li><a href="/web/final_project/transaksi/index.php" class="nav-link"><i class="bi bi-clipboard-check"></i> Transaksi</a></li>
        <li><a href="/web/final_project/user/index.php" class="nav-link active"><i class="bi bi-people"></i> User</a></li>
        </ul>
        <a href="/web/final_project/logout.php" class="logout-link"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Data Pengguna</h2>
            <a href="create.php" class="btn btn-primary"><i class="bi bi-plus"></i> Tambah User</a>
        </div>

        <div class="card shadow rounded-4">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><span class="badge bg-<?= $row['role'] === 'owner' ? 'primary' : 'secondary' ?>"><?= ucfirst($row['role']) ?></span></td>
                                <td>
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php if (mysqli_num_rows($result) === 0): ?>
                            <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>
