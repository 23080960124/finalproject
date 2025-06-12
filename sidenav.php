<nav class="sidebar bg-white border-end shadow-sm">
    <div class="sidebar-header text-center py-3">
        <img src="/final_project/assets/images/logo.png" alt="BeeBoo Logo" class="img-fluid rounded-circle mb-2" style="width: 70px;">
        <h5 class="mb-0">BeeBoo Milkshake</h5>
    </div>
    <ul class="nav flex-column my-3">
        <li class="nav-item">
            <a class="nav-link" href="/web/final_project/dashboard/index.php"><i class="bi bi-house"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/web/final_project/produk/index.php"><i class="bi bi-cup-straw"></i> Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/web/final_project/transaksi/index.php"><i class="bi bi-card-checklist"></i> Transaksi</a>
        </li>
        <?php if (function_exists('is_owner') && is_owner()): ?>
        <li class="nav-item">
            <a class="nav-link" href="/web/final_project/user/index.php"><i class="bi bi-people"></i> User</a>
        </li>
        <?php endif; ?>
        <li class="nav-item mt-3">
            <a class="nav-link text-danger" href="/web/final_project/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </li>
    </ul>
</nav>
