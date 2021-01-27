<?php
date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y");
$hora = date("H:i");
$ip = $_SERVER['REMOTE_ADDR'];
    
    $hostname = "localhost";
	$username = "root";

	$password = "";

	$database = "gs";

    $connect = mysqli_connect($hostname, $username, $password, $database);

    if (!$connect) {
        echo "Verifique as configurações de conexão com o banco de dados.";
		}
		
		
	//Payment methods

//Pagseguro
$sandbox = false;
$pagseguro['token'] ='F316EE1A753B4159A84746670AE7F334';
$pagseguro['email'] = 'mbrandao045@gmail.com';	
//Retorno
$dataps['token'] ='F316EE1A753B4159A84746670AE7F334';
$dataps['email'] = 'mbrandao045@gmail.com';	
?>