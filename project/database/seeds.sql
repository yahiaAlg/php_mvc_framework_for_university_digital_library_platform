-- Database Seeding Script - Based on HTML Browse Page
-- Insert sample data matching the cards displayed
USE digital_library;

-- Clear existing sample data (except admin)
DELETE FROM project_categories WHERE project_id > 0;
DELETE FROM projects WHERE id > 0;
DELETE FROM users WHERE username != 'admin';

-- Reset auto increment
ALTER TABLE projects AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 2;

-- Insert specializations first
INSERT IGNORE INTO specializations (id, name, faculty, description) VALUES
(1, 'Computer Science', 'Faculty of Engineering', 'Software development, algorithms, and computational theory'),
(2, 'Information Systems', 'Faculty of Engineering', 'Business information systems and data management'),
(3, 'Software Engineering', 'Faculty of Engineering', 'Software design, development methodologies, and project management'),
(4, 'Computer Networks', 'Faculty of Engineering', 'Network infrastructure, security, and distributed systems'),
(5, 'Artificial Intelligence', 'Faculty of Engineering', 'Machine learning, neural networks, and intelligent systems'),
(6, 'Cybersecurity', 'Faculty of Engineering', 'Information security, cryptography, and risk management'),
(7, 'Data Science', 'Faculty of Engineering', 'Big data analytics, statistical modeling, and data visualization'),
(8, 'Mobile Development', 'Faculty of Engineering', 'iOS and Android application development'),
(9, 'Web Development', 'Faculty of Engineering', 'Full-stack web applications and modern frameworks'),
(10, 'Database Systems', 'Faculty of Engineering', 'Database design, optimization, and management'),
(11, 'Medical Informatics', 'Faculty of Medicine', 'Healthcare technology and medical data systems'),
(12, 'Electrical Engineering', 'Faculty of Engineering', 'Hardware design and embedded systems'),
(13, 'Augmented Reality', 'Faculty of Engineering', 'AR/VR technology and immersive applications'),
(14, 'High Performance Computing', 'Faculty of Engineering', 'Parallel computing and cluster systems'),
(15, 'Hardware Engineering', 'Faculty of Engineering', 'FPGA and hardware acceleration');

-- Insert categories if they don't exist
INSERT IGNORE INTO categories (id, name, description) VALUES
(1, 'Web Application', 'Projects involving web-based applications'),
(2, 'Mobile Application', 'Projects for mobile platforms (iOS, Android)'),
(3, 'Machine Learning', 'Projects utilizing ML algorithms and techniques'),
(4, 'Data Analysis', 'Projects focused on data processing and analysis'),
(5, 'Security', 'Projects related to cybersecurity and information security'),
(6, 'Networking', 'Projects involving computer networks and protocols'),
(7, 'Database', 'Projects focused on database design and management'),
(8, 'Algorithm', 'Projects involving algorithmic solutions and optimization'),
(9, 'User Interface', 'Projects emphasizing UI/UX design and development'),
(10, 'Research', 'Theoretical research and academic studies'),
(11, 'Healthcare', 'Medical and healthcare-related projects'),
(12, 'Education', 'Educational technology and e-learning projects'),
(13, 'Blockchain', 'Distributed ledger and cryptocurrency projects'),
(14, 'IoT', 'Internet of Things and embedded systems'),
(15, 'AR/VR', 'Augmented and Virtual Reality applications');

-- Insert sample student users based on the authors in HTML
INSERT INTO users (username, email, password_hash, full_name, specialization_id, role) VALUES
('sarah.johnson', 'sarah.johnson@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sarah Johnson', 5, 'student'),
('ahmed.alhassan', 'ahmed.alhassan@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ahmed Al-Hassan', 3, 'student'),
('maria.rodriguez', 'maria.rodriguez@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Maria Rodriguez', 6, 'student'),
('david.thompson', 'david.thompson@cmu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'David Thompson', 3, 'student'),
('elena.petrov', 'elena.petrov@oxford.ac.uk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Dr. Elena Petrov', 11, 'student'),
('fatima.alzahra', 'fatima.alzahra@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fatima Al-Zahra', 5, 'student'),
('kevin.zhang', 'kevin.zhang@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Kevin Zhang', 5, 'student'),
('isabella.santos', 'isabella.santos@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Isabella Santos', 7, 'student'),
('omar.hassan', 'omar.hassan@cmu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Omar Hassan', 6, 'student'),
('anna.kowalski', 'anna.kowalski@oxford.ac.uk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Anna Kowalski', 6, 'student'),
('lucas.silva', 'lucas.silva@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lucas Silva', 6, 'student'),
('raj.patel', 'raj.patel@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Raj Patel', 4, 'student'),
('sophie.martin', 'sophie.martin@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Sophie Martin', 11, 'student'),
('yuki.tanaka', 'yuki.tanaka@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Yuki Tanaka', 8, 'student'),
('carlos.mendez', 'carlos.mendez@cmu.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Carlos Mendez', 9, 'student'),
('priya.sharma', 'priya.sharma@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Priya Sharma', 15, 'student'),
('michael.oconnor', 'michael.oconnor@oxford.ac.uk', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Michael O\'Connor', 12, 'student'),
('lei.wang', 'lei.wang@ethz.ch', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Lei Wang', 7, 'student'),
('jennifer.kim', 'jennifer.kim@stanford.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Jennifer Kim', 1, 'student'),
('alessandro.rossi', 'alessandro.rossi@mit.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Alessandro Rossi', 12, 'student');

-- Insert projects exactly as shown in HTML cards
INSERT INTO projects (title, description, author_name, supervisor, specialization_id, user_id, image_path, file_path, year, keywords, status) VALUES
-- Card 1
('Advanced E-Learning Management System with AI Integration', 'An intelligent e-learning system using machine learning for personalized learning experiences, automated content assessment, and adaptive learning paths based on student performance.', 'Sarah Johnson', 'Dr. Michael Stevens', 5, 2, '/images/card1-img.png', 'https://www.africau.edu/images/default/sample.pdf', 2024, 'AI, e-learning, machine learning, education, personalization', 'approved'),

-- Card 2
('Microservices Architecture for Enterprise Resource Planning', 'Development of a scalable, microservices-based ERP system for medium to large enterprises, focusing on containerization, service orchestration, and event-driven architecture for high availability and fault tolerance.', 'Ahmed Al-Hassan', 'Prof. Sarah Mitchell', 3, 3, '/images/card2-img.png', 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', 2023, 'microservices, ERP, containerization, scalability, enterprise', 'approved'),

-- Card 3
('Blockchain-Based Digital Identity Verification System', 'A decentralized digital identity verification system using blockchain, addressing privacy concerns with cryptographic proofs and smart contracts for security and authenticity.', 'Maria Rodriguez', 'Dr. Robert Chen', 6, 4, '/images/card3-img.png', 'https://www.learningcontainer.com/wp-content/uploads/2019/09/sample-pdf-file.pdf', 2024, 'blockchain, digital identity, security, cryptography, decentralization', 'approved'),

-- Card 4
('Real-Time Collaborative Code Editor with Version Control', 'A web-based collaborative code editor with real-time multi-user editing, version control, syntax highlighting, auto-completion, and conflict resolution.', 'David Thompson', 'Prof. Lisa Anderson', 3, 5, '/images/card4-img.png', 'https://www.clickdimensions.com/links/TestPDFfile.pdf', 2023, 'real-time collaboration, code editor, version control, web application', 'approved'),

-- Card 5
('Deep Learning Model for Medical Image Diagnosis', 'A convolutional neural network for skin cancer diagnosis from dermoscopic images, achieving 94.2% accuracy with uncertainty quantification for clinical support.', 'Dr. Elena Petrov', 'Prof. Michael Zhang', 11, 6, '/images/card5-img.png', 'https://www.adobe.com/support/products/enterprise/knowledgecenter/media/c4611_sample_explain.pdf', 2024, 'deep learning, medical imaging, CNN, cancer diagnosis, healthcare', 'approved'),

-- Card 6
('Natural Language Processing for Sentiment Analysis in Social Media', 'Exploring advanced NLP techniques for multilingual social media sentiment analysis using a transformer-based model that handles code-switching and cultural context.', 'Fatima Al-Zahra', 'Dr. Jennifer Park', 5, 7, '/images/card6-img.png', 'https://file-examples.com/storage/fe68c8c7ccf21b9e2af1a18/2017/10/file_example_PDF_1MB.pdf', 2023, 'NLP, sentiment analysis, social media, transformers, multilingual', 'approved'),

-- Card 7
('Reinforcement Learning for Autonomous Vehicle Navigation', 'Implementation of a reinforcement learning algorithm for autonomous vehicle navigation using deep Q-learning, trained in a simulated urban environment with dynamic obstacles and traffic patterns.', 'Kevin Zhang', 'Prof. Alex Rodriguez', 5, 8, '/images/card7-img.png', 'https://scholar.harvard.edu/files/torman_personal/files/samplepdf.pdf', 2024, 'reinforcement learning, autonomous vehicles, deep Q-learning, simulation', 'approved'),

-- Card 8
('Predictive Analytics for Supply Chain Optimization', 'Applying machine learning to predict demand and optimize global supply chain inventory using time series forecasting and multi-objective optimization for cost reduction and service improvement.', 'Isabella Santos', 'Dr. Kevin Wu', 7, 9, '/images/card8-img.png', 'https://www.orimi.com/pdf-test.pdf', 2023, 'predictive analytics, supply chain, machine learning, optimization', 'approved'),

-- Card 9
('Advanced Intrusion Detection System Using Machine Learning', 'An intelligent intrusion detection system combining signature-based and anomaly-based methods using ensemble machine learning to improve zero-day attack detection and reduce false positives.', 'Omar Hassan', 'Prof. Maria Gonzalez', 6, 10, '/images/card9-img.png', 'https://www.antennahouse.com/hubfs/xsl-fo-sample/pdf/basic-link-1.pdf', 2024, 'intrusion detection, machine learning, cybersecurity, anomaly detection', 'approved'),

-- Card 10
('Blockchain-Based Secure Communication Protocol', 'A secure blockchain-based communication protocol for end-to-end encrypted messaging, ensuring integrity, authentication, non-repudiation, decentralization, and scalability.', 'Anna Kowalski', 'Prof. Thomas Kim', 6, 11, '/images/card10-img.png', 'https://www.guwahati.ac.in/web/uploads/about/history/sample.pdf', 2023, 'blockchain, secure communication, encryption, messaging, protocol', 'approved'),

-- Card 11
('Vulnerability Assessment Framework for IoT Devices', 'An automated vulnerability assessment framework for IoT devices, featuring static and dynamic analysis, firmware reverse engineering, and comprehensive reporting.', 'Lucas Silva', 'Prof. Amanda Foster', 6, 12, '/images/card11-img.png', 'https://www.soundczech.cz/temp/lorem-ipsum.pdf', 2024, 'IoT security, vulnerability assessment, firmware analysis, cybersecurity', 'approved'),

-- Card 12
('Software-Defined Network Security Architecture', 'A scalable SDN security framework integrating distributed firewalls, real-time monitoring, and automated threat response to optimize performance and resilience.', 'Raj Patel', 'Dr. Richard Brown', 4, 13, '/images/card12-img.png', 'https://www.tutorialspoint.com/mongodb/mongodb_tutorial.pdf', 2023, 'SDN, network security, distributed systems, threat response', 'approved'),

-- Card 13
('Progressive Web Application for Healthcare Management', 'A HIPAA-compliant PWA for healthcare, offering offline access, real-time sync, patient records, appointment scheduling, and telemedicine.', 'Sophie Martin', 'Prof. Catherine Lee', 11, 14, '/images/card13-img.png', 'https://filesamples.com/samples/document/pdf/sample3.pdf', 2024, 'PWA, healthcare, HIPAA compliance, telemedicine, patient management', 'approved'),

-- Card 14
('Cross-Platform Mobile App for Language Learning', 'A cross-platform language-learning app with gamification, spaced repetition, social features, offline access, and adaptive learning for personalized progress.', 'Yuki Tanaka', 'Dr. Steven Yang', 8, 15, '/images/card14-img.png', 'https://www.adobe.com/content/dam/acom/en/devnet/acrobat/pdfs/pdf_open_parameters.pdf', 2023, 'mobile development, language learning, gamification, cross-platform', 'approved'),

-- Card 15
('E-commerce Platform with Microservices Architecture', 'A scalable e-commerce platform built on microservices and containers, featuring user management, product catalog, order processing, payments, real-time inventory, and a recommendation engine.', 'Carlos Mendez', 'Prof. Nancy Wilson', 9, 16, '/images/card15-img.png', 'https://www.irs.gov/pub/irs-pdf/fw4.pdf', 2024, 'e-commerce, microservices, containerization, recommendation engine', 'approved'),

-- Card 16
('Augmented Reality Mobile Application for Education', 'An AR mobile app for interactive science education, using computer vision and 3D rendering to overlay digital content on real-world objects, boosting engagement in physics and chemistry.', 'Priya Sharma', 'Dr. Daniel Martinez', 15, 17, '/images/card16-img.png', 'https://www.ssa.gov/forms/ss-5.pdf', 2023, 'augmented reality, education, mobile app, computer vision, science', 'approved'),

-- Card 17
('Real-Time Operating System for Embedded IoT Devices', 'A lightweight RTOS for IoT devices, optimized for real-time task scheduling, efficient memory management, and power savings in battery-powered embedded systems.', 'Michael O\'Connor', 'Prof. Rachel Green', 12, 18, '/images/card17-img.png', 'https://www.cms.gov/Medicare/CMS-Forms/CMS-Forms/Downloads/CMS40B.pdf', 2024, 'RTOS, embedded systems, IoT, real-time scheduling, power optimization', 'approved'),

-- Card 18
('Distributed Computing Framework for Big Data Processing', 'A distributed computing framework for big data, optimizing data locality and fault tolerance with adaptive load balancing and automatic recovery for enhanced reliability.', 'Lei Wang', 'Dr. Mark Johnson', 7, 19, '/images/card18-img.png', 'https://www.fda.gov/media/99792/download', 2023, 'distributed computing, big data, fault tolerance, load balancing', 'approved'),

-- Card 19
('High-Performance Computing Cluster Management System', 'A high-performance computing cluster management system featuring job scheduling, resource allocation, monitoring, and performance optimization, with support for heterogeneous hardware and predictive maintenance.', 'Jennifer Kim', 'Prof. Laura Davis', 1, 20, '/images/card19-img.png', 'https://www.census.gov/content/dam/Census/library/publications/2020/demo/p60-270.pdf', 2024, 'HPC, cluster management, job scheduling, performance optimization', 'approved'),

-- Card 20
('FPGA-Based Accelerator for Machine Learning Inference', 'An FPGA-based hardware accelerator for edge AI, delivering high-performance deep neural network inference with low power consumption, outperforming CPU/GPU solutions.', 'Alessandro Rossi', 'Prof. Peter Chang', 12, 21, '/images/card20-img.png', 'https://www.energy.gov/sites/prod/files/2019/01/f58/Ultimate%20Guide%20to%20Federal%20Energy%20Management.pdf', 2023, 'FPGA, machine learning, hardware acceleration, edge AI, neural networks', 'approved');

-- Insert project categories relationships
INSERT INTO project_categories (project_id, category_id) VALUES
-- Card 1: AI E-Learning System
(1, 3), (1, 12), (1, 1),
-- Card 2: Microservices ERP
(2, 1), (2, 7),
-- Card 3: Blockchain Identity
(3, 13), (3, 5),
-- Card 4: Code Editor
(4, 1), (4, 9),
-- Card 5: Medical Image Diagnosis
(5, 3), (5, 11), (5, 10),
-- Card 6: NLP Sentiment Analysis
(6, 3), (6, 4), (6, 10),
-- Card 7: Autonomous Vehicle RL
(7, 3), (7, 8),
-- Card 8: Supply Chain Analytics
(8, 4), (8, 3),
-- Card 9: Intrusion Detection
(9, 5), (9, 3),
-- Card 10: Blockchain Communication
(10, 13), (10, 5),
-- Card 11: IoT Vulnerability Assessment
(11, 14), (11, 5),
-- Card 12: SDN Security
(12, 6), (12, 5),
-- Card 13: Healthcare PWA
(13, 1), (13, 11),
-- Card 14: Language Learning App
(14, 2), (14, 12),
-- Card 15: E-commerce Platform
(15, 1), (15, 2),
-- Card 16: AR Education App
(16, 15), (16, 12), (16, 2),
-- Card 17: RTOS for IoT
(17, 14), (17, 8),
-- Card 18: Big Data Framework
(18, 4), (18, 8),
-- Card 19: HPC Cluster Management
(19, 1), (19, 8),
-- Card 20: FPGA ML Accelerator
(20, 3), (20, 8);

-- Update timestamps for variety
UPDATE users SET created_at = DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 365) DAY) WHERE id > 1;
UPDATE projects SET created_at = DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 200) DAY);

-- Add some pending projects for realism
UPDATE projects SET status = 'pending' WHERE id IN (6, 10, 14);

COMMIT;