-- Digital Library Database Schema
-- Created for University Digital Library Platform
-- Create database
CREATE DATABASE IF NOT EXISTS digital_library;

USE digital_library;

-- Users table
CREATE TABLE
    users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        full_name VARCHAR(100) NOT NULL,
        specialization_id INT,
        role ENUM ('student', 'admin') DEFAULT 'student',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_email (email),
        INDEX idx_username (username),
        INDEX idx_specialization (specialization_id)
    );

-- Specializations table
CREATE TABLE
    specializations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        faculty VARCHAR(100) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_faculty (faculty)
    );

-- Projects table
CREATE TABLE
    projects (
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
        status ENUM ('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_specialization (specialization_id),
        INDEX idx_user (user_id),
        INDEX idx_status (status),
        INDEX idx_year (year),
        FULLTEXT idx_search (title, description, keywords, author_name),
        FOREIGN KEY (specialization_id) REFERENCES specializations (id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
    );

-- Categories table
CREATE TABLE
    categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

-- Project categories junction table (many-to-many)
CREATE TABLE
    project_categories (
        project_id INT NOT NULL,
        category_id INT NOT NULL,
        PRIMARY KEY (project_id, category_id),
        FOREIGN KEY (project_id) REFERENCES projects (id) ON DELETE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE CASCADE
    );

-- Add foreign key constraint for users.specialization_id
ALTER TABLE users ADD CONSTRAINT fk_users_specialization FOREIGN KEY (specialization_id) REFERENCES specializations (id) ON DELETE SET NULL;