<?php

date_default_timezone_set('America/Buenos_Aires');

class appconfig {

function conexion() {
		
		$hostname = "localhost";
		$database = "fullescabio";
		$username = "root";
		$password = "";
		
		/*
		$hostname = "185.28.21.241"; //para conexiones remotas
		*/
		/*
		$hostname = "localhost";
		$database = "mqwldfiz_crovan";
		$username = "mqwldfiz_crovan";
		$password = "rhcp75757979";
    */
		//u235498999_kike usuario
	
		
		$conexion = array("hostname" => $hostname,
						  "database" => $database,
						  "username" => $username,
						  "password" => $password);
						  
		return $conexion;
}

}




?>