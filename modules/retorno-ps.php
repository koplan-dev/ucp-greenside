<?php
$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

if (isset($notificationCode) && $notificationCode != null) {
require_once('settings.php'); 

$pagseguro = http_build_query($pagseguro);

if ($sandbox == true){
$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$pagseguro;
} else {
$url = 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$pagseguro;
}

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml= curl_exec($curl);
curl_close($curl);
	
$xml = simplexml_load_string($xml);
$reference = $xml->reference;
$status = $xml->status;

/*
User: $get_status = array("Aguardando finalização do pedido", "Aguardando pagamento", "Em análise", "Pagamento Aprovado", "Pagamento Aprovado", "Em disputa", "Devolvida", "Cancelada");
Staff: $get_status = array("Aguardando finalização do pedido", "Aguardando pagamento", "Em análise", "Pagamento Aprovado", "Disponível", "Em disputa", "Devolvida", "Cancelada");
$statusf = $get_status[$status]

status 0 = Aguardando finalização do pedido
status 1 = Aguardando pagamento  [PS]
status 2 = Em análise [PS]
status 3 = Pagamento Aprovado [PS]
status 4 = Pagamento Aprovado [PS = Disponível]
status 5 = Em disputa [PS]
status 6 = Devolvida [PS]
status 7 = Cancelada [PS]

entrega 0 = Pendente
entrega 1 = Entregue

// Produtos //
produto 1 = Level 1 Donator
produto 2 = Level 2 Donator
produto 3 = Level 3 Donator
produto 4 = Level 4 Donator

$get_produto = array("", "Level 1 Donator", "Level 2 Donator", "Level 3 Donator", "Level 4 Donator");

*/

function logMsg( $msg, $level = 'info', $file = 'main.log' ) {
    // variável que vai armazenar o nível do log (INFO ou ERROR)
    $levelStr = '';
	
	//'Filiacao: '.$fname.' Peronagem: '.$person.' N pedido: '.$referenceid;
	
	$datelogfile = date( 'Y-m-d' );
	$file = 'logs/'.$datelogfile.'.log';
 
    // verifica o nível do log
    switch ( $level )
    {
        case 'info':
            // nível de informação
            $levelStr = 'INFO';
            break;
			
		case 'success':
            $levelStr = 'SUCCESS';
            break;	
 
        case 'error':
            // nível de erro
            $levelStr = 'ERROR';
            break;
    }
 
    // data atual
    $date = date( 'Y-m-d H:i:s' );
 
    // formata a mensagem do log
    // 1o: data atual
    // 2o: nível da mensagem (INFO, SUCCESS ou ERROR)
    // 3o: a mensagem propriamente dita
    // 4o: uma quebra de linha
    $msg = sprintf( "[%s] [%s]: %s%s", $date, $levelStr, $msg, PHP_EOL );
 
    // escreve o log no arquivo
    // é necessário usar FILE_APPEND para que a mensagem seja escrita no final do arquivo, preservando o conteúdo antigo do arquivo
    file_put_contents( $file, $msg, FILE_APPEND );
}

$date = date( 'Y-m-d H:i:s' );

if($reference && $status){
 require_once('settings.php'); 

 if($status != '3') { 
  	 //Alterando o status da transação
	  $sql1 = "UPDATE `orders` SET `status` = '$status' WHERE `id` ='$reference'"; 
	  
	  if (mysqli_query($connect, $sql1)) {
		  //Se o status foi alterado com sucesso
		 logMsg($sql1, 'info');
	  } else {
		  //Se occoreu alguma falha ao executar a atualização dos status
		  logMsg($sql . " " . mysqli_error($connect), 'error');
	  }
	  
 } else if($status == '3') {
	 //Alterando o status da transação
	  $sql1 = "UPDATE `orders` SET `status` = '$status' WHERE `id` ='$reference'"; 
	  
	  if (mysqli_query($connect, $sql1)) {
		  //Se o status foi alterado com sucesso
		 logMsg($sql1, 'info');
	  } else {
		  //Se occoreu alguma falha ao executar a atualização dos status
		  logMsg($sql . " " . mysqli_error($connect), 'error');
	  }
	  
	  //Obtendo informações da transação para fazer a entrega
	  $sq = mysqli_query($connect, "SELECT * FROM `orders` WHERE `id` = '$reference'");
	  while ($info = mysqli_fetch_assoc($sq)){
							$entrega = $info['entrega'];
							$produto = $info['produto'];
							$personagem =  $info['personagem'];  //Captura o id do person
	 }
	 
	 //Pegando o nome do produto atráves do id do produto
	 $get_produto = array("", "Level 1 Donator", "Level 2 Donator", "Level 3 Donator", "Level 4 Donator");
	 $produtoname = $get_produto[(int) $produto];
	 
	 //Verificando se já foi entregue
	 if ($entrega == '0') {
		
		//Verificando se o produto é um donate
		 if ((int) $produto > 0 && (int) $produto <= 4){ 
		 //Sql para fazer a entrega 
		$sql = "UPDATE `players` SET `IsDonator` = '$produto' WHERE `id` ='$personagem'";
		 }
		 
		 //Se foi entregue (Se o sql foi executado com sucesso)
		 if (mysqli_query($connect, $sql)) { 
		 
		 //Gera log caso seja entregue com sucesso
		 logMsg($sql.' - Product: '.$produtoname, 'success');
		 
		 //Altera o status da entrega 
		$sqlentrega = "UPDATE `orders` SET `entrega` = '1', `dataentrega` = '$date' WHERE `id` ='$reference'"; 
		if (mysqli_query($connect, $sqlentrega)) {
		 //Se o status da entrega foi alterado com sucesso
		 logMsg($sqlentrega, 'info');
		 } else {
		  //Se occoreu alguma falha ao executar a atualização dos status
		  logMsg($sqlentrega . " " . mysqli_error($connect), 'error');
		  }
		
		 //Envia rcon 
		 /*
		 require_once('labelsender.php');
		 $rconhost = "ec2-52-67-80-13.sa-east-1.compute.amazonaws.com";
		 $rconPort = 25575;               
		 $rconPassword = "senha123"; 
		 $rcontimeout = 3;   
		 $rcon = new Rcon($rconhost, $rconPort, $rconPassword, $rcontimeout);
		 
		 //Caso consiga se conectar envia
		 if ($rcon->connect()){
			 $rcon->send_command('setdonate '.$personagem.' '.$produto);
			 //echo $rcon->get_response();
			 }			 
			  
			  */
	     } else {
			 //Se der erro na entrega gera o log
			 logMsg($sql . " " . mysqli_error($connect), 'error');
		 } 
	 } // Fim do check de entrega
	 
 }
 
 
}




} else {
	header('Location: https://greensiderp.com.br');
}
?>