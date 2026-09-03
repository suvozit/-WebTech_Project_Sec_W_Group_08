<?php
    require_once('../utils/auth_helper.php');
    require_admin();
    $page_title = 'Add Product';
    include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Add New Product</div>

<?php if (isset($_SESSION['product_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['product_error']); unset($_SESSION['product_error']); ?></div>
<?php endif; ?>

<div class="card" style="max-width: 640px;">
    <form method="POST" action="<?php echo BASE_URL; ?>?action=create_product_submit" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="size_chart">Size Chart</label>
            <textarea id="size_chart" name="size_chart" rows="2" placeholder="S, M, L, XL"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category ID</label>
            <input type="number" id="category_id" name="category_id" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn-submit">Add Product</button>
    </form>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=product_list" class="back-link">&larr; Back to Product List</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
