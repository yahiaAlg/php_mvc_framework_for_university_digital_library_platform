<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Project.php';
require_once __DIR__ . '/../models/Specialization.php';

class ProjectController extends Controller
{
    public function listings(): void
    {
        $projectModel = new Project();
        $specializationModel = new Specialization();

        $page = (int)($_GET['page'] ?? 1);
        $specializationId = $_GET['specialization'] ?? null;
        $search = $_GET['search'] ?? null;

        $conditions = [];
        if ($specializationId) {
            $conditions['specialization_id'] = $specializationId;
        }

        $projects = $projectModel->search($search, $conditions, $page);
        $specializations = $specializationModel->findAll();
        // echo "<pre>";
        // print_r($projects);
        // echo "</pre>";
        // die();
        $this->render('projects/listings', [
            'title' => 'Project Listings',
            'projects' => $projects,
            'specializations' => $specializations,
            'currentSpecialization' => $specializationId,
            'currentSearch' => $search
        ]);
    }

    public function detail(int $id): void
    {
        $projectModel = new Project();
        $project = $projectModel->findWithDetails($id);

        // echo '<pre>';
        // print_r(filesize(BASE_PATH . "/" . $project['file_path']));
        // echo '</pre>';
        // die();
        if (file_exists(BASE_PATH . "/" . $project['file_path'])) {
            $project_size = filesize(BASE_PATH . "/" . $project['file_path']) / 1024 / 1024;
        } else {
            $project_size = "";
        }
        // die($project_size);
        if (!$project) {
            throw new Exception('Project not found', 404);
        }

        $this->render('projects/detail', [
            'title' => $project['title'],
            'project' => $project,
            'project_size' => $project_size
        ]);
    }

    public function upload(): void
    {
        $this->requireAuth();

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'title' => ['required', ['max', 255]],
                'description' => ['required'],
                'author_name' => ['required', ['max', 100]],
                'supervisor' => ['required', ['max', 100]],
                'specialization_id' => ['required'],
                'year' => ['required'],
                'keywords' => ['required']
            ])) {
                // Handle file upload
                $uploadResult = $this->handleFileUpload();

                if ($uploadResult['success']) {
                    $projectModel = new Project();
                    $user = $this->getCurrentUser();

                    $projectModel->create([
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'author_name' => $data['author_name'],
                        'supervisor' => $data['supervisor'],
                        'specialization_id' => $data['specialization_id'],
                        'user_id' => $user['id'],
                        'image_path' => $uploadResult['image_path'],
                        'file_path' => $uploadResult['file_path'],
                        'year' => $data['year'],
                        'keywords' => $data['keywords'],
                        'status' => 'pending'
                    ]);

                    $this->session->setFlash('success', 'Project uploaded successfully!');
                    $this->redirect('/projects/dashboard');
                } else {
                    $this->session->setFlash('errors', [$uploadResult['error']]);
                }
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $specializationModel = new Specialization();
        $specializations = $specializationModel->findAll();

        $this->render('projects/upload', [
            'title' => 'Upload Project',
            'specializations' => $specializations
        ]);
    }

    public function dashboard(): void
    {
        $this->requireAuth();

        $projectModel = new Project();
        $user = $this->getCurrentUser();

        $page = (int)($_GET['page'] ?? 1);
        $projects = $projectModel->findByUser($user['id'], $page);

        $this->render('projects/dashboard', [
            'title' => 'My Projects',
            'projects' => $projects
        ]);
    }

    public function edit(int $id): void
    {
        $this->requireAuth();

        $projectModel = new Project();
        $project = $projectModel->findById($id);
        $user = $this->getCurrentUser();

        if (!$project || $project['user_id'] !== $user['id']) {
            throw new Exception('Project not found', 404);
        }

        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);

            if ($this->validator->validate($data, [
                'title' => ['required', ['max', 255]],
                'description' => ['required'],
                'author_name' => ['required', ['max', 100]],
                'supervisor' => ['required', ['max', 100]],
                'year' => ['required'],
                'keywords' => ['required']
            ])) {
                $updateData = [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'author_name' => $data['author_name'],
                    'supervisor' => $data['supervisor'],
                    'year' => $data['year'],
                    'keywords' => $data['keywords']
                ];

                // Handle file uploads separately
                $hasNewProjectFile = !empty($_FILES['project_file']['name']);
                $hasNewImageFile = !empty($_FILES['image_file']['name']);

                if ($hasNewProjectFile || $hasNewImageFile) {
                    // Create temporary files array for upload handling
                    $tempFiles = $_FILES;

                    // If only one file is being uploaded, handle it separately
                    if ($hasNewProjectFile && !$hasNewImageFile) {
                        $uploadResult = $this->handleSingleFileUpload('project_file');
                        if ($uploadResult['success']) {
                            $updateData['file_path'] = $uploadResult['file_path'];
                            // Delete old file
                            if (file_exists(BASE_PATH . "/" . $project['file_path'])) {
                                unlink(BASE_PATH . "/" . $project['file_path']);
                            }
                        } else {
                            $this->session->setFlash('errors', [$uploadResult['error']]);
                            return;
                        }
                    }

                    if ($hasNewImageFile && !$hasNewProjectFile) {
                        $uploadResult = $this->handleSingleFileUpload('image_file');
                        if ($uploadResult['success']) {
                            $updateData['image_path'] = $uploadResult['file_path'];
                            // Delete old image
                            if (file_exists(BASE_PATH . "/" . $project['image_path']) && $project['image_path'] !== '/images/default-project.png') {
                                unlink(BASE_PATH . "/" . $project['image_path']);
                            }
                        } else {
                            $this->session->setFlash('errors', [$uploadResult['error']]);
                            return;
                        }
                    }

                    // If both files are being uploaded
                    if ($hasNewProjectFile && $hasNewImageFile) {
                        $uploadResult = $this->handleFileUpload();
                        if ($uploadResult['success']) {
                            $updateData['file_path'] = $uploadResult['file_path'];
                            $updateData['image_path'] = $uploadResult['image_path'];

                            // Delete old files
                            if (file_exists(BASE_PATH . "/" . $project['file_path'])) {
                                unlink(BASE_PATH . "/" . $project['file_path']);
                            }
                            if (file_exists(BASE_PATH . "/" . $project['image_path']) && $project['image_path'] !== '/images/default-project.png') {
                                unlink(BASE_PATH . "/" . $project['image_path']);
                            }
                        } else {
                            $this->session->setFlash('errors', [$uploadResult['error']]);
                            return;
                        }
                    }
                }

                $projectModel->update($id, $updateData);

                $this->session->setFlash('success', 'Project updated successfully!');
                $this->redirect('/projects/dashboard');
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }

        $this->render('projects/edit', [
            'title' => 'Edit Project',
            'project' => $project
        ]);
    }

    private function handleSingleFileUpload(string $fileKey): array
    {
        global $app;
        $config = $app->getConfig('app');

        if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Please select a file to upload.'];
        }

        $file = $_FILES[$fileKey];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // Determine allowed types based on file key
        if ($fileKey === 'project_file') {
            $allowedTypes = ['pdf', 'doc', 'docx'];
            $errorMsg = 'Invalid file type. Only PDF, DOC, DOCX files are allowed.';
        } else {
            $allowedTypes = ['png', 'jpg', 'jpeg'];
            $errorMsg = 'Invalid image type. Only PNG, JPG, JPEG files are allowed.';
        }

        if (!in_array($fileExtension, $allowedTypes)) {
            return ['success' => false, 'error' => $errorMsg];
        }

        if ($file['size'] > $config['max_file_size']) {
            return ['success' => false, 'error' => 'File size too large. Maximum size is 10MB.'];
        }

        $uploadDir = __DIR__ . '/../' . $config['upload_path'];
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = uniqid() . '_' . time() . '.' . $fileExtension;
        $uploadPath = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return ['success' => true, 'file_path' => $config['upload_path'] . $filename];
        }

        return ['success' => false, 'error' => 'Failed to upload file.'];
    }

    public function delete(int $id): void
    {
        $this->requireAuth();

        $projectModel = new Project();
        $project = $projectModel->findById($id);
        $user = $this->getCurrentUser();

        if (!$project || $project['user_id'] !== $user['id']) {
            throw new Exception('Project not found', 404);
        }

        if ($this->handleFormSubmission()) {
            // Delete file
            if (file_exists(BASE_PATH . "/" . $project['file_path'])) {
                unlink(BASE_PATH . "/" . $project['file_path']);
            }
            if (file_exists(BASE_PATH . "/" . $project['image_path'])) {
                unlink(BASE_PATH . "/" . $project['image_path']);
            }

            $projectModel->delete($id);

            $this->session->setFlash('success', 'Project deleted successfully!');
            $this->redirect('/projects/dashboard');
        }

        $this->render('projects/delete', [
            'title' => 'Delete Project',
            'project' => $project
        ]);
    }

    public function download(int $id): void
    {
        $projectModel = new Project();
        $project = $projectModel->findById($id);

        if (!$project || !file_exists(BASE_PATH . "/" . $project['file_path'])) {
            throw new Exception('File not found', 404);
        }

        $filename = basename($project['file_path']);
        $filesize = filesize($project['file_path']);

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . $filesize);
        header('Cache-Control: must-revalidate');

        readfile($project['file_path']);
        exit;
    }

    private function handleFileUpload(): array
    {
        global $app;
        $config = $app->getConfig('app');

        // Check both files are present
        if (!isset($_FILES['project_file']) || $_FILES['project_file']['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Please select a project file to upload.'];
        }
        if (!isset($_FILES['image_file']) || $_FILES['image_file']['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Please select an image to upload.'];
        }

        $file = $_FILES['project_file'];
        $image = $_FILES['image_file'];

        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $imageExtension = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        // Validate file extensions
        $allowedFileTypes = ['pdf', 'doc', 'docx'];
        $allowedImageTypes = ['png', 'jpg', 'jpeg'];

        if (!in_array($fileExtension, $allowedFileTypes)) {
            return ['success' => false, 'error' => 'Invalid file type. Only PDF, DOC, DOCX files are allowed.'];
        }
        if (!in_array($imageExtension, $allowedImageTypes)) {
            return ['success' => false, 'error' => 'Invalid image type. Only PNG, JPG, JPEG files are allowed.'];
        }

        // Validate file sizes
        if ($file['size'] > $config['max_file_size']) {
            return ['success' => false, 'error' => 'File size too large. Maximum size is 10MB.'];
        }
        if ($image['size'] > $config['max_file_size']) {
            return ['success' => false, 'error' => 'Image size too large. Maximum size is 10MB.'];
        }

        $uploadDir = __DIR__ . '/../' . $config['upload_path'];
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Create unique filenames
        $filename = uniqid() . '_' . time() . '.' . $fileExtension;
        $imagename = uniqid() . '_' . time() . '.' . $imageExtension;

        $filePath = $uploadDir . $filename;
        $imagePath = $uploadDir . $imagename;

        // Upload both files
        $fileUploaded = move_uploaded_file($file['tmp_name'], $filePath);
        $imageUploaded = move_uploaded_file($image['tmp_name'], $imagePath);

        if ($fileUploaded && $imageUploaded) {
            return [
                'success' => true,
                'file_path' => $config['upload_path'] . $filename,
                'image_path' => $config['upload_path'] . $imagename
            ];
        }

        // Clean up if one failed
        if ($fileUploaded) unlink($filePath);
        if ($imageUploaded) unlink($imagePath);

        return ['success' => false, 'error' => 'Failed to upload files.'];
    }
}
