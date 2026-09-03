<?php
    require_once('../utils/auth_helper.php');
    require_admin();
    $page_title = 'Customers';
    include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Manage Customers</div>

<?php if (isset($_SESSION['customer_success'])): ?>
    <div class="success-msg"><?php echo htmlspecialchars($_SESSION['customer_success']); unset($_SESSION['customer_success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['customer_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['customer_error']); unset($_SESSION['customer_error']); ?></div>
<?php endif; ?>

<div class="card">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer): ?>
                <tr>
                    <td><?php echo $customer['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($customer['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['user_email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['user_phone']); ?></td>
                    <td><?php echo htmlspecialchars($customer['user_address']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=admin_dashboard" class="back-link">&larr; Back to Dashboard</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
