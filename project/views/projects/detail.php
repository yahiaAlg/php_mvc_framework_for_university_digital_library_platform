<?php
// views/projects/detail.php
?>

<link rel="stylesheet" href="/css/details.css">

<!-- Main Container -->
<div class="main-container">
    <!-- Content Area -->
    <div class="content-area">
        <!-- Document Preview Section -->
        <div class="document-preview">
            <h1 class="document-title"><?php echo $view->escape($project['title']); ?></h1>

            <div class="document-meta">
                <div class="meta-item">
                    <i class="bi bi-person"></i>
                    <span><strong>Author:</strong> <?php echo $view->escape($project['author_name']); ?></span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-calendar"></i>
                    <span><strong>Year:</strong> <?php echo $view->escape($project['year']); ?></span>
                </div>
                <div class="meta-item">
                    <i class="bi bi-mortarboard"></i>
                    <span><strong>Type:</strong> <?php echo ucfirst($view->escape($project['status'] ?? 'Project')); ?></span>
                </div>
                <?php if (isset($project['supervisor'])): ?>
                    <div class="meta-item">
                        <i class="bi bi-person-check"></i>
                        <span><strong>Supervisor:</strong> <?php echo $view->escape($project['supervisor']); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="preview-images">
                <div class="main-preview">
                    <div class="main-preview-content">
                        <i class="bi bi-file-earmark-text" style="font-size: 48px; color: #ccc;"></i>
                        <p>Document Preview</p>
                        <small>Click download to view full document</small>
                    </div>
                </div>
                <div class="secondary-previews">
                    <div class="secondary-preview">
                        <?php
                        $fileExt = pathinfo($project['file_path'], PATHINFO_EXTENSION);
                        echo strtoupper($fileExt) . ' File';
                        ?>
                    </div>
                    <div class="secondary-preview">
                        <?php
                        if (file_exists($project['file_path'])) {
                            echo number_format(filesize($project['file_path']) / 1024 / 1024, 1) . ' MB';
                        } else {
                            echo 'File Size';
                        }
                        ?>
                    </div>
                    <div class="secondary-preview">
                        Created: <?php echo date('M Y', strtotime($project['created_at'])); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="description-section">
            <h2 class="section-title">Abstract</h2>
            <div class="description-text">
                <?php echo nl2br($view->escape($project['description'])); ?>
            </div>

            <?php if (!empty($project['keywords'])): ?>
                <h3 style="margin-top: 25px; margin-bottom: 15px; color: #333;">Keywords</h3>
                <div class="keywords">
                    <?php
                    $keywords = explode(',', $project['keywords']);
                    foreach ($keywords as $keyword):
                        $keyword = trim($keyword);
                        if (!empty($keyword)):
                    ?>
                            <span class="keyword-tag"><?php echo $view->escape($keyword); ?></span>
                    <?php
                        endif;
                    endforeach;
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Metadata Section -->
        <div class="metadata-section">
            <h2 class="section-title">Document Information</h2>
            <div class="metadata-grid">
                <div class="metadata-item">
                    <i class="bi bi-building" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                    <div class="metadata-label">Institution</div>
                    <div class="metadata-value">University Digital Library</div>
                </div>

                <?php if (isset($project['specialization_name'])): ?>
                    <div class="metadata-item">
                        <i class="bi bi-bookmark" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                        <div class="metadata-label">Specialization</div>
                        <div class="metadata-value"><?php echo $view->escape($project['specialization_name']); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (isset($project['supervisor'])): ?>
                    <div class="metadata-item">
                        <i class="bi bi-person-check" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                        <div class="metadata-label">Supervisor</div>
                        <div class="metadata-value"><?php echo $view->escape($project['supervisor']); ?></div>
                    </div>
                <?php endif; ?>

                <div class="metadata-item">
                    <i class="bi bi-calendar-event" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                    <div class="metadata-label">Publication Year</div>
                    <div class="metadata-value"><?php echo $view->escape($project['year']); ?></div>
                </div>

                <div class="metadata-item">
                    <i class="bi bi-file-earmark" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                    <div class="metadata-label">Format</div>
                    <div class="metadata-value"><?php echo strtoupper(pathinfo($project['file_path'], PATHINFO_EXTENSION)); ?></div>
                </div>

                <div class="metadata-item">
                    <i class="bi bi-hdd" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                    <div class="metadata-label">File Size</div>
                    <div class="metadata-value">
                        <?php
                        if (file_exists($project['file_path'])) {
                            echo number_format(filesize($project['file_path']) / 1024 / 1024, 1) . ' MB';
                        } else {
                            echo 'N/A';
                        }
                        ?>
                    </div>
                </div>

                <div class="metadata-item">
                    <i class="bi bi-clock" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                    <div class="metadata-label">Uploaded</div>
                    <div class="metadata-value"><?php echo date('M d, Y', strtotime($project['created_at'])); ?></div>
                </div>

                <div class="metadata-item">
                    <i class="bi bi-check-circle" style="color: #b52626; font-size: 20px; margin-bottom: 8px;"></i>
                    <div class="metadata-label">Status</div>
                    <div class="metadata-value">
                        <span class="badge <?php echo $project['status'] === 'approved' ? 'bg-success' : 'bg-warning'; ?>">
                            <?php echo ucfirst($view->escape($project['status'])); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-reviews-section">
            <h2 class="section-title">Comments & Discussion</h2>

            <?php if ($user): ?>
                <div class="add-comment" style="margin-bottom: 30px;">
                    <form method="POST" action="/projects/<?php echo $project['id']; ?>/comment">
                        <textarea class="comment-input" name="comment" placeholder="Share your thoughts about this project..." required></textarea>
                        <button type="submit" class="submit-comment">Post Comment</button>
                    </form>
                </div>
            <?php else: ?>
                <div style="text-align: center; margin: 20px 0; padding: 20px; background: #f9f9f9; border-radius: 8px;">
                    <p style="color: #666; margin-bottom: 10px;">Join the discussion</p>
                    <a href="/login" style="color: #b52626; text-decoration: none; font-weight: 500;">
                        Login to post comments
                    </a>
                </div>
            <?php endif; ?>

            <!-- Sample Comments (you can replace with actual comment system) -->
            <div class="comments-list">
                <div class="comment">
                    <div class="comment-author">Academic Community</div>
                    <div class="comment-text">This project demonstrates excellent research methodology and contributes valuable insights to the field.</div>
                </div>
                <div class="comment">
                    <div class="comment-author">Research Team</div>
                    <div class="comment-text">Well-structured document with clear objectives and comprehensive analysis. Great resource for fellow researchers.</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Download Section -->
        <div class="sidebar-section download-section">
            <div class="sidebar-header">Download Options</div>
            <div class="sidebar-content">
                <?php if ($project['status'] === 'approved' || ($user && $user['id'] == $project['user_id'])): ?>
                    <a href="/projects/download/<?php echo $project['id']; ?>" class="download-btn">
                        <i class="bi bi-download"></i>
                        Download <?php echo strtoupper(pathinfo($project['file_path'], PATHINFO_EXTENSION)); ?>
                    </a>
                <?php else: ?>
                    <button class="download-btn" style="background: #ccc; cursor: not-allowed;" disabled>
                        <i class="bi bi-lock"></i>
                        Pending Approval
                    </button>
                <?php endif; ?>

                <?php if ($user): ?>
                    <button class="download-btn" style="background: #555;" onclick="saveToLibrary(<?php echo $project['id']; ?>)">
                        <i class="bi bi-bookmark"></i>
                        Save to Library
                    </button>
                <?php endif; ?>

                <div class="download-info">
                    <p>
                        <?php if ($project['status'] === 'approved'): ?>
                            Free download • No registration required
                        <?php else: ?>
                            Awaiting approval for public access
                        <?php endif; ?>
                    </p>
                    <p>Uploaded: <?php echo date('M Y', strtotime($project['created_at'])); ?></p>
                    <?php if (file_exists($project['file_path'])): ?>
                        <p>File size: <?php echo number_format(filesize($project['file_path']) / 1024 / 1024, 1); ?> MB</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Author Info -->
        <div class="sidebar-section">
            <div class="sidebar-header">Author Information</div>
            <div class="sidebar-content">
                <div style="text-align: center; padding: 10px 0;">
                    <i class="bi bi-person-circle" style="font-size: 48px; color: #b52626; margin-bottom: 10px;"></i>
                    <h4 style="margin: 0; color: #333;"><?php echo $view->escape($project['author_name']); ?></h4>
                    <?php if (isset($project['user_name'])): ?>
                        <p style="color: #666; font-size: 14px; margin: 5px 0;">
                            Uploaded by: <?php echo $view->escape($project['user_name']); ?>
                        </p>
                    <?php endif; ?>
                    <p style="color: #666; font-size: 14px; margin: 5px 0;">
                        Year: <?php echo $view->escape($project['year']); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Related Documents -->
        <div class="sidebar-section">
            <div class="sidebar-header">Related Documents</div>
            <div class="sidebar-content">
                <?php if (isset($relatedProjects) && !empty($relatedProjects)): ?>
                    <?php foreach ($relatedProjects as $related): ?>
                        <div class="related-item">
                            <div class="related-thumbnail">
                                <?php echo strtoupper(pathinfo($related['file_path'], PATHINFO_EXTENSION)); ?>
                            </div>
                            <div class="related-info">
                                <div class="related-title">
                                    <a href="/projects/<?php echo $related['id']; ?>" style="color: #333; text-decoration: none;">
                                        <?php echo $view->escape(strlen($related['title']) > 60 ? substr($related['title'], 0, 60) . '...' : $related['title']); ?>
                                    </a>
                                </div>
                                <div class="related-meta">
                                    <?php echo $view->escape($related['author_name']); ?> •
                                    <?php echo $view->escape($related['year']); ?> •
                                    <?php echo $view->escape($related['specialization_name'] ?? 'General'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="text-align: center; color: #666; padding: 20px 0;">
                        <i class="bi bi-search" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                        <p style="margin: 0; font-size: 14px;">No related documents found</p>
                        <a href="/projects" style="color: #b52626; text-decoration: none; font-size: 14px;">
                            Browse all projects
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(evt, tabName) {
        // Hide all tab content
        var tabcontent = document.getElementsByClassName("tab-content");
        for (var i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.remove("active");
        }

        // Remove active class from all tabs
        var tabs = document.getElementsByClassName("tab");
        for (var i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
        }

        // Show selected tab and mark as active
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    function saveToLibrary(projectId) {
        // Implement save to library functionality
        fetch('/projects/' + projectId + '/save', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Project saved to your library!');
                } else {
                    alert('Error saving project. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving project. Please try again.');
            });
    }
</script>

<style>
    /* Additional responsive styles */
    @media (max-width: 1024px) {
        .main-container {
            grid-template-columns: 1fr;
            max-width: 100%;
        }

        .sidebar {
            order: -1;
            margin-bottom: 20px;
        }

        .sidebar .sidebar-section {
            margin-bottom: 15px;
        }
    }

    @media (max-width: 768px) {
        .document-meta {
            flex-direction: column;
            gap: 10px;
        }

        .preview-images {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .secondary-previews {
            flex-direction: row;
            gap: 10px;
        }

        .metadata-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }

        .main-container {
            margin: 10px;
            padding: 0 10px;
        }
    }

    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .bg-success {
        background-color: #28a745;
        color: white;
    }

    .bg-warning {
        background-color: #ffc107;
        color: #212529;
    }
</style>