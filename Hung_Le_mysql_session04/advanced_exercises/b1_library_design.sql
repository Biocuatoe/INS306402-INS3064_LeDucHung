-- MISSION B1: Library System
-- Author: [Lê Đức Hùng]

CREATE DATABASE IF NOT EXISTS library_db;
USE library_db;

-- Books Table
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(150) NOT NULL,
    
    -- ISBN-13 contains hyphens and can start with 0. NEVER use INT.
    isbn_13 VARCHAR(20) NOT NULL UNIQUE, 
    published_year YEAR,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Members Table
CREATE TABLE IF NOT EXISTS members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    
    -- Phone numbers contain leading zeros, +, or dashes. NEVER use INT.
    phone_number VARCHAR(20) NOT NULL, 
    joined_at DATE DEFAULT (CURRENT_DATE)
);

-- Borrow Records (Many-to-Many relationship with metadata)
CREATE TABLE IF NOT EXISTS borrow_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    member_id INT NOT NULL,
    borrow_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    due_date DATETIME NOT NULL,
    return_date DATETIME DEFAULT NULL, -- NULL means not returned yet

    FOREIGN KEY (book_id) REFERENCES books(id),
    FOREIGN KEY (member_id) REFERENCES members(id)
);