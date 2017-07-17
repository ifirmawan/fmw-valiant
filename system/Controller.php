<?php
/**
* 
*/
use Fmw\Connection;
use Fmw\Views;
use Fmw\Model;

use Plasticbrain\FlashMessages\FlashMessages;
use rcastera\Browser\Session\Session;
use Valitron\Validator;

class Controller
{
	protected $db;
	protected $table;
	protected $content;
	protected $validator;

	public $action;
	public $session;

	function __construct($action=''){
		$this->action 	= $action;		
		$this->session 	= new Session();
		$this->db 		= new Connection();
		$this->page 	= new Views();
		$this->table 	= new Model();

		if (isset($_POST)) {
			$this->validator = new Validator($_POST);
		}
	}


	protected function set_page($name)
	{
		$page_file 	= __DIR__. '/../pages/'.$name.'.php';
		$page 		= trim($name);
		if (empty($page)) {
			$this->page->set_content('home');
		}elseif (!empty($page) && file_exists($page_file)) {
			$this->page->set_content($page);
		}else{
			$this->page->set_content('404');	
		}
	}
	public function show_page($name)
	{
		$this->set_page($name);
		$this->page->render();
	}
}
