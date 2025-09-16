
-- Database: encryption_system

-- Drop tables if they already exist (to avoid duplication)
DROP TABLE IF EXISTS user_logs;
DROP TABLE IF EXISTS user_auth_answers;
DROP TABLE IF EXISTS auth_questions;
DROP TABLE IF EXISTS addresses;
DROP TABLE IF EXISTS users;

-- 1. Users Table
CREATE TABLE users (
    id_number VARCHAR(20) PRIMARY KEY,   -- format xxxx-xxxx
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NULL,
    last_name VARCHAR(50) NOT NULL,
    extension VARCHAR(10) NULL,          -- e.g., Jr., Sr., III
    birthdate DATE NOT NULL,
    age INT NOT NULL,                    -- computed on insert/update
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL, -- hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Addresses Table
CREATE TABLE addresses (
    address_id INT AUTO_INCREMENT PRIMARY KEY,
    id_number VARCHAR(20),
    purok_street VARCHAR(100) NOT NULL,
    barangay VARCHAR(100) NOT NULL,
    city_municipality VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    FOREIGN KEY (id_number) REFERENCES users(id_number)
);

-- 3. Authentication Questions Table
CREATE TABLE auth_questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    question_text VARCHAR(255) NOT NULL
);

-- 4. User Authentication Answers Table
CREATE TABLE user_auth_answers (
    answer_id INT AUTO_INCREMENT PRIMARY KEY,
    id_number VARCHAR(20),
    question_id INT,
    answer_hash VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_number) REFERENCES users(id_number),
    FOREIGN KEY (question_id) REFERENCES auth_questions(question_id)
);

-- 5. User Logs Table
CREATE TABLE user_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    id_number VARCHAR(20),
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('SUCCESS', 'FAILED') NOT NULL,
    FOREIGN KEY (id_number) REFERENCES users(id_number)
);
