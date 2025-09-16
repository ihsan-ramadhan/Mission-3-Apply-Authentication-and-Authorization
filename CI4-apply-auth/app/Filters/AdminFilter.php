<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }
        
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak! Hanya admin yang dapat mengakses halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}