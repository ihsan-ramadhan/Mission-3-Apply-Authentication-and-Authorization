<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        // Jika belum login, redirect ke login
        return redirect()->to('/login');
    }
}