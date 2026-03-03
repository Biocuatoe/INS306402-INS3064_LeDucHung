-- MISSION A1: Student Ops
-- Author: [Lê Đức Hùng]

-- 1. Create the database (with UTF8 support)
CREATE DATABASE IF NOT EXISTS student_management_db
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE student_management_db;

-- 2. Create 'classes' table first (Parent table)
CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(100) NOT NULL,
    department VARCHAR(100) DEFAULT 'General',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Create 'students' table (Child table)
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_code VARCHAR(20) NOT NULL UNIQUE, -- Unique ID for student
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,       -- No duplicate emails allowed
    age INT,
    class_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Foreign Key Constraint
    CONSTRAINT fk_class
        FOREIGN KEY (class_id) 
        REFERENCES classes(id)
        ON DELETE SET NULL -- If class is deleted, keep student but set class_id to NULL
);