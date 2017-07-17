<?php

namespace Fmw;

use Medoo\Medoo;

Class Connection extends Medoo
{
	private $config;
	protected $medoo;
	protected $table_list;

	public function __construct(){
		$file 			= 'config.ini';
        $config_ini 	= parse_ini_file($file,true);
       	$this->config 	= $config_ini['database']; 	
       	parent::__construct($this->config);
		$this->setup();
		$this->set_table_list();		
	}

	public function __get($attrib_name) {
    	if ($this->medoo->$attrib_name) {
       		return $this->medoo->$attrib_name;
    	}
  	}

	protected function set_table_list(){
		$send = array();
		$query =$this->medoo->query('show tables');
		if ($result = $query->fetchAll()) {
			foreach ($result as $key => $value) {
				$send[] = $value['Tables_in_'.$this->config['database_name']];
			}
			
		 	$this->table_list = $send;
		}
		
	}

	public function get_table_list(){
		return $this->table_list;
	}
	private function setup()
	{
		$this->medoo = new Medoo($this->config);
	}
}
