<?php

namespace App\Models;

use CodeIgniter\Model;

class TakesModel extends Model
{
    protected $table = 'takes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_id', 'course_id', 'enroll_date'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function enrollCourse($student_id, $course_id)
    {
        // Check if already enrolled
        $existing = $this->where(['student_id' => $student_id, 'course_id' => $course_id])->first();
        
        if ($existing) {
            return false; // Already enrolled
        }
        
        // Insert without using CodeIgniter timestamps since takes table doesn't have updated_at
        $data = [
            'student_id' => $student_id,
            'course_id' => $course_id,
            'enroll_date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        return $this->db->table($this->table)->insert($data);
    }

    public function getStudentCourses($student_id)
    {
        $sql = "SELECT t.*, c.course_name, c.credits, t.enroll_date
                FROM takes t 
                JOIN courses c ON t.course_id = c.course_id 
                WHERE t.student_id = ?
                ORDER BY t.enroll_date DESC";
                
        return $this->db->query($sql, [$student_id])->getResultArray();
    }

    public function unenrollCourse($student_id, $course_id)
    {
        return $this->where(['student_id' => $student_id, 'course_id' => $course_id])->delete();
    }
}