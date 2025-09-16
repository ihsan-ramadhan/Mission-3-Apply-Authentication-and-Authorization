<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['entry_year', 'user_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getStudentWithUser($student_id = null)
    {
        $sql = "SELECT s.*, u.username, u.full_name, u.role 
                FROM students s 
                JOIN users u ON s.user_id = u.user_id";
        
        if ($student_id) {
            $sql .= " WHERE s.student_id = ?";
            return $this->db->query($sql, [$student_id])->getRowArray();
        }
        
        $sql .= " ORDER BY s.student_id";
        return $this->db->query($sql)->getResultArray();
    }

    public function getStudentByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->first();
    }
}