<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../models/Specialization.php';

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->requireRole('admin');
    }

    public function index(): void
    {
        $userModel = new User();
        $projectModel = new Project();

        $stats = [
            'total_users' => $userModel->count(),
            'total_projects' => $projectModel->count(),
            'pending_projects' => $projectModel->countByStatus('pending'),
            'recent_projects' => $projectModel->getRecent(5)
        ];

        $this->render('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'stats' => $stats
        ]);
    }

    // USERS MANAGEMENT
    public function users(): void
    {
        $userModel = new User();
        $page = (int)($_GET['page'] ?? 1);

        $users = $userModel->paginate($page, 20);

        $this->render('admin/users', [
            'title' => 'Manage Users',
            'users' => $users
        ]);
    }

    public function editUser(int $id): void
    {
        $userModel = new User();
        $specializationModel = new Specialization();

        $userSelected = $userModel->findById($id);
        // echo "<pre>";
        // print_r($userSelected);
        // echo "</pre>";
        // die();
        if (!$userSelected) {
            $this->session->setFlash('errors', ['User not found.']);
            $this->redirect('/admin/users');
        }

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            $rules = [
                'username' => ['required', ['max', 50]],
                'email' => ['required', 'email', ['max', 100]],
                'full_name' => ['required', ['max', 100]],
                'role' => ['required'],
                'specialization_id' => []
            ];

            // Check for unique constraints excluding current user
            if ($data['username'] !== $userSelected['username']) {
                if ($userModel->findByUsername($data['username'])) {
                    $this->validator->getErrors()['username'][] = 'Username is already taken.';
                }
            }

            if ($data['email'] !== $userSelected['email']) {
                if ($userModel->findByEmail($data['email'])) {
                    $this->validator->getErrors()['email'][] = 'Email is already taken.';
                }
            }

            if ($this->validator->validate($data, $rules) && empty($this->validator->getErrors())) {
                // Handle password update
                if (!empty($data['password'])) {
                    $data['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                unset($data['password'], $data['password_confirmation']);

                // Convert empty specialization_id to null
                if (empty($data['specialization_id'])) {
                    $data['specialization_id'] = null;
                }

                if ($userModel->update($id, $data)) {
                    $this->session->setFlash('success', 'User updated successfully!');
                    $this->redirect('/admin/users');
                } else {
                    $this->session->setFlash('errors', ['Failed to update user.']);
                }
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $specializations = $specializationModel->findAll();

        $this->render('admin/edit-user', [
            'title' => 'Edit User',
            'userSelected' => $userSelected,
            'specializations' => $specializations
        ]);
    }

    public function deleteUser(int $id): void
    {
        $userModel = new User();

        $user = $userModel->findById($id);
        if (!$user) {
            $this->session->setFlash('errors', ['User not found.']);
            $this->redirect('/admin/users');
        }

        // Prevent deleting admin users
        if ($user['role'] === 'admin') {
            $this->session->setFlash('errors', ['Cannot delete admin users.']);
            $this->redirect('/admin/users');
        }

        if ($userModel->delete($id)) {
            $this->session->setFlash('success', 'User deleted successfully!');
        } else {
            $this->session->setFlash('errors', ['Failed to delete user.']);
        }

        $this->redirect('/admin/users');
    }

    // SPECIALIZATIONS MANAGEMENT
    public function specializations(): void
    {
        $specializationModel = new Specialization();

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'name' => ['required', ['max', 100]],
                'faculty' => ['required', ['max', 100]],
                'description' => ['required']
            ])) {
                $specializationModel->create($data);
                $this->session->setFlash('success', 'Specialization added successfully!');
                $this->redirect('/admin/specializations');
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $specializations = $specializationModel->findAll();

        $this->render('admin/specializations', [
            'title' => 'Manage Specializations',
            'specializations' => $specializations
        ]);
    }

    public function editSpecialization(int $id): void
    {
        $specializationModel = new Specialization();

        $specialization = $specializationModel->findById($id);
        if (!$specialization) {
            $this->session->setFlash('errors', ['Specialization not found.']);
            $this->redirect('/admin/specializations');
        }

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'name' => ['required', ['max', 100]],
                'faculty' => ['required', ['max', 100]],
                'description' => ['required']
            ])) {
                if ($specializationModel->update($id, $data)) {
                    $this->session->setFlash('success', 'Specialization updated successfully!');
                    $this->redirect('/admin/specializations');
                } else {
                    $this->session->setFlash('errors', ['Failed to update specialization.']);
                }
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $this->render('admin/edit-specialization', [
            'title' => 'Edit Specialization',
            'specialization' => $specialization
        ]);
    }

    public function deleteSpecialization(int $id): void
    {
        $specializationModel = new Specialization();

        $specialization = $specializationModel->findById($id);
        if (!$specialization) {
            $this->session->setFlash('errors', ['Specialization not found.']);
            $this->redirect('/admin/specializations');
        }

        if ($specializationModel->delete($id)) {
            $this->session->setFlash('success', 'Specialization deleted successfully!');
        } else {
            $this->session->setFlash('errors', ['Failed to delete specialization.']);
        }

        $this->redirect('/admin/specializations');
    }

    // PROJECTS MANAGEMENT
    public function adminProjects(): void
    {
        $this->requireRole('admin');

        $projectModel = new Project();
        $page = (int)($_GET['page'] ?? 1);
        $status = $_GET['status'] ?? 'all';

        $conditions = [];
        if ($status !== 'all') {
            $conditions['status'] = $status;
        }

        $projects = $projectModel->paginate($page, 20, $conditions);

        $this->render('admin/projects', [
            'title' => 'Manage Projects',
            'projects' => $projects,
            'current_status' => $status
        ]);
    }

    public function editProject(int $id): void
    {
        $this->requireRole('admin');

        $projectModel = new Project();
        $specializationModel = new Specialization();
        $categoryModel = new Category();

        $project = $projectModel->findById($id);
        if (!$project) {
            $this->session->setFlash('errors', ['Project not found.']);
            $this->redirect('/admin/projects');
        }

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'title' => ['required', ['max', 255]],
                'description' => ['required'],
                'author_name' => ['required', ['max', 100]],
                'supervisor' => ['required', ['max', 100]],
                'specialization_id' => ['required'],
                'year' => ['required'],
                'status' => ['required']
            ])) {
                if ($projectModel->update($id, $data)) {
                    // Handle category updates
                    if (isset($_POST['categories'])) {
                        $categoryModel->attachToProject($id, $_POST['categories']);
                    }

                    $this->session->setFlash('success', 'Project updated successfully!');
                    $this->redirect('/admin/projects');
                } else {
                    $this->session->setFlash('errors', ['Failed to update project.']);
                }
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $specializations = $specializationModel->findAll();
        $categories = $categoryModel->findAll();
        $projectCategories = $categoryModel->getProjectCategories($id);

        $this->render('admin/edit-project', [
            'title' => 'Edit Project',
            'project' => $project,
            'specializations' => $specializations,
            'categories' => $categories,
            'project_categories' => array_column($projectCategories, 'id')
        ]);
    }

    public function deleteProject(int $id): void
    {
        $this->requireRole('admin');

        $projectModel = new Project();

        $project = $projectModel->findById($id);
        if (!$project) {
            $this->session->setFlash('errors', ['Project not found.']);
            $this->redirect('/admin/projects');
        }

        // Delete associated files
        if ($project['file_path'] && file_exists(BASE_PATH . "/" . $project['file_path'])) {
            unlink(BASE_PATH . "/" . $project['file_path']);
        }

        if ($project['image_path'] && $project['image_path'] !== '/images/default-project.png' && file_exists(BASE_PATH . "/" . $project['image_path'])) {
            unlink(BASE_PATH . "/" . $project['image_path']);
        }

        if ($projectModel->delete($id)) {
            $this->session->setFlash('success', 'Project deleted successfully!');
        } else {
            $this->session->setFlash('errors', ['Failed to delete project.']);
        }

        $this->redirect('/admin/projects');
    }

    public function approveProject(int $id): void
    {
        $this->requireRole('admin');

        $projectModel = new Project();

        if ($projectModel->update($id, ['status' => 'approved'])) {
            $this->session->setFlash('success', 'Project approved successfully!');
        } else {
            $this->session->setFlash('errors', ['Failed to approve project.']);
        }

        $this->redirect('/admin/projects');
    }

    public function rejectProject(int $id): void
    {
        $this->requireRole('admin');

        $projectModel = new Project();

        if ($projectModel->update($id, ['status' => 'rejected'])) {
            $this->session->setFlash('success', 'Project rejected.');
        } else {
            $this->session->setFlash('errors', ['Failed to reject project.']);
        }

        $this->redirect('/admin/projects');
    }


    // CATEGORIES MANAGEMENT

    // Add these methods to the DashboardController class

    public function categories(): void
    {
        $categoryModel = new Category();

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'name' => ['required', ['max', 100]],
                'description' => []
            ])) {
                $categoryModel->create($data);
                $this->session->setFlash('success', 'Category added successfully!');
                $this->redirect('/admin/categories');
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $categories = $categoryModel->findAll();

        $this->render('admin/categories', [
            'title' => 'Manage Categories',
            'categories' => $categories
        ]);
    }

    public function editCategory(int $id): void
    {
        $categoryModel = new Category();

        $category = $categoryModel->findById($id);
        if (!$category) {
            $this->session->setFlash('errors', ['Category not found.']);
            $this->redirect('/admin/categories');
        }

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'name' => ['required', ['max', 100]],
                'description' => []
            ])) {
                if ($categoryModel->update($id, $data)) {
                    $this->session->setFlash('success', 'Category updated successfully!');
                    $this->redirect('/admin/categories');
                } else {
                    $this->session->setFlash('errors', ['Failed to update category.']);
                }
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $this->render('admin/edit-category', [
            'title' => 'Edit Category',
            'category' => $category
        ]);
    }

    public function deleteCategory(int $id): void
    {
        $categoryModel = new Category();

        $category = $categoryModel->findById($id);
        if (!$category) {
            $this->session->setFlash('errors', ['Category not found.']);
            $this->redirect('/admin/categories');
        }

        if ($categoryModel->delete($id)) {
            $this->session->setFlash('success', 'Category deleted successfully!');
        } else {
            $this->session->setFlash('errors', ['Failed to delete category.']);
        }

        $this->redirect('/admin/categories');
    }
}
