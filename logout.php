<?php
session_start();
session_unset();            // hapus semua variabel session
session_destroy();          // hancurkan sesi

// Hapus cookie session jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect ke login
header("Location: ../final_project/");
exit;
?>

