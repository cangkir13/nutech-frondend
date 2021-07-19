<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\ResponseInterface;

class HomeAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(is_null(session()->get('logged_in')))
        {
            session()->setFlashdata('error', "Login dulu");
            return redirect()->to('/login');
        }   
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}