-- Use the correct database
USE online_clothing_brand;

-- Clear existing data (optional, but good for a fresh seed)
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE order_items;
TRUNCATE TABLE payments;
TRUNCATE TABLE orders;
TRUNCATE TABLE cart;
TRUNCATE TABLE products;
TRUNCATE TABLE categories;
TRUNCATE TABLE users;
SET FOREIGN_KEY_CHECKS = 1;

-- 1. Insert Users
-- Both passwords are 'password123'
INSERT INTO users (user_name, user_email, user_password_hash, user_role, user_address, user_phone) VALUES
('Admin User', 'admin@store.com', '$2y$10$cttEmo.U7aA6jWAGM1m73unzvbr.f.SOrPuRYZNnLrM9tRgbgu42.', 'admin', '123 Admin St, City', '1234567890'),
('John Doe', 'user@store.com', '$2y$10$cttEmo.U7aA6jWAGM1m73unzvbr.f.SOrPuRYZNnLrM9tRgbgu42.', 'customer', '456 Customer Ave, City', '0987654321'),
('Demo Seller', 'seller@store.com', '$2y$10$cttEmo.U7aA6jWAGM1m73unzvbr.f.SOrPuRYZNnLrM9tRgbgu42.', 'seller', 'Seller Studio, Gulshan, Dhaka', '01710000001'),
('Demo Rider', 'delivery@store.com', '$2y$10$cttEmo.U7aA6jWAGM1m73unzvbr.f.SOrPuRYZNnLrM9tRgbgu42.', 'delivery_man', 'Mirpur 10, Dhaka', '01710000002');

-- 2. Insert Categories
INSERT INTO categories (category_id, category_name, parent_category_id) VALUES
(1, 'Men', NULL),
(2, 'Women', NULL),
(3, 'Accessories', NULL),
(4, 'T-Shirts', 1),
(5, 'Dresses', 2),
(6, 'Watches', 3);

-- 3. Insert Products
INSERT INTO products (product_name, product_description, product_size_chart, product_price, product_category_id, product_image_path, product_stock, product_gender) VALUES
('Classic White T-Shirt', 'A premium cotton white t-shirt for everyday wear.', 'S, M, L, XL', 19.99, 4, 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?q=80&w=800&auto=format&fit=crop', 50, 'Men'),
('Vintage Denim Jacket', 'Classic blue denim jacket with a comfortable fit.', 'M, L, XL', 59.99, 1, 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?q=80&w=800&auto=format&fit=crop', 30, 'Men'),
('Floral Summer Dress', 'Lightweight and breathable floral dress perfect for summer days.', 'S, M, L', 45.00, 5, 'https://images.unsplash.com/photo-1515347619152-16e45f956d78?q=80&w=800&auto=format&fit=crop', 40, 'Women'),
('Elegant Evening Gown', 'Stunning black evening gown for special occasions.', 'S, M', 120.00, 5, 'https://images.unsplash.com/photo-1566160925235-9f55e3e29f37?q=80&w=800&auto=format&fit=crop', 15, 'Women'),
('Luxury Leather Watch', 'Minimalist design watch with a genuine leather strap.', 'One Size', 89.99, 6, 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?q=80&w=800&auto=format&fit=crop', 25, 'Men'),
('Gold Plated Necklace', 'Simple yet elegant gold plated necklace for any outfit.', 'One Size', 35.50, 3, 'https://images.unsplash.com/photo-1599643478514-4a123617be86?q=80&w=800&auto=format&fit=crop', 100, 'Women'),
('Casual Sneakers', 'Comfortable everyday sneakers in crisp white.', '7, 8, 9, 10, 11', 65.00, 1, 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?q=80&w=800&auto=format&fit=crop', 60, 'Men');
