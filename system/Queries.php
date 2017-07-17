<?php
namespace Fmw;

use Fmw\Connection;

/*
select($table, $join, $columns, $where)
table [string]
The table name.
join [array]
Table relativity for table joining. Ignore it if no table joining required.
columns [string/array]
The target columns of data will be fetched.
where (optional) [array]
The WHERE clause to filter records.
*/


Class Queries extends Connection{
	
	protected $table_name;
	private $fields;
	public function __construct($name){
		parent::__construct();
		$this->set_table($name);
		$this->set_fields();
	}

	public function set_table($table_name)
	{
		$this->table_name = $table_name;
	}
	private function set_fields(){
		$columns 	= array();
		$query 		= $this->medoo->query("DESC {$this->table_name}");
		if ($result = $query->fetchAll()) {
			foreach ($result as $key => $value) {
				$columns[]=$value['Field'];
			}
		}
		$this->fields = $columns;
	}

	public function get_all()
	{
		return $this->medoo->select($this->table_name, "*");
	}
	
	public function get_enum_values($field){
    	$type = $this->medoo->query( "SHOW COLUMNS FROM {$this->table_name} WHERE Field = '{$field}'" )->fetchAll();
    	preg_match("/^enum\(\'(.*)\'\)$/", $type['Type'], $matches);
    	$enum = explode("','", $matches[1]);
    	return $enum;
	}

}
