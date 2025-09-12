<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Specialization.php';

class UserController extends Controller
{
    public function profile(): void
    {
        $this->requireAuth();
        
        $user = $this->getCurrentUser();
        $specializationModel = new Specialization();
        $specialization = $specializationModel->findById($user['specialization_id']);
        
        $this->render('user/profile', [
            'title' => 'My Profile',
            'user' => $user,
            'specialization' => $specialization
        ]);
    }

    public function editProfile(): void
    {
        $this->requireAuth();
        
        $user = $this->getCurrentUser();
        
        if ($this->handleFormSubmission()) {
            $data = $this->validator->sanitize($_POST);
            
            $rules = [
                'full_name' => ['required', ['max', 100]],
                'username' => ['required', ['min', 3], ['max', 50]],
                'email' => ['required', 'email'],
                'specialization_id' => ['required']
            ];
            
            // Check uniqueness excluding current user
            if ($data['username'] !== $user['username']) {
                $rules['username'][] = ['unique', 'users'];
            }
            if ($data['email'] !== $user['email']) {
                $rules['email'][] = ['unique', 'users'];
            }
            
            // Add password validation if provided
            if (!empty($data['password'])) {
                $rules['password'] = ['required', ['min', 8]];
            }
            
            if ($this->validator->validate($data, $rules)) {
                $updateData = [
                    'full_name' => $data['full_name'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'specialization_id' => $data['specialization_id']
                ];
                
                if (!empty($data['password'])) {
                    $updateData['password_hash'] = password_hash($data['password'], PASSWORD_DEFAULT);
                }
                
                $userModel = new User();
                $userModel->update($user['id'], $updateData);
                
                $this->session->setFlash('success', 'Profile updated successfully!');
                $this->redirect('/profile');
            } else {
                $this->session->setFlash('errors', $this->validator->getErrors());
            }
        }
        
        $specializationModel = new Specialization();
        $specializations = $specializationModel->findAll();
        
        $this->render('user/edit-profile', [
            'title' => 'Edit Profile',
            'user' => $user,
            'specializations' => $specializations
        ]);
    }
}