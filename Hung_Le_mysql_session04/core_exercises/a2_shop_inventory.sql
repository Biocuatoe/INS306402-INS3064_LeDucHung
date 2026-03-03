-- MISSION A2: Shop Inventory
-- Author: [Lê Đức Hùng]

-- Assuming we are using a specific DB, or just creating the table
CREATE DATABASE IF NOT EXISTS shop_db;
USE shop_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    
    -- UNIQUE constraint: No two products can have the same SKU
    sku VARCHAR(50) NOT NULL UNIQUE,
    
    -- DECIMAL for money (10 digits total, 2 after decimal)
    -- CHECK constraint: Price must be positive
    price DECIMAL(10, 2) NOT NULL CHECK (price > 0),
    
    -- DEFAULT constraint: If not specified, stock is 0
    stock_quantity INT NOT NULL DEFAULT 0 CHECK (stock_quantity >= 0),
    
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);