<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\StudentModel;

class Student extends BaseController
{
    protected $userModel;
    protected $studentModel;
    
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        // Only admin can access student management
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $data = [
            'title' => 'Manage Students',
            'students' => $this->studentModel->getStudentWithUser()
        ];

        return view('student/index', $data);
    }

    public function create()
    {
        // Only admin can create students
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        if ($this->request->getMethod() === 'POST') {
            // Create user first
            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'role' => 'student',
                'full_name' => $this->request->getPost('full_name')
            ];

            // Validasi sederhana
            if (empty($userData['username']) || empty($userData['password']) || empty($userData['full_name'])) {
                return redirect()->back()->with('error', 'Semua field harus diisi!');
            }

            // Check if username already exists
            $existingUser = $this->userModel->where('username', $userData['username'])->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'Username sudah digunakan!');
            }

            $userId = $this->userModel->createUser($userData);

            if ($userId) {
                // Create student record
                $studentData = [
                    'entry_year' => $this->request->getPost('entry_year'),
                    'user_id' => $userId
                ];
                
                if ($this->studentModel->insert($studentData)) {
                    return redirect()->to('/student')->with('success', 'Student berhasil ditambahkan!');
                } else {
                    // Delete user if student creation fails
                    $this->userModel->delete($userId);
                    return redirect()->back()->with('error', 'Gagal menambahkan student!');
                }
            } else {
                return redirect()->back()->with('error', 'Gagal membuat user!');
            }
        }

        $data = [
            'title' => 'Tambah Student Baru'
        ];

        return view('student/create', $data);
    }

    public function edit($student_id)
    {
        // Only admin can edit students
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $student = $this->studentModel->getStudentWithUser($student_id);
        
        if (!$student) {
            return redirect()->to('/student')->with('error', 'Student tidak ditemukan!');
        }

        if ($this->request->getMethod() === 'POST') {
            // Update user data
            $userData = [
                'username' => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name')
            ];

            // Update password only if provided
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Check if username already exists (except current user)
            $existingUser = $this->userModel->where('username', $userData['username'])
                                          ->where('user_id !=', $student['user_id'])
                                          ->first();
            if ($existingUser) {
                return redirect()->back()->with('error', 'Username sudah digunakan!');
            }

            // Update user
            if ($this->userModel->update($student['user_id'], $userData)) {
                // Update student data
                $studentData = [
                    'entry_year' => $this->request->getPost('entry_year')
                ];
                
                if ($this->studentModel->update($student_id, $studentData)) {
                    return redirect()->to('/student')->with('success', 'Student berhasil diupdate!');
                }
            }
            
            return redirect()->back()->with('error', 'Gagal mengupdate student!');
        }

        $data = [
            'title' => 'Edit Student',
            'student' => $student
        ];

        return view('student/edit', $data);
    }

    public function delete($student_id)
    {
        // Only admin can delete students
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $student = $this->studentModel->find($student_id);
        
        if (!$student) {
            return redirect()->to('/student')->with('error', 'Student tidak ditemukan!');
        }

        // Delete student (will cascade delete user due to foreign key)
        if ($this->studentModel->delete($student_id)) {
            // Also delete the user
            $this->userModel->delete($student['user_id']);
            return redirect()->to('/student')->with('success', 'Student berhasil dihapus!');
        } else {
            return redirect()->to('/student')->with('error', 'Gagal menghapus student!');
        }
    }

    public function view($student_id)
    {
        // Only admin can view student details
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $student = $this->studentModel->getStudentWithUser($student_id);
        
        if (!$student) {
            return redirect()->to('/student')->with('error', 'Student tidak ditemukan!');
        }

        // Get enrolled courses for this student
        $takesModel = new \App\Models\TakesModel();
        $enrolledCourses = $takesModel->getStudentCourses($student_id);

        $data = [
            'title' => 'Detail Student',
            'student' => $student,
            'enrolled_courses' => $enrolledCourses
        ];

        return view('student/view', $data);
    }
}