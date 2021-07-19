<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	public function __construct()
	{
		helper('form');
		$this->token = session()->get('token');
	}

	public function index()
	{
		// echo session()->get('token');
		$token = $this->token;
		$api = $this->getdata($token);
		$data = [
			'products' => array_reverse($api),
			'page_titile' => 'Home',
		];
		return view('pages/home', $data);
	}

	public function getdata($token)
	{
		$client = \Config\Services::curlrequest();
        $response = $client->request('GET', $this->urlserver.'product', [
            'http_errors' => false,
			'headers' => [
				'Authorization' => $token
			]
        ]);

        $body = $response->getBody();
        $status = $response->getStatusCode();

		if ($status != 200) {
			return false;
		}	
		$data = json_decode($body);
		return $data->result;
	}

	public function create()
	{
		$validation = $this->validate([
			'name'	=> 'required',
			'price_buy' => 'required|integer',
			'price_sell' => 'required|integer',
			'stok' => 'required|integer',
			'image' => 'uploaded[image]|is_image[image]'
		]);
        
		if (!$validation) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		} else {

			$varible = [
				'name' => $this->request->getVar('name'),
				'price_buy' => $this->request->getVar('price_buy'),
				'price_sell' => $this->request->getVar('price_sell'),
				'stok' => $this->request->getVar('stok'),
				'image' => new \CURLFile($this->request->getFile('image')),
			];
			
			$client = \Config\Services::curlrequest();
			$response = $client->request('POST', $this->urlserver.'product', [
				'multipart' => $varible,
				'http_errors' => false,
				'headers' => [
					'Authorization' => $this->token
				]
			]);
			
			$body = $response->getBody();
			$status = $response->getStatusCode();
			if ($status != 200) {
				$input = \Config\Services::validation();
				session()->setFlashdata('error', $body);
				return redirect()->back()->withInput()->with('inputan', $input);
			} else {
				session()->setFlashdata('success', 'Data berhasil di upload');
				return redirect()->to('');
			}
		}
	}

	public function edit($id=null)
	{
		// dd($id);
		$api = $this->getOne($id);
		if (!$api) {
			return redirect()->to('/');
		}
		$data = [
			'data' => $api,
			'page_titile' => 'Edit Product',
		];
		
		return view('pages/edit', $data);
	}

	public function getOne($id)
	{
		$client = \Config\Services::curlrequest();
		$response = $client->request('GET', $this->urlserver.'product/'.$id, [
			'http_errors' => false,
			'headers' => [
				'Authorization' => $this->token
			]
		]);	

		$body = $response->getBody();
		$status = $response->getStatusCode();
		
		if ($status != 200) {
			$json = json_decode($body);
			session()->setFlashdata('error', $json->message);
			return false;
		} else {
			$data = json_decode($body);
			
			return $data->result;
		}
	}

	public function update()
	{
		$validation = $this->validate([
			'name'	=> 'required',
			'price_buy' => 'required|integer',
			'price_sell' => 'required|integer',
			'stok' => 'required|integer'
			// 'image_post' => 'uploaded[image]|is_image[image]'
		]);
        
		if (!$validation) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		} else {
			
			$varible = [
				'name' => $this->request->getVar('name'),
				'price_buy' => $this->request->getVar('price_buy'),
				'price_sell' => $this->request->getVar('price_sell'),
				'stok' => $this->request->getVar('stok'),
				'image' => new \CURLFile($this->request->getFile('image')),
			];
			
			$id = $this->request->getVar('id');
			$client = \Config\Services::curlrequest();
			$response = $client->request('PUT', $this->urlserver.'product/'.$id, [
				'multipart' => $varible,
				'http_errors' => false,
				'headers' => [
					'Authorization' => $this->token
				]
			]);
			
			$body = $response->getBody();
			$status = $response->getStatusCode();
			if ($status != 200) {
				$input = \Config\Services::validation();
				session()->setFlashdata('error', $body);
				return redirect()->back()->withInput()->with('inputan', $input);
			} else {
				session()->setFlashdata('success', 'Data berhasil di upload');
				return redirect()->to('');
			}
		}
	}

	public function delete($id)
	{
		$client = \Config\Services::curlrequest();
		$response = $client->request('delete', $this->urlserver.'product/'.$id, [
			'http_errors' => false,
			'headers' => [
				'Authorization' => $this->token
			]
		]);	

		$body = $response->getBody();
		$status = $response->getStatusCode();
		
		if ($status != 200) {
			session()->setFlashdata('error', $body);
			return redirect()->to('/');
		} else {
			session()->setFlashdata('success', 'Data telah di hapus' );
			return redirect()->to('/');
		}
	}
}
