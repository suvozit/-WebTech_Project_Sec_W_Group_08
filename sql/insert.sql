USE online_clothing_brand;

-- user
-- admin insert (without ID)
INSERT INTO users (user_name, user_email, user_password_hash, user_role, user_address, user_phone) 
VALUES ('Jason Newsted', 'jason.newsted@ocb.com', '$2y$10$aEI2ME5vJEBapjTVk6M3IeCKcRCnsDuBIeu8F8gM0GFLX3A0sn/Iy', 'admin', '123 Main Street, Apt 4B, New York, NY 10001', '(212) 555-1234');

SELECT * FROM users;

-- Top level categories (parent = NULL)
INSERT INTO categories (category_id, category_name, parent_category_id) VALUES
(1, 'Men', NULL),
(2, 'Women', NULL);

-- Subcategories for Men (parent = 1)
INSERT INTO categories (category_id, category_name, parent_category_id) VALUES
(3, 'Shirts', 1),
(4, 'Pants', 1),
(5, 'T-Shirts', 1),
(6, 'Jackets', 1);

-- Subcategories for Women (parent = 2)
INSERT INTO categories (category_id, category_name, parent_category_id) VALUES
(7, 'Salwar Kameez', 2),
(8, 'Jeans', 2),
(9, 'Tops', 2),
(10, 'Dresses', 2);

SELECT * FROM categories;


-- products-- 
-- Products for Men
INSERT INTO products (product_name, product_description, product_size_chart, product_price, product_category_id, product_image_path, product_stock, product_gender) VALUES
('Classic Cotton Shirt', '100% cotton, breathable fabric, perfect for daily wear', 'S, M, L, XL, XXL', 1500, 3, 'images/products/shirt1.jpg', 50, 'Men'),
('Slim Fit Jeans', 'Stretchable denim, slim fit, comfortable', '28, 30, 32, 34, 36', 2200, 4, 'images/products/jeans1.jpg', 40, 'Men'),
('Casual T-Shirt', 'Soft cotton, round neck, regular fit', 'S, M, L, XL', 750, 5, 'images/products/tshirt1.jpg', 100, 'Men'),
('Denim Jacket', 'Classic denim jacket, button closure, multiple pockets', 'S, M, L, XL', 3500, 6, 'images/products/jacket1.jpg', 25, 'Men'),
('Formal Shirt', 'Premium cotton, wrinkle-free, office wear', 'S, M, L, XL, XXL', 1800, 3, 'images/products/formalshirt1.jpg', 35, 'Men'),

-- Products for Women
('Embroidered Salwar', 'Beautiful embroidery work, includes dupatta', 'S, M, L, XL', 2800, 7, 'images/products/salwar1.jpg', 30, 'Women'),
('Skinny Fit Jeans', 'High waist, stretchable, trendy look', '26, 28, 30, 32, 34', 2100, 8, 'images/products/wjeans1.jpg', 45, 'Women'),
('Printed Cotton Top', 'Floral print, breathable cotton, casual wear', 'S, M, L, XL', 1200, 9, 'images/products/top1.jpg', 60, 'Women'),
('Summer Maxi Dress', 'Flowy fabric, floral pattern, ankle length', 'S, M, L, XL', 2600, 10, 'images/products/dress1.jpg', 35, 'Women'),
('Women Denim Jacket', 'Lightweight denim, stylish fit', 'S, M, L, XL', 3200, 6, 'images/products/wjacket1.jpg', 20, 'Women');

SELECT * FROM products;


-- Cart items for each customer (2-3 items per user)

-- User 2 (Jennifer Martinez)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(2, 1, 2),   -- Classic Cotton Shirt x2
(2, 6, 1);   -- Embroidered Salwar x1

-- User 3 (Matthew Rodriguez)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(3, 2, 1),   -- Slim Fit Jeans x1
(3, 5, 2),   -- Formal Shirt x2
(3, 8, 1);   -- Printed Cotton Top x1

-- User 4 (Ashley Davis)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(4, 7, 1),   -- Skinny Fit Jeans x1
(4, 9, 2);   -- Summer Maxi Dress x2

-- User 5 (Daniel Miller)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(5, 3, 3),   -- Casual T-Shirt x3
(5, 4, 1);   -- Denim Jacket x1

-- User 7 (Jessica Garcia)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(7, 6, 1),   -- Embroidered Salwar x1
(7, 10, 2),  -- Women Denim Jacket x2
(7, 1, 1);   -- Classic Cotton Shirt x1

-- User 8 (David Jones)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(8, 2, 1),   -- Slim Fit Jeans x1
(8, 4, 1);   -- Denim Jacket x1

-- User 9 (Sarah Brown)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(9, 5, 2),   -- Formal Shirt x2
(9, 7, 1),   -- Skinny Fit Jeans x1
(9, 9, 1);   -- Summer Maxi Dress x1

-- User 10 (Michael Williams)
INSERT INTO cart (cart_user_id, cart_product_id, cart_quantity) VALUES
(10, 3, 2),  -- Casual T-Shirt x2
(10, 6, 1),  -- Embroidered Salwar x1
(10, 8, 1);  -- Printed Cotton Top x1

SELECT * FROM cart;
SELECT COUNT(*) as total_rows FROM cart;
SELECT cart_user_id, cart_product_id, cart_quantity FROM cart ORDER BY cart_user_id;

SELECT c.cart_id, u.user_name, p.product_name, c.cart_quantity 
FROM cart c
JOIN users u ON c.cart_user_id = u.user_id
JOIN products p ON c.cart_product_id = p.product_id
ORDER BY u.user_name;


DELETE FROM cart;
SET SQL_SAFE_UPDATES = 0;
DELETE FROM cart;
SET SQL_SAFE_UPDATES = 1;




-- orders
-- Orders for each customer (1-2 orders per user)
-- Each order gets a unique order_id automatically

INSERT INTO orders (order_user_id, order_total_amount, order_status, order_date) VALUES
(2, 89.97, 'confirmed', '2026-05-10 10:30:00'),
(2, 59.99, 'pending', '2026-05-15 14:20:00'),
(3, 119.97, 'confirmed', '2026-05-11 09:15:00'),
(4, 135.97, 'rejected', '2026-05-09 16:45:00'),
(4, 54.99, 'pending', '2026-05-14 11:00:00'),
(5, 79.96, 'confirmed', '2026-05-12 13:30:00'),
(7, 149.97, 'confirmed', '2026-05-08 10:00:00'),
(8, 129.98, 'pending', '2026-05-13 15:30:00'),
(9, 124.97, 'confirmed', '2026-05-07 12:00:00'),
(10, 109.97, 'confirmed', '2026-05-14 09:45:00');

SELECT order_id, order_user_id, order_total_amount, order_status, order_date FROM orders;













-- order_items
-- Order 1 (User 2, order_id = 1, total = 89.97)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(1, 1, 1, 29.99),   -- Classic Cotton Shirt x1 = 29.99
(1, 6, 1, 59.98);   -- Embroidered Salwar x1 = 59.98 (Total = 89.97)

-- Order 2 (User 2, order_id = 2, total = 59.99)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(2, 1, 1, 29.99),   -- Classic Cotton Shirt x1 = 29.99
(2, 3, 1, 30.00);   -- Custom adjusted price = 30.00 (Total = 59.99)

-- Order 3 (User 3, order_id = 3, total = 119.97)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(3, 2, 1, 49.99),   -- Slim Fit Jeans x1 = 49.99
(3, 5, 1, 39.99),   -- Formal Shirt x1 = 39.99
(3, 8, 1, 29.99);   -- Printed Cotton Top x1 = 29.99 (Total = 119.97)

-- Order 4 (User 4, order_id = 4, total = 135.97)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(4, 7, 1, 45.99),   -- Skinny Fit Jeans x1 = 45.99
(4, 9, 1, 89.98);   -- Summer Maxi Dress x1 = 89.98 (Total = 135.97)

-- Order 5 (User 4, order_id = 5, total = 54.99)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(5, 2, 1, 54.99);   -- Slim Fit Jeans x1 = 54.99

-- Order 6 (User 5, order_id = 6, total = 79.96)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(6, 3, 4, 19.99);   -- Casual T-Shirt x4 = 79.96

-- Order 7 (User 7, order_id = 7, total = 149.97)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(7, 6, 1, 59.99),   -- Embroidered Salwar x1 = 59.99
(7, 10, 1, 69.99),  -- Women Denim Jacket x1 = 69.99
(7, 1, 1, 19.99);   -- Classic Cotton Shirt x1 = 19.99 (Total = 149.97)

-- Order 8 (User 8, order_id = 8, total = 129.98)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(8, 2, 1, 49.99),   -- Slim Fit Jeans x1 = 49.99
(8, 4, 1, 79.99);   -- Denim Jacket x1 = 79.99 (Total = 129.98)

-- Order 9 (User 9, order_id = 9, total = 124.97)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(9, 5, 2, 39.99),   -- Formal Shirt x2 = 79.98
(9, 7, 1, 45.99);   -- Skinny Fit Jeans x1 = 45.99 (Total = 125.97, close to 124.97)

-- Order 10 (User 10, order_id = 10, total = 109.97)
INSERT INTO order_items (order_item_order_id, order_item_product_id, order_item_quantity, order_item_unit_price) VALUES
(10, 3, 2, 39.99),  -- Casual T-Shirt x2 = 79.98
(10, 6, 1, 29.99);  -- Embroidered Salwar x1 = 29.99 (Total = 109.97)


UPDATE orders SET order_total_amount = 125.97 WHERE order_id = 9;


SELECT oi.order_item_order_id, SUM(oi.order_item_quantity * oi.order_item_unit_price) as calculated_total, o.order_total_amount
FROM order_items oi
JOIN orders o ON oi.order_item_order_id = o.order_id
GROUP BY oi.order_item_order_id;









-- payments
-- Payments for each order
INSERT INTO payments (payment_order_id, payment_amount, payment_method, payment_transaction_id, payment_date) VALUES
(1, 89.97, 'bKash', 'TXN100001', '2026-05-10 10:35:00'),
(2, 59.99, 'Nagad', 'TXN100002', '2026-05-15 14:25:00'),
(3, 119.97, 'Credit Card', 'TXN100003', '2026-05-11 09:20:00'),
(4, 135.97, 'bKash', 'TXN100004', '2026-05-09 16:50:00'),
(5, 54.99, 'Cash on Delivery', 'TXN100005', '2026-05-14 11:05:00'),
(6, 79.96, 'Nagad', 'TXN100006', '2026-05-12 13:35:00'),
(7, 149.97, 'Credit Card', 'TXN100007', '2026-05-08 10:05:00'),
(8, 129.98, 'bKash', 'TXN100008', '2026-05-13 15:35:00'),
(9, 125.97, 'Cash on Delivery', 'TXN100009', '2026-05-07 12:05:00'),
(10, 109.97, 'Nagad', 'TXN100010', '2026-05-14 09:50:00');


-- verify
SELECT p.payment_id, p.payment_order_id, p.payment_amount, p.payment_method, p.payment_transaction_id
FROM payments p
ORDER BY p.payment_order_id;