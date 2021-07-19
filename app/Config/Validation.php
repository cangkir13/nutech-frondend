<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $login = [
		'email'	=> 'required|valid_email',
		'password' => 'required'
	];

	public $login_error = [
		'email' => [
			'required' => 'Email wajib diisi!',
			'valid_email' => 'Format email salah!'
		],
		'password' => [
			'required' => 'password wajib diisi!'
		],
	];

	public $register = [
		'email'	=> 'required|valid_email',
		'username' => 'required',
		'password' => 'required',
		'password_confirmation' => 'required|matches[password]'
	];

	public $register_error = [
		'email' => [
			'required' => 'Email wajib diisi!',
			'valid_email' => 'Format email salah!'
		],
		'username' => [
			'required' => 'username wajib diisi!'
		],
		'password' => [
			'required' => 'password wajib diisi!'
		],
		'password_confirmation' => [
			'required' => 'password_confirmation wajib diisi!',
			'matches' => 'password_confirmation harus sama dengan password!', 
		],
	];
}
