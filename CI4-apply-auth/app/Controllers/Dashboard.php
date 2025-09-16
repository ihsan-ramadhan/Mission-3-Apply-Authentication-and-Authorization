<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\TakesModel;
use App\Models\StudentModel;

class Dashboard extends BaseController
{
    protected $courseModel;
    protected $takesModel;
    protected $studentModel;
    
    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->takesModel = new TakesModel();
        $this->studentModel = new StudentModel();
    }

    public function index()
    {
        // Check if logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $role = session()->get('role');
        
        if ($role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        $data = [
            'title' => 'Admin Dashboard',
            'courses' => $this->courseModel->findAll(),
            'students' => $this->studentModel->getStudentWithUser()
        ];
        
        return view('dashboard/admin', $data);
    }

    private function studentDashboard()
    {
        $student_id = session()->get('student_id');
        
        $data = [
            'title' => 'Student Dashboard',
            'available_courses' => $this->courseModel->getAllCoursesForStudent($student_id),
            'enrolled_courses' => $this->takesModel->getStudentCourses($student_id)
        ];
        
        return view('dashboard/student', $data);
    }
}