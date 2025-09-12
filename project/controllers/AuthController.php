<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    public function login(): void
    {
        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);
            
            if ($this->validator->validate($data, [
                'email' => ['required', 'email'],
                'password' => ['required']
            ])) {
                $userModel = new User();
                $user = $userModel->findByEmail($data['email']);
                
                if ($user && password_verify($data['password'], $user['password_hash'])) {
                    $this->session->set('user_id', $user['id']);
                    $this->session->regenerateId();
                    
                    $this->redirect('/projects/dashboard');
                } else {
                    $this->session->setFlash('errors', ['Invalid email or password.']);
                }
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }
        
        $this->render('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function register(): void
    {
        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);
            
            if ($this->validator->validate($data, [
                'full_name' => ['required', ['max', 100]],
                'username' => ['required', ['min', 3], ['max', 50], ['unique', 'users']],
                'email' => ['required', 'email', ['unique', 'users']],
                'password' => ['required', ['min', 8]],
                'specialization_id' => ['required']
            ])) {
                $userModel = new User();
                $userId = $userModel->create([
                    'full_name' => $data['full_name'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
                    'specialization_id' => $data['specialization_id'],
                    'role' => 'student'
                ]);
                
                $this->session->set('user_id', $userId);
                $this->session->setFlash('success', 'Account created successfully!');
                $this->redirect('/projects/dashboard');
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }
        
        $specializationModel = new Specialization();
        $specializations = $specializationModel->findAll();
        
        $this->render('auth/register', [
            'title' => 'Register',
            'specializations' => $specializations
        ]);
    }

    public function logout(): void
    {
        $this->session->destroy();
        $this->redirect('/');
    }
}