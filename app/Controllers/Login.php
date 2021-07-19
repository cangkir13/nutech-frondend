<?php

namespace App\Controllers;


class Login extends BaseController
{
	
	public function __construct()
	{
		helper('form');
		$this->logged = session()->get('logged_in');
		if ($this->logged) {
			return redirect('/');
		}
	}

	public function index()
	{
		$data = [
			'title' => 'Login',
			'page_title' => 'Login'
		];
		return view('pages/login', $data);
	}

	public function proses_login()
	{
		$validation = $this->validate([
			'email'	=> 'required|valid_email',
			'password' => 'required',
		]);
        $varible = $this->request->getVar();
		if (!$validation) {
			$input = \Config\Services::validation();
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput()->with('inputan', $input);
		}

        $varible = $this->request->getVar();
    
        $client = \Config\Services::curlrequest();
        $response = $client->request('POST', $this->urlserver.'login', [
            'json' => $varible,
            'http_errors' => false
        ]);

        $body = $response->getBody();
        $status = $response->getStatusCode();
        // dd($status);
        if ($status != 200) {
            $input = \Config\Services::validation();
            session()->setFlashdata('error', $body);
            return redirect()->back()->withInput()->with('inputan', $input);
        } else {
			$data = json_decode($body);
			
			session()->setFlashdata('success', 'Welcom back');
			session()->set([
				'logged_in' => true,
				'token' => $data->type . " ". $data->token
			]);
			return redirect()->to('/');
		}
	}

	public function logout()
	{
		session()->destroy();
        return redirect()->to('/login');
	}
}
