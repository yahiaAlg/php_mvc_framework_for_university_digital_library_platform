-- Database Seeding Script
-- Insert additional sample data for testing
USE digital_library;

-- Clear existing sample data (except admin)
DELETE FROM project_categories
WHERE
    project_id > 0;

DELETE FROM projects
WHERE
    id > 0;

DELETE FROM users
WHERE
    username != 'admin';

-- Reset auto increment
ALTER TABLE projects AUTO_INCREMENT = 1;

ALTER TABLE users AUTO_INCREMENT = 2;

-- Insert sample student users
INSERT INTO
    users (
        username,
        email,
        password_hash,
        full_name,
        specialization_id,
        role
    )
VALUES
    (
        'alice.brown',
        'alice.brown@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Alice Brown',
        1,
        'student'
    ),
    (
        'bob.wilson',
        'bob.wilson@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Bob Wilson',
        2,
        'student'
    ),
    (
        'carol.davis',
        'carol.davis@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Carol Davis',
        3,
        'student'
    ),
    (
        'david.lee',
        'david.lee@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'David Lee',
        4,
        'student'
    ),
    (
        'emma.garcia',
        'emma.garcia@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Emma Garcia',
        5,
        'student'
    ),
    (
        'frank.miller',
        'frank.miller@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Frank Miller',
        6,
        'student'
    ),
    (
        'grace.taylor',
        'grace.taylor@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Grace Taylor',
        7,
        'student'
    ),
    (
        'henry.jones',
        'henry.jones@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Henry Jones',
        8,
        'student'
    ),
    (
        'iris.white',
        'iris.white@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Iris White',
        9,
        'student'
    ),
    (
        'jack.thompson',
        'jack.thompson@student.university.edu',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'Jack Thompson',
        10,
        'student'
    );

-- Insert comprehensive sample projects
INSERT INTO
    projects (
        title,
        description,
        author_name,
        supervisor,
        specialization_id,
        user_id,
        file_path,
        year,
        keywords,
        status
    )
VALUES
    -- Computer Science Projects
    (
        'AI-Powered Code Review System',
        'An intelligent system that automatically reviews code for bugs, performance issues, and best practices using machine learning algorithms. The system integrates with popular version control systems and provides detailed feedback to developers.',
        'Alice Brown',
        'Dr. Sarah Mitchell',
        1,
        2,
        'https://www.africau.edu/images/default/sample.pdf',
        2024,
        'artificial intelligence, code review, machine learning, software quality',
        'approved'
    ),
    (
        'Blockchain-Based Voting System',
        'A secure electronic voting platform built on blockchain technology ensuring transparency, immutability, and voter privacy. The system includes voter verification, ballot casting, and real-time result tracking.',
        'Bob Wilson',
        'Prof. Robert Chen',
        1,
        3,
        'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
        2024,
        'blockchain, security, voting system, cryptography',
        'approved'
    ),
    -- Information Systems Projects
    (
        'Hospital Management Information System',
        'Comprehensive web-based system for managing hospital operations including patient records, appointment scheduling, billing, inventory management, and staff coordination with role-based access control.',
        'Carol Davis',
        'Dr. Lisa Anderson',
        2,
        4,
        'https://www.learningcontainer.com/wp-content/uploads/2019/09/sample-pdf-file.pdf',
        2024,
        'healthcare, information systems, database management, web application',
        'approved'
    ),
    (
        'Smart Campus Resource Management',
        'IoT-enabled system for managing university resources including classroom booking, equipment tracking, energy monitoring, and maintenance scheduling with predictive analytics.',
        'David Lee',
        'Prof. Michael Zhang',
        2,
        5,
        'https://www.clickdimensions.com/links/TestPDFfile.pdf',
        2023,
        'IoT, resource management, smart systems, predictive analytics',
        'approved'
    ),
    -- Software Engineering Projects
    (
        'Microservices E-Learning Platform',
        'Scalable e-learning platform built using microservices architecture with features like course management, video streaming, assessment tools, and progress tracking. Includes mobile app and web interface.',
        'Emma Garcia',
        'Dr. Jennifer Park',
        3,
        6,
        'https://www.adobe.com/support/products/enterprise/knowledgecenter/media/c4611_sample_explain.pdf',
        2024,
        'microservices, e-learning, scalability, mobile development',
        'approved'
    ),
    (
        'Real-Time Collaborative Code Editor',
        'Web-based collaborative IDE supporting multiple programming languages with real-time code synchronization, integrated chat, version control, and live debugging features.',
        'Frank Miller',
        'Prof. Alex Rodriguez',
        3,
        7,
        'https://file-examples.com/storage/fe68c8c7ccf21b9e2af1a18/2017/10/file_example_PDF_1MB.pdf',
        2024,
        'real-time collaboration, web IDE, programming tools, websockets',
        'pending'
    ),
    -- Computer Networks Projects
    (
        '5G Network Performance Optimizer',
        'Advanced network optimization system for 5G infrastructure using AI algorithms to predict traffic patterns, optimize routing, and improve overall network performance and reliability.',
        'Grace Taylor',
        'Dr. Kevin Wu',
        4,
        8,
        'https://scholar.harvard.edu/files/torman_personal/files/samplepdf.pdf',
        2024,
        '5G networks, optimization, artificial intelligence, network performance',
        'approved'
    ),
    (
        'Network Security Monitoring Dashboard',
        'Real-time network security monitoring system with threat detection, intrusion prevention, and automated response capabilities. Includes machine learning-based anomaly detection.',
        'Henry Jones',
        'Prof. Maria Gonzalez',
        4,
        9,
        'https://www.orimi.com/pdf-test.pdf',
        2023,
        'network security, monitoring, threat detection, cybersecurity',
        'approved'
    ),
    -- Artificial Intelligence Projects
    (
        'Computer Vision for Medical Diagnosis',
        'Deep learning system for automated medical image analysis and diagnosis using convolutional neural networks. Supports X-ray, MRI, and CT scan analysis with high accuracy rates.',
        'Iris White',
        'Dr. Thomas Kim',
        5,
        10,
        'https://www.antennahouse.com/hubfs/xsl-fo-sample/pdf/basic-link-1.pdf',
        2024,
        'computer vision, medical diagnosis, deep learning, CNN',
        'approved'
    ),
    (
        'Natural Language Processing Chatbot',
        'Intelligent conversational AI system using advanced NLP techniques for customer service automation. Supports multiple languages and context-aware responses.',
        'Jack Thompson',
        'Prof. Amanda Foster',
        5,
        11,
        'https://www.guwahati.ac.in/web/uploads/about/history/sample.pdf',
        2024,
        'natural language processing, chatbot, AI, machine learning',
        'pending'
    ),
    -- Cybersecurity Projects
    (
        'Advanced Malware Detection System',
        'Machine learning-based malware detection system using behavioral analysis and static code analysis. Provides real-time protection with low false positive rates.',
        'Alice Brown',
        'Dr. Richard Brown',
        6,
        2,
        'https://www.soundczech.cz/temp/lorem-ipsum.pdf',
        2023,
        'malware detection, machine learning, cybersecurity, behavioral analysis',
        'approved'
    ),
    (
        'Zero-Trust Network Architecture',
        'Implementation of zero-trust security model for enterprise networks with continuous verification, micro-segmentation, and adaptive access controls.',
        'Bob Wilson',
        'Prof. Catherine Lee',
        6,
        3,
        'https://www.tutorialspoint.com/mongodb/mongodb_tutorial.pdf',
        2024,
        'zero trust, network security, access control, enterprise security',
        'approved'
    ),
    -- Data Science Projects
    (
        'Big Data Analytics for Smart Cities',
        'Large-scale data analytics platform for smart city initiatives using Apache Spark and machine learning to analyze traffic patterns, energy consumption, and citizen services.',
        'Carol Davis',
        'Dr. Steven Yang',
        7,
        4,
        'https://filesamples.com/samples/document/pdf/sample3.pdf',
        2024,
        'big data, smart cities, Apache Spark, urban analytics',
        'approved'
    ),
    (
        'Predictive Analytics for Supply Chain',
        'Machine learning system for supply chain optimization using predictive analytics to forecast demand, optimize inventory, and reduce operational costs.',
        'David Lee',
        'Prof. Nancy Wilson',
        7,
        5,
        'https://www.adobe.com/content/dam/acom/en/devnet/acrobat/pdfs/pdf_open_parameters.pdf',
        2023,
        'predictive analytics, supply chain, machine learning, optimization',
        'pending'
    ),
    -- Mobile Development Projects
    (
        'Cross-Platform Fitness Tracking App',
        'Comprehensive fitness application built with React Native featuring workout tracking, nutrition logging, social features, and integration with wearable devices.',
        'Emma Garcia',
        'Dr. Daniel Martinez',
        8,
        6,
        'https://www.irs.gov/pub/irs-pdf/fw4.pdf',
        2024,
        'mobile development, fitness tracking, React Native, wearable integration',
        'approved'
    ),
    (
        'Augmented Reality Shopping App',
        'AR-powered mobile shopping application allowing users to virtually try products, compare prices, and make purchases with immersive 3D product visualization.',
        'Frank Miller',
        'Prof. Rachel Green',
        8,
        7,
        'https://www.ssa.gov/forms/ss-5.pdf',
        2024,
        'augmented reality, mobile commerce, 3D visualization, shopping',
        'approved'
    ),
    -- Web Development Projects
    (
        'Progressive Web App for News Platform',
        'Fast, reliable news platform built as a PWA with offline reading capabilities, push notifications, personalized content recommendations, and responsive design.',
        'Grace Taylor',
        'Dr. Mark Johnson',
        9,
        8,
        'https://www.cms.gov/Medicare/CMS-Forms/CMS-Forms/Downloads/CMS40B.pdf',
        2024,
        'progressive web app, news platform, PWA, offline functionality',
        'approved'
    ),
    (
        'Real-Time Analytics Dashboard',
        'Interactive web-based dashboard for business intelligence with real-time data visualization, custom reporting, and multi-tenant architecture built with modern JavaScript frameworks.',
        'Henry Jones',
        'Prof. Laura Davis',
        9,
        9,
        'https://www.fda.gov/media/99792/download',
        2023,
        'web development, business intelligence, data visualization, real-time analytics',
        'pending'
    ),
    -- Database Systems Projects
    (
        'Distributed Database Management System',
        'High-performance distributed database system with automatic sharding, replication, and consistency management designed for large-scale web applications.',
        'Iris White',
        'Dr. Peter Chang',
        10,
        10,
        'https://www.census.gov/content/dam/Census/library/publications/2020/demo/p60-270.pdf',
        2024,
        'distributed systems, database management, sharding, replication',
        'approved'
    ),
    (
        'NoSQL Database for IoT Applications',
        'Specialized NoSQL database optimized for IoT data ingestion and analytics with time-series optimization, real-time querying, and horizontal scaling capabilities.',
        'Jack Thompson',
        'Prof. Sarah Thompson',
        10,
        11,
        'https://www.energy.gov/sites/prod/files/2019/01/f58/Ultimate%20Guide%20to%20Federal%20Energy%20Management.pdf',
        2024,
        'NoSQL, IoT, time-series database, real-time analytics',
        'approved'
    );

-- Insert project categories relationships
INSERT INTO
    project_categories (project_id, category_id)
VALUES
    -- AI Code Review System
    (1, 1),
    (1, 3),
    (1, 8),
    -- Blockchain Voting
    (2, 1),
    (2, 5),
    (2, 10),
    -- Hospital Management
    (3, 1),
    (3, 4),
    (3, 7),
    -- Smart Campus
    (4, 1),
    (4, 4),
    (4, 6),
    -- Microservices E-Learning
    (5, 1),
    (5, 2),
    -- Collaborative Code Editor
    (6, 1),
    (6, 9),
    -- 5G Optimizer
    (7, 6),
    (7, 3),
    (7, 8),
    -- Network Security Dashboard
    (8, 1),
    (8, 5),
    (8, 6),
    -- Medical Computer Vision
    (9, 3),
    (9, 4),
    (9, 10),
    -- NLP Chatbot
    (10, 1),
    (10, 3),
    (10, 9),
    -- Malware Detection
    (11, 5),
    (11, 3),
    (11, 8),
    -- Zero-Trust Architecture
    (12, 5),
    (12, 6),
    (12, 10),
    -- Smart Cities Analytics
    (13, 4),
    (13, 3),
    (13, 10),
    -- Supply Chain Predictive
    (14, 4),
    (14, 3),
    (14, 8),
    -- Fitness Tracking App
    (15, 2),
    (15, 4),
    (15, 9),
    -- AR Shopping App
    (16, 2),
    (16, 9),
    (16, 1),
    -- News PWA
    (17, 1),
    (17, 9),
    (17, 4),
    -- Analytics Dashboard
    (18, 1),
    (18, 4),
    (18, 9),
    -- Distributed Database
    (19, 7),
    (19, 8),
    (19, 10),
    -- IoT NoSQL Database
    (20, 7),
    (20, 4),
    (20, 6);

-- Update user count to reflect new users
UPDATE users
SET
    created_at = DATE_SUB (NOW (), INTERVAL FLOOR(RAND () * 365) DAY)
WHERE
    id > 1;

UPDATE projects
SET
    created_at = DATE_SUB (NOW (), INTERVAL FLOOR(RAND () * 200) DAY);

-- Add some projects with different years
UPDATE projects
SET
    year = 2023
WHERE
    id IN (4, 8, 11, 14, 18);

UPDATE projects
SET
    year = 2022
WHERE
    id IN (2, 6);

-- Set some projects as rejected for testing
UPDATE projects
SET
    status = 'rejected'
WHERE
    id IN (6, 10, 14, 18);

COMMIT;