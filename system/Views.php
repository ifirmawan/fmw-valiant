<?php

namespace Fmw;
/**
* 
*/

class Views
{
	public $menu = array('Beranda'=>'/home','Masuk'=>'/login');
	public $data = array();
	private $template;

	function __construct(){
		
		$this->set_template('default');
	}
	public function set_template($tpl){
		$template_file = __DIR__. '/../templates/'.$tpl.'.php';
		if (file_exists($template_file)) {
			$this->template = $template_file;
		}
	}
	private function get_template()
	{
		return $this->template;
	}
	
	public function set_content($file_name=''){
		//var_dump(getcwd());
		$file_path = __DIR__. '/../pages/'.$file_name.'.php'; 

		if (file_exists($file_path)) {
			extract($this->data);
			include $file_path;
			$this->data['content'] = ob_get_clean();
		}		
	}

	public function change_menu($menu=array())
	{
		if ($menu) {
			$this->menu = $menu;
		}
	}

	public function add_item_menu($custom=array())
	{
		$n_data = count($this->menu);
		if ($custom && $n_data > 0) {
			$this->menu = array_merge($this->menu,$custom);
		}
	}

	public function render(){
		$this->data['menu'] = $this->menu;
		extract($this->data);
		ob_start();
		require($this->get_template());
		echo ob_get_clean();
	}
	public function string_view($file_name)
	{
		$file_path = __DIR__. '/../pages/'.$file_name.'.php';
		if (file_exists($file_path)) {
			extract($this->data);
			include $file_path;
			return ob_get_clean();
		}
	}
}
?>