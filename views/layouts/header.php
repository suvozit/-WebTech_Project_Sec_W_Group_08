<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../../config/db_config.php');
require_once(__DIR__ . '/../../models/cart.php');

$cart_count = (isset($_SESSION['user_id']) && ($_SESSION['user_role'] ?? '') === 'customer')
    ? (int) get_cart_count($_SESSION['user_id'])
    : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) . ' - Smart Clothing Store' : 'Smart Clothing Store'; ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Jost:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css?v=<?php echo @filemtime(__DIR__ . '/../../public/css/style.css'); ?>">
</head>
<body>

<nav class="navbar">
    <a href="<?php echo BASE_URL; ?>?action=home" class="logo">Smart Clothing</a>
    <div class="nav-links">
        <a href="<?php echo BASE_URL; ?>?action=home">Home</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="<?php echo BASE_URL; ?>?action=admin_dashboard">Dashboard</a>
                <a href="<?php echo BASE_URL; ?>?action=product_list">Products</a>
                <a href="<?php echo BASE_URL; ?>?action=seller_users">Sellers</a>
                <a href="<?php echo BASE_URL; ?>?action=customer_list">Customers</a>
                <a href="<?php echo BASE_URL; ?>?action=order_list">Orders</a>
                <a href="<?php echo BASE_URL; ?>?action=delivery_men">Delivery Men</a>
            <?php elseif ($_SESSION['user_role'] === 'seller'): ?>
                <a href="<?php echo BASE_URL; ?>?action=seller_dashboard">Dashboard</a>
                <a href="<?php echo BASE_URL; ?>?action=seller_products">Products</a>
                <a href="<?php echo BASE_URL; ?>?action=seller_orders">Orders</a>
                <a href="<?php echo BASE_URL; ?>?action=seller_sales">Sales</a>
                <a href="<?php echo BASE_URL; ?>?action=seller_discounts">Discounts</a>
            <?php elseif ($_SESSION['user_role'] === 'delivery_man'): ?>
                <a href="<?php echo BASE_URL; ?>?action=delivery_dashboard">Dashboard</a>
            <?php else: ?>
                <a href="<?php echo BASE_URL; ?>?action=my_orders">My Orders</a>
                <a href="<?php echo BASE_URL; ?>?action=cart" class="nav-icon" aria-label="Cart" title="Cart">
                    <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <span class="cart-badge" id="cartCount"<?php echo $cart_count > 0 ? '' : ' style="display:none"'; ?>><?php echo $cart_count; ?></span>
                </a>
                <a href="<?php echo BASE_URL; ?>?action=profile" class="nav-icon" aria-label="Profile" title="Profile">
                    <svg viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            <?php endif; ?>
            <span class="welcome">Hi, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong></span>
            <a href="<?php echo BASE_URL; ?>?action=logout" class="btn-logout">Logout</a>
        <?php else: ?>
            <a href="<?php echo BASE_URL; ?>?action=login" class="btn-auth">Login</a>
            <a href="<?php echo BASE_URL; ?>?action=register">Register</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
