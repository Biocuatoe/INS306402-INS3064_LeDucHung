-- MISSION B2: Employee Directory
-- Author: [Lê Đức Hùng]

CREATE DATABASE IF NOT EXISTS hr_db;
USE hr_db;

CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    
    -- ENUM for strict department lists
    department ENUM('HR', 'Engineering', 'Sales', 'Marketing', 'Executive') NOT NULL,
    
    -- DATE for hire date (Time is irrelevant here)
    hire_date DATE NOT NULL,
    
    -- DECIMAL(15,2) for salary. 
    -- FLOAT/DOUBLE causes rounding errors with money.
    salary DECIMAL(15, 2) NOT NULL CHECK (salary >= 0),
    
    is_active BOOLEAN DEFAULT TRUE
);