<!-- Footer Section -->
<footer class="footer">
    <div class="footer-container">
        <!-- Left Section: Logo, Description, and Student Login -->
        <div class="footer-left">
            <img src="/images/unilogo.png" alt="Logo" class="logo-img">
            <p class="description">
                We help students and researchers access thesis, projects, research papers in their long run.<br>
                <strong><i><small>"Together we build a bright future."</small></i></strong>
            </p>
            <?php if (!$user): ?>
                <a href="/login" class="client-login">
                    <i class="bi bi-box-arrow-in-right login-icon"></i>
                    <span class="login-text">Student Login</span>
                </a>
            <?php else: ?>
                <div class="client-login">
                    <i class="bi bi-person-check login-icon"></i>
                    <span class="login-text">Welcome, <?php echo $view->escape($user['full_name']); ?></span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right Section: Columns -->
        <div class="footer-columns">
            <!-- Column 1 -->
            <div class="footer-column">
                <h3 class="column-title">Resources</h3>
                <ul class="column-list">
                    <li><a href="/projects">Find Thesis Papers</a></li>
                    <li><a href="/projects">Research Projects</a></li>
                    <li><a href="/projects">Academic Resources</a></li>
                </ul>
            </div>

            <!-- Column 2 -->
            <div class="footer-column">
                <h3 class="column-title">Who We Help</h3>
                <ul class="column-list">
                    <li><a href="/register">Students</a></li>
                    <li><a href="/register">Researchers</a></li>
                    <li><a href="/register">Academic Professionals</a></li>
                </ul>
            </div>

            <!-- Column 3 -->
            <div class="footer-column">
                <h3 class="column-title">About Us</h3>
                <ul class="column-list">
                    <li><a href="/about">About UniGrad</a></li>
                    <li><a href="/projects">Projects</a></li>
                    <li><a href="#cta">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <div class="copyright">
                <p>Copyright &copy;<span class="year"><?php echo date('Y'); ?></span> by UniGrad. All rights reserved to Digital Library.</p>
            </div>
            <div class="footer-links-bottom">
                <a href="/privacy">Privacy Policy</a>
                <a href="/terms">Terms of Service</a>
            </div>
            <div class="social-icons">
                <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                <a href="#" class="social-icon"><i class="bi bi-whatsapp"></i></a>
                <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/app.js"></script>
</body>

</html>