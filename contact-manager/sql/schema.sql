CREATE DATABASE IF NOT EXISTS contact_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE contact_manager;

CREATE TABLE IF NOT EXISTS contacts (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    phone      VARCHAR(20)  NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(50)  NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);
-- No default password is stored here. Create the admin with: php scripts/create_admin.php
