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
}