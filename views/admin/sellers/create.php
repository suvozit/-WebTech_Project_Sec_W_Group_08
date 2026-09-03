<?php
require_once(__DIR__ . '/../../../utils/auth_helper.php');
require_admin();
$page_title = 'Add Seller';
include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Add New Seller</div>
<p class="muted" style="margin-top: -16px; margin-bottom: 26px;">
    Register a seller user to add and manage their own products and orders in the shop.
</p>

<?php if (isset($_SESSION['seller_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['seller_error']); unset($_SESSION['seller_error']); ?></div>
<?php endif; ?>

<div class="card" style="max-width: 640px;">
    <form method="POST" action="<?php echo BASE_URL; ?>?action=create_seller_submit">
        <div class="form-group">
            <label for="full_name">Seller Name / Shop Representative</label>
            <input type="text" id="full_name" name="full_name" placeholder="e.g. Apex Official Seller" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="e.g. seller@clothing.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create temporary login password" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="e.g. 01700000000">
        </div>
        <div class="form-group">
            <label for="address">Pickup Address / Store Location</label>
            <input type="text" id="address" name="address" placeholder="e.g. House 12, Road 4, Banani, Dhaka">
        </div>
        <button type="submit" class="btn-submit">Create Seller Account</button>
    </form>
</div>

<div class="cart-actions" style="margin-top: 24px;">
    <a href="<?php echo BASE_URL; ?>?action=seller_users" class="back-link">&larr; Back to Sellers</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
