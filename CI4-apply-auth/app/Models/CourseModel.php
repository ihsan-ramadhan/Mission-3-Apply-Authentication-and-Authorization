<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $allowedFields = ['course_name', 'credits'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getAvailableCourses($student_id = null)
    {
        if ($student_id) {
            // Query untuk student: tampilkan semua courses dengan status enrollment
            $sql = "SELECT c.*, 
                           CASE WHEN t.student_id IS NOT NULL THEN 1 ELSE 0 END as is_enrolled
                    FROM courses c 
                    LEFT JOIN takes t ON c.course_id = t.course_id AND t.student_id = ?
                    ORDER BY c.course_name";
            
            return $this->db->query($sql, [$student_id])->getResultArray();
        } else {
            // Query untuk admin: tampilkan semua courses tanpa status enrollment
            return $this->findAll();
        }
    }

    public function getAllCoursesForStudent($student_id)
    {
        // Method alternatif jika query di atas masih bermasalah
        $courses = $this->findAll();
        $enrolledCourses = $this->db->table('takes')
                                  ->where('student_id', $student_id)
                                  ->get()
                                  ->getResultArray();
        
        $enrolledCourseIds = array_column($enrolledCourses, 'course_id');
        
        foreach ($courses as &$course) {
            $course['is_enrolled'] = in_array($course['course_id'], $enrolledCourseIds) ? 1 : 0;
        }
        
        return $courses;
    }
}