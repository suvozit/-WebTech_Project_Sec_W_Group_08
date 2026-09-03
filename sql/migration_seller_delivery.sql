

USE online_clothing_brand;

ALTER TABLE users
    MODIFY COLUMN user_role ENUM('admin', 'customer', 'seller', 'delivery_man') NOT NULL DEFAULT 'customer';

-- Existing store products stay NULL (admin-owned). Seller products set this to the seller's user_id.
SET @col_exists := (
    SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = 'online_clothing_brand'
      AND TABLE_NAME = 'products'
      AND COLUMN_NAME = 'product_seller_id'
);
SET @sql := IF(@col_exists = 0,
    'ALTER TABLE products ADD COLUMN product_seller_id INT DEFAULT NULL',
    'SELECT 1'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

CREATE TABLE IF NOT EXISTS discounts (
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
);

-- Add order_delivery_man_id if not present and update status enum
SET @col_orders_delivery := (
    SELECT COUNT(*) FROM information_schema.COLUMNS
    WHERE TABLE_SCHEMA = 'online_clothing_brand'
      AND TABLE_NAME = 'orders'
      AND COLUMN_NAME = 'order_delivery_man_id'
);
SET @sql_orders := IF(@col_orders_delivery = 0,
    'ALTER TABLE orders ADD COLUMN order_delivery_man_id INT DEFAULT NULL',
    'SELECT 1'
);
PREPARE stmt_orders FROM @sql_orders;
EXECUTE stmt_orders;
DEALLOCATE PREPARE stmt_orders;

ALTER TABLE orders
    MODIFY COLUMN order_status ENUM('pending', 'confirmed', 'assigned', 'out_for_delivery', 'delivered', 'rejected') NOT NULL DEFAULT 'pending';

