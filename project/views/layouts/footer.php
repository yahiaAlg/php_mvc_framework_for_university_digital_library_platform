<!-- Footer Section -->

<footer class="footer">
    <div class="footer-container">
        <!-- Left Section: Logo, Description, and Student Login -->
        <div class="footer-left">
            <a href="/"><img src="/images/unilogo.png" alt="Logo" class="logo-img"></a>
            <p class="description">
                <?php echo __('footer.description'); ?><br>
                <strong><i><small>"<?php echo __('footer.tagline'); ?>"</small></i></strong>
            </p>
            <a href="/login" class="client-login">
                <ion-icon name="log-in-outline" class="login-icon"></ion-icon>
                <span class="login-text"><?php echo __('footer.student_login'); ?></span>
            </a>
        </div>
        <!-- Right Section: Columns -->
        <!-- Columns -->
        <div class="footer-columns">
            <!-- Column 1 -->
            <div class="footer-column">
                <h3 class="column-title"><?php echo __('footer.resources'); ?></h3>
                <ul class="column-list">
                    <li><a href="/projects/"><?php echo __('footer.find_thesis'); ?></a></li>
                    <li><a href="/projects/"><?php echo __('footer.research_projects'); ?></a></li>
                    <li><a href="/projects/"><?php echo __('footer.academic_resources'); ?></a></li>
                </ul>
            </div>

            <!-- Column 2 -->
            <div class="footer-column">
                <h3 class="column-title"><?php echo __('footer.who_we_help'); ?></h3>
                <ul class="column-list">
                    <li><a href="/login"><?php echo __('footer.students'); ?></a></li>
                    <li><a href="/login"><?php echo __('footer.researchers'); ?></a></li>
                    <li><a href="/login"><?php echo __('footer.academic_professionals'); ?></a></li>
                </ul>
            </div>

            <!-- Column 3 -->
            <div class="footer-column">
                <h3 class="column-title"><?php echo __('footer.about_us'); ?></h3>
                <ul class="column-list">
                    <li><a href="/about"><?php echo __('footer.about_unigrad'); ?></a></li>
                    <li><a href="/#contact"><?php echo __('footer.contact_us'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <div class="copyright">
                <p><?php echo __('footer.copyright', ['year' => date('Y')]); ?></p>
            </div>
            <div class="footer-links-bottom">
                <a href="#"><?php echo __('footer.privacy_policy'); ?></a>
                <a href="#"><?php echo __('footer.terms_of_service'); ?></a>
            </div>
            <div class="social-icons">
                <a href="#" class="social-icon"><ion-icon name="logo-twitter"></ion-icon></a>
                <a href="#" class="social-icon"><ion-icon name="logo-whatsapp"></ion-icon></a>
                <a href="#" class="social-icon"><ion-icon name="logo-instagram"></ion-icon></a>
                <a href="#" class="social-icon"><ion-icon name="logo-facebook"></ion-icon></a>
            </div>
        </div>
    </div>


</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/app.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>

</html>