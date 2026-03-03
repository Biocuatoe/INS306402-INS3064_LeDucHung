-- MISSION B3: Event Platform
-- Author: [Lê Đức Hùng]

CREATE DATABASE IF NOT EXISTS events_db;
USE events_db;

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    
    -- DATETIME is best for specific event scheduling
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    
    location VARCHAR(255),
    
    -- JSON type for flexible metadata (speakers, tags, settings)
    -- Useful when the schema of details varies per event type
    event_details JSON,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- Basic logic check to ensure event doesn't end before it starts
    CONSTRAINT check_dates CHECK (end_time > start_time)
);