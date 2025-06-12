<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'owner') {
    header('Location: ../login.php');
    exit;
}
?>