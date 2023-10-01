-- Create a new database (if it doesn't exist)
CREATE DATABASE IF NOT EXISTS my_web_app_db;

-- Switch to the new database
USE my_web_app_db;

-- Create a table to store user information
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255),
    reset_token_expiry DATETIME
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ensure that the email and username columns are case-insensitive
ALTER TABLE users
MODIFY email VARCHAR(255) COLLATE utf8mb4_general_ci,
MODIFY username VARCHAR(255) COLLATE utf8mb4_general_ci;
