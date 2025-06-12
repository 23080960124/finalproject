<?php
require_once '../helper/auth_owner.php';
require_once '../helper/connection.php';

$id = $_GET['id'] ?? 0;
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tbuser WHERE id = $id"));
if (!$user) {
    die('User tidak ditemukan.');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $role = $_POST['role'];

    $query = "UPDATE tbuser SET nama='$nama', username='$username', role='$role' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
        exit;
    } else {
        $error = 'Gagal mengubah user.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm rounded-4 p-4">
        <h4 class="mb-3">Edit User</h4>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= htmlspecialchars($user['nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="owner" <?= $user['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
                    <option value="karyawan" <?= $user['role'] == 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Update</button>
        </form>
    </div>
</div>
</body>
</html>
