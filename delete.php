<?php
require_once __DIR__ . '/../helper/connection.php';
require_once __DIR__ . '/../helper/auth_owner.php';

if (!isset($_GET['id'])) die('ID tidak ditemukan!');
$id = (int)$_GET['id'];

mysqli_query($conn, "DELETE FROM tbuser WHERE id = $id");
header('Location: index.php');
exit;
