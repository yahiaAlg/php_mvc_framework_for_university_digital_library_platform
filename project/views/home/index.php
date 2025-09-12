<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Welcome to Digital Library</h1>
                <p class="lead mb-4">Explore university graduation projects and theses from various academic specializations. Discover innovative research and academic excellence.</p>
                <div class="d-flex gap-3">
                    <a href="/projects" class="btn btn-light btn-lg">Browse Projects</a>
                    <?php if (!$user): ?>
                        <a href="/register" class="btn btn-outline-light btn-lg">Join Now</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-white bg-opacity-10 rounded-3 p-4">
                    <form action="/projects" method="GET" class="row g-3">
                        <div class="col-12">
                            <input type="text" name="search" class="form-control form-control-lg" 
                                   placeholder="Search projects by title, keywords, or author..."
                                   value="<?php echo $view->escape($_GET['search'] ?? ''); ?>">
                        </div>
                        <div class="col-md-6">
                            <select name="specialization" class="form-select form-select-lg">
                                <option value="">All Specializations</option>
                                <?php foreach ($specializations as $spec): ?>
                                    <option value="<?php echo $spec['id']; ?>"
                                            <?php echo ($_GET['specialization'] ?? '') == $spec['id'] ? 'selected' : ''; ?>>
                                        <?php echo $view->escape($spec['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-light btn-lg w-100">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-4 text-center mb-4">
                <div class="feature-icon bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="bi bi-collection fs-2"></i>
                </div>
                <h4>Extensive Collection</h4>
                <p class="text-muted">Access thousands of graduation projects and theses from various academic specializations.</p>
            </div>
            <div class="col-lg-4 text-center mb-4">
                <div class="feature-icon bg-success text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="bi bi-search fs-2"></i>
                </div>
                <h4>Advanced Search</h4>
                <p class="text-muted">Find projects easily with our powerful search functionality by keywords, specialization, or author.</p>
            </div>
            <div class="col-lg-4 text-center mb-4">
                <div class="feature-icon bg-info text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="bi bi-upload fs-2"></i>
                </div>
                <h4>Easy Upload</h4>
                <p class="text-muted">Students can easily upload their projects and theses to share with the academic community.</p>
            </div>
        </div>

        <?php if (!empty($recentProjects)): ?>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Recent Projects</h2>
                <div class="row">
                    <?php foreach ($recentProjects as $project): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-secondary"><?php echo $view->escape($project['specialization_name']); ?></span>
                                    <small class="text-muted"><?php echo $view->escape($project['year']); ?></small>
                                </div>
                                <h5 class="card-title">
                                    <a href="/projects/<?php echo $project['id']; ?>" class="text-decoration-none">
                                        <?php echo $view->escape($project['title']); ?>
                                    </a>
                                </h5>
                                <p class="card-text text-muted small">
                                    <?php echo $view->escape(substr($project['description'], 0, 120) . '...'); ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i><?php echo $view->escape($project['author_name']); ?>
                                    </small>
                                    <a href="/projects/<?php echo $project['id']; ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="text-center mt-4">
                    <a href="/projects" class="btn btn-primary btn-lg">View All Projects</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>