<?php
// views/home/index.php
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <div class="background">
            <p class="hero-subtitle"><?php echo __('home.hero_subtitle'); ?></p>
            <h1 class="hero-title"><?php echo __('home.hero_title'); ?></h1>
            <p class="hero-description">
                <?php echo __('home.hero_description'); ?>
            </p>
            <a href="/projects" class="browse-btn"><?php echo __('home.browse_all'); ?></a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-container">
    <h2 class="services-title"><?php echo __('home.our_services'); ?></h2>
    <div class="services-cards">
        <!-- Service Card 1 -->
        <div class="service-card">
            <div class="service-icon">
                <i class="bi bi-search"></i>
            </div>
            <h5 class="service-card-title"><?php echo __('home.search'); ?></h5>
            <ul class="service-card-description">
                <li><strong><?php echo __('common.multidisciplinary'); ?></strong> <?php echo __('home.search_desc_1'); ?></li>
                <li><strong><?php echo __('common.free_access'); ?></strong> <?php echo __('home.search_desc_2'); ?></li>
            </ul>
        </div>

        <!-- Service Card 2 -->
        <div class="service-card">
            <div class="service-icon">
                <i class="bi bi-cloud-upload"></i>
            </div>
            <h5 class="service-card-title"><?php echo __('home.upload'); ?></h5>
            <ul class="service-card-description">
                <li><strong>15,000+</strong> <?php echo __('home.upload_desc_1'); ?></li>
                <li><strong><?php echo __('common.easy'); ?></strong> <?php echo __('home.upload_desc_2'); ?></li>
            </ul>
        </div>

        <!-- Service Card 3 -->
        <div class="service-card">
            <div class="service-icon">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
            <h5 class="service-card-title"><?php echo __('home.browse'); ?></h5>
            <ul class="service-card-description">
                <li><strong><?php echo __('common.global_community'); ?></strong> <?php echo __('home.browse_desc_1'); ?></li>
                <li><strong><?php echo __('common.quality_assured'); ?></strong> - <?php echo __('home.browse_desc_2'); ?></li>
            </ul>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome-section" id="about">
    <div class="welcome-content">
        <h1 class="welcome-title"><?php echo __('home.welcome_title'); ?></h1>
        <p class="welcome-description">
            <?php echo __('home.welcome_description_1'); ?>
        </p>
        <p class="welcome-description">
            <?php echo __('home.welcome_description_2'); ?>
        </p>
        <div class="profile-section">
            <i class="bi bi-award profile-icon"></i>
            <div class="profile-info">
                <p class="profile-name">Professor Manar</p>
                <p class="profile-title"><?php echo __('home.general_principal'); ?></p>
            </div>
        </div>
    </div>
    <div class="welcome-image">
        <img src="/images/welcome-section.jpg" alt="<?php echo __('home.welcome_title'); ?>" class="image">
    </div>
</section>

<!-- Latest Projects Section -->
<section class="latest-projects-section" id="browse">
    <h2 class="section-title"><?php echo __('home.latest_projects'); ?></h2>
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
                    <a href="/projects/<?php echo $project['id']; ?>" class="view-more-btn"><?php echo __('home.view_more'); ?></a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="project-card">
                <h3 class="project-title"><?php echo __('home.no_projects_available'); ?></h3>
                <p class="project-description">
                    <?php echo __('home.be_first_upload'); ?>
                </p>
                <div class="project-meta">
                    <span class="project-author">Admin</span>
                    <span class="project-date"><?php echo date('F Y'); ?></span>
                </div>
                <?php if ($user): ?>
                    <a href="/projects/upload" class="view-more-btn"><?php echo __('nav.upload_project'); ?></a>
                <?php else: ?>
                    <a href="/register" class="view-more-btn"><?php echo __('home.join_now'); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="browse-all-container">
        <a href="/projects" class="browse-all-btn"><?php echo __('home.browse_all'); ?></a>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" id="cta">
    <div class="contact-container">
        <div class="contact-form">
            <h2 class="contact-title"><?php echo __('home.contact_title'); ?></h2>
            <p class="contact-subtitle">
                <?php echo __('home.contact_subtitle'); ?>
            </p>
            <form class="form" method="POST" action="/contact">
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-input-group">
                            <label for="fullName"><?php echo __('home.full_name'); ?></label>
                            <input type="text" id="fullName" name="full_name" placeholder="John Smith" required />
                        </div>
                        <div class="form-input-group">
                            <label for="email"><?php echo __('home.email_address'); ?></label>
                            <input type="email" id="email" name="email" placeholder="me@example.com" required />
                        </div>
                    </div>
                    <div class="form-input-group">
                        <label for="source"><?php echo __('home.how_assist'); ?></label>
                        <select id="source" name="assistance_type" required>
                            <option value=""><?php echo __('home.choose_option'); ?></option>
                            <option value="access-resources"><?php echo __('home.access_resources'); ?></option>
                            <option value="submit-project"><?php echo __('home.submit_project'); ?></option>
                            <option value="collaborate"><?php echo __('home.collaborate'); ?></option>
                            <option value="other"><?php echo __('home.other'); ?></option>
                        </select>
                    </div>
                    <div class="form-input-group">
                        <label for="message"><?php echo __('home.message'); ?></label>
                        <textarea id="message" name="message" rows="4" placeholder="<?php echo __('home.tell_us_help'); ?>" required></textarea>
                    </div>
                </div>
                <button type="submit" class="submit-btn"><?php echo __('home.send_message'); ?></button>
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