<?php
require_once(__DIR__ . '/../../../utils/auth_helper.php');
require_admin();
$page_title = 'Delivery Men';
include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Delivery Men</div>

<?php if (isset($_SESSION['delivery_success'])): ?>
    <div class="success-msg"><?php echo htmlspecialchars($_SESSION['delivery_success']); unset($_SESSION['delivery_success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['delivery_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['delivery_error']); unset($_SESSION['delivery_error']); ?></div>
<?php endif; ?>

<div class="card">
    <?php if (empty($delivery_men)): ?>
        <p class="muted">No delivery men yet. Add one so they can log in and see current orders.</p>
    <?php else: ?>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($delivery_men as $man): ?>
                    <tr>
                        <td><?php echo $man['user_id']; ?></td>
                        <td><?php echo htmlspecialchars($man['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($man['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($man['user_phone']); ?></td>
                        <td><?php echo htmlspecialchars($man['user_address']); ?></td>
                        <td>
                            <a href="<?php echo BASE_URL; ?>?action=delete_delivery_man&id=<?php echo $man['user_id']; ?>" class="btn-danger" onclick="return confirm('Remove this delivery man?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=create_delivery_man" class="btn">Add Delivery Man</a>
    <a href="<?php echo BASE_URL; ?>?action=admin_dashboard" class="back-link">&larr; Back to Dashboard</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
