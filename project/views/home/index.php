<?php
// views/home/index.php
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="background">
            <p class="hero-subtitle">Explore University Graduation Projects & Research</p>
            <h1 class="hero-title">Discover Academic Excellence</h1>
            <p class="hero-description">
                Access thousands of innovative thesis papers, research projects, and academic
                works from leading universities. Find inspiration, conduct literature reviews, and contribute to the
                academic community
            </p>
            <a href="/projects" class="browse-btn">Browse All</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-container">
    <h2 class="services-title">Our Services</h2>
    <div class="services-cards">
        <!-- Service Card 1 -->
        <div class="service-card">
            <div class="service-icon">
                <i class="bi bi-search"></i>
            </div>
            <h5 class="service-card-title">Search</h5>
            <ul class="service-card-description">
                <li><strong>Multi-Disciplinary</strong> research across all fields.</li>
                <li><strong>Free Access</strong> to academic resources.</li>
            </ul>
        </div>

        <!-- Service Card 2 -->
        <div class="service-card">
            <div class="service-icon">
                <i class="bi bi-cloud-upload"></i>
            </div>
            <h5 class="service-card-title">Upload</h5>
            <ul class="service-card-description">
                <li><strong>15,000+ Projects</strong> from top universities.</li>
                <li><strong>Easy</strong> submission and management of projects.</li>
            </ul>
        </div>

        <!-- Service Card 3 -->
        <div class="service-card">
            <div class="service-icon">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
            <h5 class="service-card-title">Browse</h5>
            <ul class="service-card-description">
                <li><strong>Global Community</strong> of researchers and students.</li>
                <li><strong>Quality Assured</strong> - All projects reviewed by faculty.</li>
            </ul>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome-section" id="about">
    <div class="welcome-content">
        <h1 class="welcome-title">Welcome to Your Academic Excellence Repository</h1>
        <p class="welcome-description">
            Access thousands of innovative thesis papers, research projects, and academic works from leading universities.
        </p>
        <p class="welcome-description">
            <strong>Find</strong> inspiration, <strong>conduct</strong> literature reviews, and <strong>contribute</strong>
            to the academic community.
        </p>
        <div class="profile-section">
            <i class="bi bi-award profile-icon"></i>
            <div class="profile-info">
                <p class="profile-name">Professor Manar</p>
                <p class="profile-title">General Principal</p>
            </div>
        </div>
    </div>
    <div class="welcome-image">
        <img src="/images/welcome-section.jpg" alt="Academic Excellence Repository" class="image">
    </div>
</section>

<!-- Latest Projects Section -->
<section class="latest-projects-section" id="browse">
    <h2 class="section-title">Latest Projects</h2>
    <div class="projects-container">
        <?php if (!empty($recentProjects)): ?>
            <?php foreach ($recentProjects as $project): ?>
                <div class="project-card">
                    <h3 class="project-title"><?php echo $view->escape($project['title']); ?></h3>
                    <p class="project-description">
                        <?php echo $view->escape(substr($project['description'], 0, 150)); ?>...
                    </p>
                    <div class="project-meta">
                        <span class="project-author"><?php echo $view->escape($project['author_name']); ?></span>
                        <span class="project-date"><?php echo date('F Y', strtotime($project['created_at'])); ?></span>
                    </div>
                    <a href="/projects/<?php echo $project['id']; ?>" class="view-more-btn">View More</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="project-card">
                <h3 class="project-title">No Projects Available</h3>
                <p class="project-description">
                    Be the first to upload your academic project to our repository.
                </p>
                <div class="project-meta">
                    <span class="project-author">Admin</span>
                    <span class="project-date"><?php echo date('F Y'); ?></span>
                </div>
                <?php if ($user): ?>
                    <a href="/projects/upload" class="view-more-btn">Upload Project</a>
                <?php else: ?>
                    <a href="/register" class="view-more-btn">Join Now</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="browse-all-container">
        <a href="/projects" class="browse-all-btn">Browse All</a>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" id="cta">
    <div class="contact-container">
        <div class="contact-form">
            <h2 class="contact-title">Contact Us</h2>
            <p class="contact-subtitle">
                Explore thousands of academic projects and theses. Whether you're a student, researcher, or academic
                professional, we're here to help you find the resources you need. Reach out to us for any questions or
                assistance.
            </p>
            <form class="form" method="POST" action="/contact">
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-input-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="full_name" placeholder="John Smith" required />
                        </div>
                        <div class="form-input-group">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" placeholder="me@example.com" required />
                        </div>
                    </div>
                    <div class="form-input-group">
                        <label for="source">How can we assist you?</label>
                        <select id="source" name="assistance_type" required>
                            <option value="">Please choose one option:</option>
                            <option value="access-resources">Access to Resources</option>
                            <option value="submit-project">Submit a Project</option>
                            <option value="collaborate">Collaborate on Research</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-input-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" placeholder="Tell us how we can help you..." required></textarea>
                    </div>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215393738935!2d-73.987844924164!3d40.7484409713896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80d3dbd16c3!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</section>