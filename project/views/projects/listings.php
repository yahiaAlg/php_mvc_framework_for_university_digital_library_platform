<?php
// views/projects/listings.php
?>

<link rel="stylesheet" href="/css/browse.css">

<!-- Search Bar -->
<div class="search-filters" style="<?= (!$user) ? 'margin-top: 10vh;' : 'margin-top: 20vh;' ?>">
    <div class="search-bar">
        <form method="GET" action="/projects" style="display: flex; width: 100%; max-width: 800px;">
            <input type="text"
                name="search"
                placeholder="<?php echo __('listings.search_placeholder'); ?>"
                value="<?php echo $view->escape($currentSearch ?? ''); ?>">
            <input type="hidden" name="specialization" value="<?php echo $view->escape($currentSpecialization ?? ''); ?>">
            <button type="submit"><?php echo __('listings.search_button'); ?></button>
        </form>
    </div>
</div>

<!-- Main Section -->
<section class="main-section">
    <!-- Filters -->
    <div class="filters">
        <form method="GET" action="/projects" id="filterForm">
            <input type="hidden" name="search" value="<?php echo $view->escape($currentSearch ?? ''); ?>">

            <div class="filter-group">
                <label for="year"><?php echo __('listings.year_filter'); ?></label>
                <select class="sort-dropdown" id="year" name="year" onchange="document.getElementById('filterForm').submit();">
                    <option value=""><?php echo __('listings.all_years'); ?></option>
                    <?php for ($year = date('Y'); $year >= 2020; $year--): ?>
                        <option value="<?php echo $year; ?>" <?php echo (($_GET['year'] ?? '') == $year) ? 'selected' : ''; ?>>
                            <?php echo $year; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="specialization"><?php echo __('listings.specialization'); ?></label>
                <select class="sort-dropdown" id="specialization" name="specialization" onchange="document.getElementById('filterForm').submit();">
                    <option value=""><?php echo __('listings.all_specializations'); ?></option>
                    <?php foreach ($specializations as $spec): ?>
                        <option value="<?php echo $spec['id']; ?>"
                            <?php echo ($currentSpecialization == $spec['id']) ? 'selected' : ''; ?>>
                            <?php echo $view->escape($spec['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="filter-group">
                <label for="status"><?php echo __('listings.status'); ?></label>
                <select class="sort-dropdown" id="status" name="status" onchange="document.getElementById('filterForm').submit();">
                    <option value=""><?php echo __('listings.all_status'); ?></option>
                    <option value="approved" <?php echo (($_GET['status'] ?? '') == 'approved') ? 'selected' : ''; ?>><?php echo __('listings.approved'); ?></option>
                    <option value="pending" <?php echo (($_GET['status'] ?? '') == 'pending') ? 'selected' : ''; ?>><?php echo __('listings.pending'); ?></option>
                </select>
            </div>

            <!-- Sort option -->
            <div class="sort-container">
                <label for="sort-options" class="sort-label"><?php echo __('listings.sort_by'); ?></label>
                <select class="sort-dropdown" id="sort-options" name="sort" onchange="document.getElementById('filterForm').submit();">
                    <option value="created_at_desc" <?php echo (($_GET['sort'] ?? '') == 'created_at_desc') ? 'selected' : ''; ?>><?php echo __('listings.most_recent'); ?></option>
                    <option value="title_asc" <?php echo (($_GET['sort'] ?? '') == 'title_asc') ? 'selected' : ''; ?>><?php echo __('listings.title_az'); ?></option>
                    <option value="year_desc" <?php echo (($_GET['sort'] ?? '') == 'year_desc') ? 'selected' : ''; ?>><?php echo __('listings.year_newest'); ?></option>
                    <option value="author_asc" <?php echo (($_GET['sort'] ?? '') == 'author_asc') ? 'selected' : ''; ?>><?php echo __('listings.author_az'); ?></option>
                </select>
            </div>
        </form>
    </div>

    <!-- Results Summary -->
    <?php if (!empty($projects['data'])): ?>
        <div style="padding: 0 20px; margin-bottom: 20px; color: #666;">
            <p><?php echo __('listings.showing_results', ['count' => count($projects['data']), 'total' => $projects['total']]); ?>
                <?php if ($currentSearch): ?>
                    <?php echo __('listings.search_for', ['search' => $view->escape($currentSearch)]); ?>
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Cards Grid -->
    <div class="cards-grid">
        <?php if (!empty($projects['data'])): ?>
            <?php foreach ($projects['data'] as $project): ?>
                <div class="card">
                    <a href="/projects/<?php echo $project['id']; ?>">
                        <img src="<?= $view->escape(str_replace("public", "", $project['image_path'])) ?>" alt="Project Image" class="card-img">
                    </a>
                    <div class="card-content">
                        <div class="card-title">
                            <?php echo $view->escape($project['title']); ?>
                        </div>
                        <div class="card-meta">
                            <span class="card-author"><?php echo $view->escape($project['author_name']); ?></span>
                            <span class="card-year"><?php echo $view->escape($project['year']); ?></span>
                            <span class="card-type">
                                <?php echo ucfirst($view->escape($project['status'] ?? __('listings.projects'))); ?>
                            </span>
                        </div>
                        <div class="card-desc">
                            <?php
                            $description = $project['description'];
                            echo $view->escape(strlen($description) > 150 ? substr($description, 0, 150) . '...' : $description);
                            ?>
                        </div>
                        <div class="card-footer">
                            <span class="card-university">
                                <?php echo $view->escape($project['specialization_name'] ?? 'University Digital Library'); ?>
                            </span>
                            <a href="/projects/<?php echo $project['id']; ?>">
                                <button class="view-details-btn"><?php echo __('listings.view_details'); ?></button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- No Results -->
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #666;">
                <h3><?php echo __('listings.no_projects_found'); ?></h3>
                <p><?php echo __('listings.try_adjusting'); ?></p>
                <a href="/projects" style="color: #b52626; text-decoration: none; margin-top: 10px; display: inline-block;">
                    <?php echo __('listings.view_all_projects'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (!empty($projects['data']) && $projects['last_page'] > 1): ?>
        <div class="pagination">
            <?php
            $currentPage = $projects['current_page'];
            $lastPage = $projects['last_page'];
            $queryParams = $_GET;
            ?>

            <?php if ($currentPage > 1): ?>
                <?php
                $queryParams['page'] = $currentPage - 1;
                $prevUrl = '/projects?' . http_build_query($queryParams);
                ?>
                <a href="<?php echo $prevUrl; ?>" class="pagination-arrow">‹</a>
            <?php endif; ?>

            <?php
            $startPage = max(1, $currentPage - 2);
            $endPage = min($lastPage, $currentPage + 2);

            for ($page = $startPage; $page <= $endPage; $page++):
                $queryParams['page'] = $page;
                $pageUrl = '/projects?' . http_build_query($queryParams);
            ?>
                <a href="<?php echo $pageUrl; ?>"
                    class="pagination-number <?php echo ($page == $currentPage) ? 'active' : ''; ?>">
                    <?php echo $page; ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $lastPage): ?>
                <?php
                $queryParams['page'] = $currentPage + 1;
                $nextUrl = '/projects?' . http_build_query($queryParams);
                ?>
                <a href="<?php echo $nextUrl; ?>" class="pagination-arrow">›</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<style>
    /* Additional styles specific to the listings page */
    .main-section {
        background-color: #eee;
        padding: 20px;
        border-radius: 8px;
        color: #333;
        min-height: 600px;
    }

    .search-filters {
        margin: 70px 0;
    }

    /* Override some styles for better integration */
    .card-title {
        color: #333;
        font-weight: 600;
        line-height: 1.4;
        min-height: 50px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-desc {
        min-height: 60px;
        overflow: hidden;
    }

    .filters form {
        display: contents;
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .sort-container {
            margin-left: auto;
        }
    }

    @media (max-width: 768px) {
        .cards-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .filters {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .filter-group,
        .sort-container {
            margin-left: 0;
        }

        .sort-container {
            flex-direction: row;
            justify-content: space-between;
        }
    }
</style>