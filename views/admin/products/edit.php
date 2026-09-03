<?php
    require_once('../utils/auth_helper.php');
    require_admin();
    $page_title = 'Edit Product';
    include_once __DIR__ . '/../../layouts/header.php';
?>

<div class="page-title">Edit Product</div>

<?php if (isset($_SESSION['product_error'])): ?>
    <div class="error-msg"><?php echo htmlspecialchars($_SESSION['product_error']); unset($_SESSION['product_error']); ?></div>
<?php endif; ?>

<div class="card" style="max-width: 640px;">
    <form method="POST" action="<?php echo BASE_URL; ?>?action=edit_product_submit" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3"><?php echo htmlspecialchars($product['product_description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="size_chart">Size Chart</label>
            <textarea id="size_chart" name="size_chart" rows="2"><?php echo htmlspecialchars($product['product_size_chart']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['product_price']); ?>" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category ID</label>
            <input type="number" id="category_id" name="category_id" value="<?php echo htmlspecialchars($product['product_category_id']); ?>" required>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['product_stock']); ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="Men" <?php if($product['product_gender'] == 'Men') echo 'selected'; ?>>Men</option>
                <option value="Women" <?php if($product['product_gender'] == 'Women') echo 'selected'; ?>>Women</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" id="image" name="image">
            <?php if ($product['product_image_path']): ?>
                <p class="muted" style="margin-top: 8px;">Current: <?php echo htmlspecialchars($product['product_image_path']); ?></p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn-submit">Update Product</button>
    </form>
</div>

<div class="cart-actions">
    <a href="<?php echo BASE_URL; ?>?action=product_list" class="back-link">&larr; Back to Product List</a>
</div>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
