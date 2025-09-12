<footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="bi bi-book me-2"></i>Digital Library</h5>
                    <p class="text-muted">University graduation projects and theses repository</p>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="/projects" class="text-light text-decoration-none">Browse Projects</a></li>
                        <li><a href="/about" class="text-light text-decoration-none">About</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Account</h6>
                    <ul class="list-unstyled">
                        <?php if ($user): ?>
                            <li><a href="/profile" class="text-light text-decoration-none">Profile</a></li>
                            <li><a href="/projects/dashboard" class="text-light text-decoration-none">My Projects</a></li>
                        <?php else: ?>
                            <li><a href="/login" class="text-light text-decoration-none">Login</a></li>
                            <li><a href="/register" class="text-light text-decoration-none">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center text-muted">
                <p>&copy; <?php echo date('Y'); ?> Digital Library. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>