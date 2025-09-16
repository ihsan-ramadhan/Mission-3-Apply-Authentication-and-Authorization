<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'password', 'role', 'full_name'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function validateUser($username, $password)
    {
        try {
            $user = $this->where('username', $username)->first();
            
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            
            return false;
        } catch (\Exception $e) {
            log_message('error', 'Error validating user: ' . $e->getMessage());
            return false;
        }
    }

    public function createUser($data)
    {
        try {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            return $this->insert($data);
        } catch (\Exception $e) {
            log_message('error', 'Error creating user: ' . $e->getMessage());
            return false;
        }
    }
}   