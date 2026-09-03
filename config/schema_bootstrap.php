<?php
function schema_table_exists($con, $table) {
    $table = mysqli_real_escape_string($con, $table);
    $sql = "SHOW TABLES LIKE '$table'";
    $result = @mysqli_query($con, $sql);
    return $result && mysqli_num_rows($result) > 0;
}

function schema_column_exists($con, $table, $column) {
    if (!schema_table_exists($con, $table)) {
        return false;
    }
    $table  = mysqli_real_escape_string($con, $table);
    $column = mysqli_real_escape_string($con, $column);
    $sql    = "SHOW COLUMNS FROM `$table` LIKE '$column'";
    $result = @mysqli_query($con, $sql);
    return $result && mysqli_num_rows($result) > 0;
}

function ensure_seller_delivery_schema($con) {
    static $ready = false;
    if ($ready || !$con) {
        return;
    }
    $ready = true;

    try {
        if (schema_table_exists($con, 'users')) {
            $role_col = @mysqli_query($con, "SHOW COLUMNS FROM users LIKE 'user_role'");
            $role_info = $role_col ? mysqli_fetch_assoc($role_col) : null;
            if ($role_info && strpos($role_info['Type'], 'seller') === false) {
                @mysqli_query($con, "ALTER TABLE users MODIFY COLUMN user_role ENUM('admin', 'customer', 'seller', 'delivery_man') NOT NULL DEFAULT 'customer'");
            }
        }

        if (schema_table_exists($con, 'products') && !schema_column_exists($con, 'products', 'product_seller_id')) {
            @mysqli_query($con, 'ALTER TABLE products ADD COLUMN product_seller_id INT DEFAULT NULL');
        }

        if (schema_table_exists($con, 'orders')) {
            if (!schema_column_exists($con, 'orders', 'order_delivery_man_id')) {
                @mysqli_query($con, 'ALTER TABLE orders ADD COLUMN order_delivery_man_id INT DEFAULT NULL');
            }

            $status_col = @mysqli_query($con, "SHOW COLUMNS FROM orders LIKE 'order_status'");
            $status_info = $status_col ? mysqli_fetch_assoc($status_col) : null;
            if ($status_info && strpos($status_info['Type'], 'assigned') === false) {
                @mysqli_query($con, "ALTER TABLE orders MODIFY COLUMN order_status ENUM('pending', 'confirmed', 'assigned', 'out_for_delivery', 'delivered', 'rejected') NOT NULL DEFAULT 'pending'");
            }
        }

        if (schema_table_exists($con, 'order_items') && !schema_column_exists($con, 'order_items', 'order_item_discount_amount')) {
            @mysqli_query($con, 'ALTER TABLE order_items ADD COLUMN order_item_discount_amount DECIMAL(10, 2) DEFAULT 0.00');
        }

        @mysqli_query($con, "CREATE TABLE IF NOT EXISTS discounts (
            discount_id INT AUTO_INCREMENT PRIMARY KEY,
            discount_name VARCHAR(100) NOT NULL,
            discount_type ENUM('percentage', 'fixed') NOT NULL DEFAULT 'percentage',
            discount_value DECIMAL(10, 2) NOT NULL,
            target_type ENUM('product', 'category', 'global') NOT NULL,
            target_id INT DEFAULT NULL,
            start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            end_date DATETIME DEFAULT NULL,
            is_active BOOLEAN DEFAULT TRUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
    } catch (Exception $e) {
        // Silently skip if DB permissions/timeout prevent schema modification
    }
}
