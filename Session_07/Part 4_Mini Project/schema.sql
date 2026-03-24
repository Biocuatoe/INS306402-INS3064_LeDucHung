CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category_id INT NULL,
    stock INT NOT NULL DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Insert Dummy Data
INSERT INTO categories (category_name) VALUES ('Electronics'), ('Clothing'), ('Books');
INSERT INTO products (name, price, category_id, stock) VALUES 
('Laptop', 999.99, 1, 5),     -- Low stock (Red)
('T-Shirt', 19.99, 2, 50),    -- Normal stock
('Smartphone', 699.00, 1, 8), -- Low stock (Red)
('Novel', 14.50, 3, 20),      -- Normal stock
('Unbranded Desk', 45.00, NULL, 12); -- No category