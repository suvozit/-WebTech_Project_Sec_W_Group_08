USE online_clothing_brand;



ALTER TABLE users
    MODIFY COLUMN user_role ENUM('admin', 'customer', 'seller', 'delivery_man') NOT NULL DEFAULT 'customer';

INSERT INTO users (user_name, user_email, user_password_hash, user_role, user_address, user_phone)
SELECT 'Demo Seller', 'seller@store.com', '$2y$10$cttEmo.U7aA6jWAGM1m73unzvbr.f.SOrPuRYZNnLrM9tRgbgu42.', 'seller', 'Seller Studio, Gulshan, Dhaka', '01710000001'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE user_email = 'seller@store.com');

INSERT INTO users (user_name, user_email, user_password_hash, user_role, user_address, user_phone)
SELECT 'Demo Rider', 'delivery@store.com', '$2y$10$cttEmo.U7aA6jWAGM1m73unzvbr.f.SOrPuRYZNnLrM9tRgbgu42.', 'delivery_man', 'Mirpur 10, Dhaka', '01710000002'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE user_email = 'delivery@store.com');
