-- Digital Library Database Schema
-- Created for University Digital Library Platform

-- Create database
CREATE DATABASE IF NOT EXISTS digital_library;
USE digital_library;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    specialization_id INT,
    role ENUM('student', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username),
    INDEX idx_specialization (specialization_id)
);

-- Specializations table
CREATE TABLE specializations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    faculty VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_faculty (faculty)
);

-- Projects table
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    author_name VARCHAR(100) NOT NULL,
    supervisor VARCHAR(100) NOT NULL,
    specialization_id INT NOT NULL,
    user_id INT NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    year YEAR NOT NULL,
    keywords TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_specialization (specialization_id),
    INDEX idx_user (user_id),
    INDEX idx_status (status),
    INDEX idx_year (year),
    FULLTEXT idx_search (title, description, keywords, author_name),
    FOREIGN KEY (specialization_id) REFERENCES specializations(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Project categories junction table (many-to-many)
CREATE TABLE project_categories (
    project_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (project_id, category_id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Add foreign key constraint for users.specialization_id
ALTER TABLE users 
ADD CONSTRAINT fk_users_specialization 
FOREIGN KEY (specialization_id) REFERENCES specializations(id) ON DELETE SET NULL;

-- Insert sample specializations
INSERT INTO specializations (name, faculty, description) VALUES
('Computer Science', 'Faculty of Engineering', 'Software development, algorithms, and computational theory'),
('Information Systems', 'Faculty of Engineering', 'Business information systems and data management'),
('Software Engineering', 'Faculty of Engineering', 'Software design, development methodologies, and project management'),
('Computer Networks', 'Faculty of Engineering', 'Network infrastructure, security, and distributed systems'),
('Artificial Intelligence', 'Faculty of Engineering', 'Machine learning, neural networks, and intelligent systems'),
('Cybersecurity', 'Faculty of Engineering', 'Information security, cryptography, and risk management'),
('Data Science', 'Faculty of Engineering', 'Big data analytics, statistical modeling, and data visualization'),
('Mobile Development', 'Faculty of Engineering', 'iOS and Android application development'),
('Web Development', 'Faculty of Engineering', 'Full-stack web applications and modern frameworks'),
('Database Systems', 'Faculty of Engineering', 'Database design, optimization, and management');

-- Insert sample categories
INSERT INTO categories (name, description) VALUES
('Web Application', 'Projects involving web-based applications'),
('Mobile Application', 'Projects for mobile platforms (iOS, Android)'),
('Machine Learning', 'Projects utilizing ML algorithms and techniques'),
('Data Analysis', 'Projects focused on data processing and analysis'),
('Security', 'Projects related to cybersecurity and information security'),
('Networking', 'Projects involving computer networks and protocols'),
('Database', 'Projects focused on database design and management'),
('Algorithm', 'Projects involving algorithmic solutions and optimization'),
('User Interface', 'Projects emphasizing UI/UX design and development'),
('Research', 'Theoretical research and academic studies');

-- Insert sample admin user (password: admin123)
INSERT INTO users (username, email, password_hash, full_name, specialization_id, role) VALUES
('admin', 'admin@university.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 1, 'admin');

-- Insert sample student users
INSERT INTO users (username, email, password_hash, full_name, specialization_id, role) VALUES
('johndoe', 'john.doe@student.university.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John Doe', 1, 'student'),
('janesmite', 'jane.smith@student.university.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jane Smith', 2, 'student'),
('mikejohnson', 'mike.johnson@student.university.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mike Johnson', 3, 'student');

-- Insert sample projects
INSERT INTO projects (title, description, author_name, supervisor, specialization_id, user_id, file_path, year, keywords, status) VALUES
('E-Commerce Website Development', 'A comprehensive e-commerce platform built with modern web technologies including user authentication, payment processing, and inventory management.', 'John Doe', 'Dr. Sarah Wilson', 1, 2, 'public/uploads/sample1.pdf', 2024, 'web development, e-commerce, PHP, MySQL', 'approved'),
('Student Information Management System', 'A complete information system for managing student records, grades, and academic progress with role-based access control.', 'Jane Smith', 'Prof. Michael Brown', 2, 3, 'public/uploads/sample2.pdf', 2024, 'information systems, database, student management', 'approved'),
('Mobile Task Manager Application', 'Cross-platform mobile application for task management with real-time synchronization and collaborative features.', 'Mike Johnson', 'Dr. Emily Davis', 3, 4, 'public/uploads/sample3.pdf', 2024, 'mobile development, React Native, task management', 'approved');

-- Insert project categories relationships
INSERT INTO project_categories (project_id, category_id) VALUES
(1, 1), (1, 7), -- E-Commerce: Web Application, Database
(2, 1), (2, 7), (2, 4), -- Student System: Web Application, Database, Data Analysis  
(3, 2), (3, 9); -- Mobile App: Mobile Application, User Interface

-- Create indexes for better performance
CREATE INDEX idx_projects_title_search ON projects(title);
CREATE INDEX idx_projects_created_date ON projects(created_at DESC);
CREATE INDEX idx_users_role ON users(role);

-- Create view for project details with related information
CREATE VIEW project_details AS
SELECT 
    p.*,
    s.name as specialization_name,
    s.faculty,
    u.full_name as uploaded_by_name,
    u.username as uploaded_by_username,
    GROUP_CONCAT(c.name) as categories
FROM projects p
LEFT JOIN specializations s ON p.specialization_id = s.id
LEFT JOIN users u ON p.user_id = u.id
LEFT JOIN project_categories pc ON p.id = pc.project_id
LEFT JOIN categories c ON pc.category_id = c.id
GROUP BY p.id;