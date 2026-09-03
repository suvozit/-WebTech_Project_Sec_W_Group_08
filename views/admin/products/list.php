<?php
    require_once('../utils/auth_helper.php');
    require_admin();
    $page_title = 'Products';
    include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Manage Products</div>

<?php if (isset($_SESSION['product_success'])): ?>
    <div class="success-msg"><?php echo htmlspecialchars($_SESSION['product_success']); unset($_SESSION['product_success']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['product_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['product_error']); unset($_SESSION['product_error']); ?></div>
<?php endif; ?>

<div class="card">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Gender</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                    <td>৳<?php echo number_format($product['product_price'], 0); ?></td>
                    <td><?php echo htmlspecialchars($product['product_stock']); ?></td>
                    <td><?php echo htmlspecialchars($product['product_gender']); ?></td>
                    <td>
                        <a href="<?php echo BASE_URL; ?>?action=edit_product&id=<?php echo $product['product_id']; ?>" class="btn-view">Edit</a>
                        <a href="<?php echo BASE_URL; ?>?action=delete_product&id=<?php echo $product['product_id']; ?>" class="btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=create_product" class="btn">Add New Product</a>
    <a href="<?php echo BASE_URL; ?>?action=admin_dashboard" class="back-link">&larr; Back to Dashboard</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
