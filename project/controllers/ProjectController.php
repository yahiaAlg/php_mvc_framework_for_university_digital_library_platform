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
        
        if (!$project) {
            throw new Exception('Project not found', 404);
        }
        
        $this->render('projects/detail', [
            'title' => $project['title'],
            'project' => $project
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
                
                // Handle new file upload if provided
                if (!empty($_FILES['project_file']['name'])) {
                    $uploadResult = $this->handleFileUpload();
                    if ($uploadResult['success']) {
                        $updateData['file_path'] = $uploadResult['file_path'];
                        // Delete old file
                        if (file_exists($project['file_path'])) {
                            unlink($project['file_path']);
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
            if (file_exists($project['file_path'])) {
                unlink($project['file_path']);
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
        
        if (!$project || !file_exists($project['file_path'])) {
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
        
        if (!isset($_FILES['project_file']) || $_FILES['project_file']['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Please select a file to upload.'];
        }
        
        $file = $_FILES['project_file'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $config['allowed_file_types'])) {
            return ['success' => false, 'error' => 'Invalid file type. Only PDF, DOC, and DOCX files are allowed.'];
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
}