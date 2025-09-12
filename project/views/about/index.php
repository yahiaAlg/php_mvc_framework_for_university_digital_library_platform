<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary mb-3">About Digital Library</h1>
                <p class="lead text-muted">Your gateway to academic excellence and research innovation</p>
            </div>

            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-mortarboard text-primary fs-1 mb-3"></i>
                            <h4>Academic Excellence</h4>
                            <p class="text-muted">Showcasing the finest graduation projects and theses from our university's brightest minds.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-globe text-success fs-1 mb-3"></i>
                            <h4>Knowledge Sharing</h4>
                            <p class="text-muted">Connecting students, researchers, and faculty through shared academic resources and insights.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-light rounded-3 p-5 mb-5">
                <h2 class="h3 mb-4">Our Mission</h2>
                <p class="mb-3">The Digital Library serves as a comprehensive repository for university graduation projects and theses, organized by academic specializations. Our platform facilitates knowledge sharing, academic collaboration, and research discovery within the university community.</p>
                
                <p class="mb-3">We believe in making academic work accessible and discoverable, helping students learn from their predecessors while contributing their own research to the collective knowledge base.</p>

                <h3 class="h4 mt-4 mb-3">Key Features</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Comprehensive project repository</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Specialized categorization system</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Advanced search and filtering</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Secure file management</li>
                    <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>User-friendly upload process</li>
                </ul>
            </div>

            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <div class="text-primary">
                        <i class="bi bi-people fs-1"></i>
                        <h4 class="mt-2">Community</h4>
                        <p class="text-muted">Students and faculty collaborating</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-success">
                        <i class="bi bi-book fs-1"></i>
                        <h4 class="mt-2">Resources</h4>
                        <p class="text-muted">Extensive academic collection</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-info">
                        <i class="bi bi-lightbulb fs-1"></i>
                        <h4 class="mt-2">Innovation</h4>
                        <p class="text-muted">Cutting-edge research projects</p>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <h3>Ready to Explore?</h3>
                <p class="text-muted mb-4">Join our academic community and discover innovative research projects.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="/projects" class="btn btn-primary btn-lg">Browse Projects</a>
                    <?php if (!$user): ?>
                        <a href="/register" class="btn btn-outline-primary btn-lg">Join Now</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>