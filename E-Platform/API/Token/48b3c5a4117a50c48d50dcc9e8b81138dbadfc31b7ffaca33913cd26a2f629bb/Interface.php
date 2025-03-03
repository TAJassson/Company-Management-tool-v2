<?php

class controller {
	private $pathInfo;
	private $urlSegments; // array storing path elements
	
	function __construct() {
		if (!isset($_SERVER['PATH_INFO'])) {
		echo 'You are not allowed to visit!';
		header('Location: http://www.google.com/');
		exit();
		}
		$this->pathInfo = $_SERVER['PATH_INFO'];
		$this->urlSegments = explode('/', $this->pathInfo);
		array_shift($this->urlSegments);
		
		$resource = array_shift($this->urlSegments);
		$resource = strtolower($resource);
		$resource = ucfirst($resource);

		
		$serviceName = $resource.'Server';
		
		$serviceFilename = $serviceName.'.php';

		//echo $serviceFilename;
		//Userinput+Server+.php
		
		if (file_exists($serviceFilename)) {
			require_once $serviceFilename;
			$server = new $serviceName;
			
			$method = $_SERVER['REQUEST_METHOD'];
			$server->$method($this->urlSegments);
		} else {
			header('Location: http://www.google.com/');
			exit();
		}		
	}
}

$controller = new Controller();

//echo $_SERVER['PATH_INFO'];


// http://localhost/sample/index.php/atm

//$_GET[]
// http://localhost/sample/index.php/atm/district/yuen+long
// http body key-value pair