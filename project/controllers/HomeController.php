<?php

require_once __DIR__ . '/../core/Controller.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $projectModel = new Project();
        $specializationModel = new Specialization();
        
        // Get recent projects
        $recentProjects = $projectModel->getRecent(6);
        
        // Get all specializations for search
        $specializations = $specializationModel->findAll();
        
        $this->render('home/index', [
            'title' => 'Welcome to Digital Library',
            'recentProjects' => $recentProjects,
            'specializations' => $specializations
        ]);
    }

    public function about(): void
    {
        $this->render('about/index', [
            'title' => 'About Digital Library'
        ]);
    }
}