<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../../config/db_config.php');
require_once(__DIR__ . '/../../utils/auth_helper.php');
require_admin();

$page_title = 'Admin Dashboard';
include_once __DIR__ . '/../layouts/header.php';
?>

<div class="page-title">Admin Dashboard</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Products</div>
        <div class="stat-value"><?php echo $total_products; ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Shop Sellers</div>
        <div class="stat-value"><?php echo $total_sellers; ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Customers</div>
        <div class="stat-value"><?php echo $total_customers; ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Orders</div>
        <div class="stat-value"><?php echo $total_orders; ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Pending Orders</div>
        <div class="stat-value"><?php echo $pending_orders; ?></div>
    </div>
</div>

<div class="section-title">Manage</div>
<div class="menu-grid">
    <a href="<?php echo BASE_URL; ?>?action=product_list" class="menu-card">Manage Products</a>
    <a href="<?php echo BASE_URL; ?>?action=create_product" class="menu-card">Add New Product</a>
    <a href="<?php echo BASE_URL; ?>?action=seller_users" class="menu-card">Manage Sellers</a>
    <?php if (is_admin()): ?>
    <a href="<?php echo BASE_URL; ?>?action=customer_list" class="menu-card">Manage Customers</a>
    <?php endif; ?>
    <a href="<?php echo BASE_URL; ?>?action=order_list" class="menu-card">View Orders</a>
    <a href="<?php echo BASE_URL; ?>?action=purchase_history" class="menu-card">Purchase History</a>
    <a href="<?php echo BASE_URL; ?>?action=delivery_men" class="menu-card">Manage Delivery Men</a>
    <a href="<?php echo BASE_URL; ?>?action=home" class="menu-card">Back to Home</a>
</div>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
