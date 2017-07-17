<?php
/**
* 
*/
class Auth extends Controller
{
	
	function __construct()
	{
		parent::__construct('home','we');
	}
	public function index()
	{		
		$this->page->data['hello'] = 'world';
		$this->show_page('home');
	}
	public function sample($value)
	{
		var_dump($value);
	}
	public function kueri()
	{
		
		var_dump($this->table->jabatan->get_all());
	}
	public function login()
	{
		$this->page->set_template('medium');
		$this->show_page('login');
	}
	public function verify()
	{
		var_dump($this->validator);
	}
}
