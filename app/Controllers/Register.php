<?php

namespace App\Controllers;


class Register extends BaseController
{
	
	public function __construct()
	{
		helper('form');
        $this->route = 'register';
	}

	public function index()
	{
		$data = [
            'route' => $this->route,
			'title' => 'Register',
			'page_title' => 'Register',
			'inputan' => \Config\Services::validation()
		];
		return view('pages/register', $data);
	}

	public function store()
	{
		$validation = $this->validate([
			'email'	=> 'required|valid_email',
			'username' => 'required',
			'password' => 'required',
			'password_confirmation' => 'required|matches[password]'
		]);
        
		if (!$validation) {
			$input = \Config\Services::validation();
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput()->with('inputan', $input);
		} else {
			
            $varible = $this->request->getVar();
            unset($varible['csrf_test_name']);
        
            $client = \Config\Services::curlrequest();
            $response = $client->request('POST', 'http://localhost:3000/api/register', [
                'json' => $varible,
                'http_errors' => false
            ]);

            $body = $response->getBody();
            $status = $response->getStatusCode();
            
            if ($status != 201) {
                $input = \Config\Services::validation();
                session()->setFlashdata('error', $body);
                return redirect()->back()->withInput()->with('inputan', $input);
            } 
            session()->setFlashdata('success', 'Data has been created');
			return redirect()->back();
		}
	}
}
