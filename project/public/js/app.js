// Digital Library JavaScript Application

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initializeSearch();
    initializeFileUpload();
    initializeFormValidation();
    initializePagination();
    initializeTooltips();
});

// Search functionality
function initializeSearch() {
    const searchForm = document.querySelector('form[action="/projects"]');
    const searchInput = document.querySelector('input[name="search"]');
    
    if (searchForm && searchInput) {
        // Auto-submit search after typing stops
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length > 2 || this.value.length === 0) {
                    searchForm.submit();
                }
            }, 1000);
        });
    }
}

// File upload enhancements
function initializeFileUpload() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        const uploadZone = input.closest('.upload-zone');
        if (uploadZone) {
            setupDragAndDrop(input, uploadZone);
        }
        
        // File size validation
        input.addEventListener('change', function() {
            validateFileSize(this);
            validateFileType(this);
            showFilePreview(this);
        });
    });
}

function setupDragAndDrop(input, zone) {
    zone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    
    zone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });
    
    zone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            input.files = files;
            validateFileSize(input);
            validateFileType(input);
            showFilePreview(input);
        }
    });
    
    zone.addEventListener('click', function() {
        input.click();
    });
}

function validateFileSize(input) {
    const maxSize = 10 * 1024 * 1024; // 10MB
    const file = input.files[0];
    
    if (file && file.size > maxSize) {
        showAlert('File size too large. Maximum size is 10MB.', 'danger');
        input.value = '';
        return false;
    }
    return true;
}

function validateFileType(input) {
    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    const file = input.files[0];
    
    if (file && !allowedTypes.includes(file.type)) {
        showAlert('Invalid file type. Only PDF, DOC, and DOCX files are allowed.', 'danger');
        input.value = '';
        return false;
    }
    return true;
}

function showFilePreview(input) {
    const file = input.files[0];
    const preview = input.parentNode.querySelector('.file-preview');
    
    if (file && preview) {
        preview.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-text me-2"></i>
                <span>${file.name}</span>
                <small class="text-muted ms-2">(${formatFileSize(file.size)})</small>
            </div>
        `;
        preview.style.display = 'block';
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Form validation
function initializeFormValidation() {
    const forms = document.querySelectorAll('form[data-validate="true"]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
            }
        });
        
        // Real-time validation
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
        });
    });
}

function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function validateField(input) {
    const value = input.value.trim();
    const isRequired = input.hasAttribute('required');
    const type = input.getAttribute('type');
    
    // Clear previous errors
    clearFieldError(input);
    
    // Required validation
    if (isRequired && !value) {
        showFieldError(input, 'This field is required.');
        return false;
    }
    
    // Email validation
    if (type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            showFieldError(input, 'Please enter a valid email address.');
            return false;
        }
    }
    
    // Password validation
    if (type === 'password' && value) {
        if (value.length < 8) {
            showFieldError(input, 'Password must be at least 8 characters long.');
            return false;
        }
    }
    
    // Password confirmation
    if (input.name === 'password_confirmation') {
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput && value !== passwordInput.value) {
            showFieldError(input, 'Password confirmation does not match.');
            return false;
        }
    }
    
    return true;
}

function showFieldError(input, message) {
    const formGroup = input.closest('.mb-3') || input.parentNode;
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-danger small mt-1 field-error';
    errorDiv.textContent = message;
    
    formGroup.appendChild(errorDiv);
    input.classList.add('is-invalid');
}

function clearFieldError(input) {
    const formGroup = input.closest('.mb-3') || input.parentNode;
    const existingError = formGroup.querySelector('.field-error');
    
    if (existingError) {
        existingError.remove();
    }
    
    input.classList.remove('is-invalid');
}

// Pagination enhancements
function initializePagination() {
    const paginationLinks = document.querySelectorAll('.pagination .page-link');
    
    paginationLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Add loading state for page navigation
            this.classList.add('loading');
        });
    });
}

// Initialize Bootstrap tooltips
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

// Utility functions
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const container = document.querySelector('.container').firstElementChild;
    container.parentNode.insertBefore(alertDiv, container);
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Advanced search functionality
function toggleAdvancedSearch() {
    const advancedSection = document.getElementById('advanced-search');
    if (advancedSection) {
        advancedSection.classList.toggle('d-none');
    }
}

// Project card interactions
function initializeProjectCards() {
    const projectCards = document.querySelectorAll('.project-card');
    
    projectCards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON') {
                const link = this.querySelector('a[href*="/projects/"]');
                if (link) {
                    window.location.href = link.href;
                }
            }
        });
    });
}

// Initialize project cards when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initializeProjectCards();
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Back to top functionality
function addBackToTop() {
    const backToTopBtn = document.createElement('button');
    backToTopBtn.innerHTML = '<i class="bi bi-arrow-up"></i>';
    backToTopBtn.className = 'btn btn-primary position-fixed d-none';
    backToTopBtn.style.bottom = '2rem';
    backToTopBtn.style.right = '2rem';
    backToTopBtn.style.zIndex = '1000';
    backToTopBtn.title = 'Back to Top';
    
    document.body.appendChild(backToTopBtn);
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopBtn.classList.remove('d-none');
        } else {
            backToTopBtn.classList.add('d-none');
        }
    });
    
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// Initialize back to top when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    addBackToTop();
});