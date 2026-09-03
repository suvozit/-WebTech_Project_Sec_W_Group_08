-- Create database
CREATE DATABASE online_clothing_brand;
USE online_clothing_brand;

-- Table: users
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(100) NOT NULL UNIQUE,
    user_password_hash VARCHAR(255) NOT NULL,
    user_role ENUM('admin', 'customer', 'seller', 'delivery_man') NOT NULL DEFAULT 'customer',
    user_profile_picture VARCHAR(255) DEFAULT NULL,
    user_address TEXT,
    user_phone VARCHAR(20),
    user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: categories
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL,
    parent_category_id INT DEFAULT NULL,
    category_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (parent_category_id) REFERENCES categories(category_id) ON DELETE SET NULL
);

-- Table: products
CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(200) NOT NULL,
    product_description TEXT,
    product_size_chart TEXT,
    product_price DECIMAL(10, 2) NOT NULL CHECK (product_price > 0),
    product_category_id INT NOT NULL,
    product_image_path VARCHAR(255),
    product_stock INT NOT NULL DEFAULT 0,
    product_gender ENUM('Men', 'Women') NOT NULL,
    product_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- Table: discounts
CREATE TABLE discounts (
    discount_id INT AUTO_INCREMENT PRIMARY KEY,
    discount_name VARCHAR(100) NOT NULL, -- e.g., 'Summer Sale 2026', 'Clearance'
    discount_type ENUM('percentage', 'fixed') NOT NULL DEFAULT 'percentage',
    discount_value DECIMAL(10, 2) NOT NULL CHECK (discount_value > 0),
    
    -- Target definition (What is getting discounted?)
    target_type ENUM('product', 'category', 'global') NOT NULL,
    target_id INT DEFAULT NULL, -- NULL if global. Otherwise holds product_id or category_id
    
    -- Status & Scheduling
    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    end_date DATETIME DEFAULT NULL, -- NULL means it never expires until disabled
    is_active BOOLEAN DEFAULT TRUE,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: cart
CREATE TABLE cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    cart_user_id INT NOT NULL,
    cart_product_id INT NOT NULL,
    cart_quantity INT NOT NULL DEFAULT 1 CHECK (cart_quantity > 0),
    cart_added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cart_user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (cart_product_id) REFERENCES products(product_id) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (cart_user_id, cart_product_id)
);

-- Table: orders
CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    order_user_id INT NOT NULL,
    order_delivery_man_id INT DEFAULT NULL,
    order_total_amount DECIMAL(10, 2) NOT NULL CHECK (order_total_amount >= 0),
    order_status ENUM('pending', 'confirmed', 'assigned', 'out_for_delivery', 'delivered', 'rejected') NOT NULL DEFAULT 'pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (order_delivery_man_id) REFERENCES users(user_id) ON DELETE SET NULL
);

-- Table: order_items
CREATE TABLE order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_item_order_id INT NOT NULL,
    order_item_product_id INT NOT NULL,
    order_item_quantity INT NOT NULL CHECK (order_item_quantity > 0),
    order_item_unit_price DECIMAL(10, 2) NOT NULL CHECK (order_item_unit_price >= 0),
    order_item_discount_amount DECIMAL(10, 2) DEFAULT 0.00, -- Tracks discount given at checkout
    FOREIGN KEY (order_item_order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (order_item_product_id) REFERENCES products(product_id) ON DELETE CASCADE
);

-- Table: payments
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    payment_order_id INT NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL CHECK (payment_amount >= 0),
    payment_method ENUM('Credit Card', 'bKash', 'Nagad', 'Bank Transfer', 'Cash on Delivery') NOT NULL,
    payment_transaction_id VARCHAR(100),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (payment_order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);