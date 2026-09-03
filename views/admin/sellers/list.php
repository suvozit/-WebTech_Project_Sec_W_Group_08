<?php
require_once(__DIR__ . '/../../../utils/auth_helper.php');
require_admin();
$page_title = 'Manage Sellers';
include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Shop Sellers</div>
<p class="muted" style="margin-top: -16px; margin-bottom: 26px;">
    Only Admin can add and manage seller accounts for the shop.
</p>

<?php if (isset($_SESSION['seller_success'])): ?>
    <div class="success-msg"><?php echo htmlspecialchars($_SESSION['seller_success']); unset($_SESSION['seller_success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['seller_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['seller_error']); unset($_SESSION['seller_error']); ?></div>
<?php endif; ?>

<div class="card">
    <?php if (empty($sellers)): ?>
        <p class="muted">No seller accounts registered yet. Click "Add New Seller" below to create one.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sellers as $seller): ?>
                    <tr>
                        <td><strong>#<?php echo $seller['user_id']; ?></strong></td>
                        <td><strong><?php echo htmlspecialchars($seller['user_name']); ?></strong></td>
                        <td><?php echo htmlspecialchars($seller['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($seller['user_phone'] ?? '&mdash;'); ?></td>
                        <td><?php echo htmlspecialchars($seller['user_address'] ?? '&mdash;'); ?></td>
                        <td><?php echo htmlspecialchars($seller['user_created_at'] ?? '&mdash;'); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>?action=delete_seller&id=<?php echo $seller['user_id']; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to remove this seller account?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div class="cart-actions" style="margin-top: 24px; display: flex; justify-content: space-between; align-items: center;">
    <a href="<?php echo BASE_URL; ?>?action=create_seller" class="btn">Add New Seller</a>
    <a href="<?php echo BASE_URL; ?>?action=admin_dashboard" class="back-link">&larr; Back to Dashboard</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
