CREATE DATABASE IF NOT EXISTS student_crud
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE student_crud;

CREATE TABLE IF NOT EXISTS student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    gender ENUM('Male', 'Female', 'Other') DEFAULT 'Other',
    major VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
);

INSERT INTO student (name, email, phone, gender, major, address)
VALUES
    ('Nguyễn Hoàng Da', 'da@gmail.com', '0900000001', 'Male', 'Da đen', 'Da đen')
    ('Nguyễn Hoàng Đen', 'dadenxi@gmail.com', '0900000002', 'Male', 'Da đen', 'P8')
    ('Nguyễn Hoàng Daden', 'daden@gmail.com', '0900000003', 'Male', 'Da đen', 'Da đen')
    
