<?php

/*
check if environment is development and display errors
*/

function site_url($load=''){
  	// output: /myproject/index.php
    $currentPath = $_SERVER['PHP_SELF']; 
    // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
    $pathInfo = pathinfo($currentPath); 
    // output: localhost
    $hostName = $_SERVER['HTTP_HOST']; 
    // output: http://
    $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
    // return: http://localhost/myproject/
    $explode  = explode('/', $pathInfo['dirname']);
    return $protocol.$hostName.'/'.$load;
    //return $protocol.$hostName.'/'.$explode[1]."/".$load;
    //return $protocol.$hostName.$pathInfo['dirname']."/";
    
}

function setReporting(){
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	}else{
		error_reporting(E_ALL);
		ini_set('display_errors', 'Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.'error.log');
	}
}
/** check for magic quotes and remove them **/
function stripSlashesDeep($value)
{
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes(){
	if (get_magic_quotes_gpc()) {
		$_GET 	= stripSlashesDeep($_GET  );
		$_POST 	= stripSlashesDeep($_POST );
		$_COOKIE= stripSlashesDeep($_COOKIE);

	}
}

/** check register globals and remove them **/

function unregisterGlobals(){
	if (ini_get('register_globals')) {
		$array = array('_SESSION','_POST','_GET','_COOKIE','_REQUEST','_SERVER','_ENV','_FILES');
		foreach ($array as $value) {
			foreach ($GLOBALS[$value] as $key => $var) {
				if ($var == $GLOBALS[$key]) {
					unset($GLOBALS[$key]);
				}
			}
		}
	}
}

/** Main call function **/

function callHook(){
	global $page;
	global $action;
	global $param;
	$page 			= trim($page);
	$action 		= trim($action);
	$public_dir 	= scandir('../public');
	if (empty($page) && empty($action)) {
		$page 		='welcome';
		$action		='index';
	}else if (empty($action)) {
		$action		='index';
	}
	
	if (!in_array($page, $public_dir)) {
		$controllername = ucwords($page);

		if (class_exists($controllername)) {
			$dispatch 		= new $controllername($action);
			if ((int)method_exists($controllername, $action)) {		
				call_user_func(array($dispatch,$action), $param);
			}else{
				/* error generation code */
			}		
		}else{
			$notfound = new Controller();
			$notfound->show_page('404');
		}
	}
	
}

spl_autoload_register( function ($class_name) {
    $SYS_DIR 	= ROOT . DS . 'system' . DS;  // or whatever your directory is
    // only include if file exists, otherwise we might enter some conflicts with other pieces of code which are also using the spl_autoload_register function
   	$ACT_DIR 	= ROOT . DS . 'actions' . DS;
   	$sys_file	= $SYS_DIR . $class_name . '.php';
   	$act_file	= $ACT_DIR . $class_name . '.php';

    if( file_exists( $sys_file ) ) require $sys_file;

    if( file_exists( $act_file ) ) require $act_file;
} );

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();