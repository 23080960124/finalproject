<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: dashboard/index.php");
    exit;
}
require_once __DIR__.'/helper/connection.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(mysqli_real_escape_string($conn, $_POST['username']));
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM tbuser WHERE username='$username' LIMIT 1");
    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        // Langsung bandingkan (plain text)
        if ($password === $user['password']) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            header('Location: dashboard/index.php');
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | BeeBoo Milkshake</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .login-box { max-width: 400px; margin: 80px auto; }
    </style>
</head>
<body class="login-page">
    <div class="login-box card shadow-sm p-4">
        <div class="text-center mb-4">
            <img src="assets/images/logo.png" alt="logo" style="width:60px">
            <h4 class="mt-2 mb-1">BeeBoo Milkshake</h4>
            <div class="text-muted mb-3">Silakan login untuk masuk</div>
        </div>
        <?php if ($error): ?>
            <div class="alert alert-danger py-2"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input required type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
            </div>
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input required type="password" id="password" name="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>