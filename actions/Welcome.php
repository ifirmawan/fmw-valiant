<?php
/**
* 
*/
class Welcome extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->show_page('home');
	}
	public function try_it()
	{
		$this->show_page('tutorial');	
	}
	public function sample($value='')
	{
		echo "sample ".$value;
	}
}
