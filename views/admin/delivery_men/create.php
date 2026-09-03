<?php
require_once(__DIR__ . '/../../../utils/auth_helper.php');
require_admin();
$page_title = 'Add Delivery Man';
include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Add Delivery Man</div>

<?php if (isset($_SESSION['delivery_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['delivery_error']); unset($_SESSION['delivery_error']); ?></div>
<?php endif; ?>

<div class="card" style="max-width: 640px;">
    <form method="POST" action="<?php echo BASE_URL; ?>?action=create_delivery_man_submit">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address">
        </div>
        <button type="submit" class="btn-submit">Add Delivery Man</button>
    </form>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=delivery_men" class="back-link">&larr; Back to Delivery Men</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
