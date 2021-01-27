<?php
@session_start();
include_once('modules/settings.php');
if(!isset($_SESSION['usuario'])){
	header('Location: index');
}
$usuario = $_SESSION['usuario'];

// Recuperando os valores dos campos através do método POST

$person = $_POST["person"];
$filiacao = $_POST["filiacao"];
$ptype = $_POST["ptype"];
$reference = $_POST["reference"];

if (isset($ptype) && $ptype != null && isset($reference) && $reference != null) {
	
	if ($ptype == 'cancel') {
		
			echo '
<style>
.c-loader {
  border: 16px solid #f3f3f3;
  border-radius: 70%;
  border-top: 16px solid #ef2e23;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

            <div id="status" class="modal-body">
			
			<center><h3 style="font-size:30px;">Cancelando seu Pedido</h3>
			<h2 style="font-size:30px;">Aguarde enquanto estamos cancelando seu pedido :( </h2>
			</center>
			
			</br></br></br></br><center><div class="c-loader"></div></center></br></br></br>
                
            </div>

	';
	
	mysqli_query($connect, "UPDATE `orders` SET `status` = '7' WHERE `id` ='$reference'");
	
	
		
	} else if ($ptype == 'success'){
		
		
					echo '
<style>
.l-loader {
  border: 16px solid #f3f3f3;
  border-radius: 70%;
  border-top: 16px solid #15ff05;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

            <div id="status" class="modal-body">
			
			<center><h3 style="font-size:30px;">Transação Concluída com Sucesso</h3>
			<h2 style="font-size:30px;">Obrigado! :D Estamos processando sua transação</h2>
			</center>
			
			</br></br></br></br><center><div class="loader"></div></center></br></br></br>
                
            </div>

	';
	
	//mysqli_query($connect, "UPDATE `orders` SET `status` = '1' WHERE `id` ='$reference'");
		
	
	}

} else if (isset($person) && $person != null && isset($filiacao) && $filiacao != null && isset($ptype) && $ptype != null) {
	
	
	
	echo '
<style>
.l-loader {
  border: 16px solid #f3f3f3;
  border-radius: 70%;
  border-top: 16px solid #3498db;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

            <div id="status" class="modal-body">
			
			<center><h3 style="font-size:30px;">Processando</h3>
			<h2 style="font-size:30px;">Aguarde enquanto estamos processamos a sua compra!</h2>
			</center>
			
			</br></br></br></br><center><div class="l-loader"></div></center></br></br></br>
                
            </div>

	';
	

if ($ptype == 'pagseguro') {
	
	if ($filiacao == '1') {
	$fname = 'Level 1 Donator';
	$valor = "15.00"; 
}else if ($filiacao == '2') {
	$fname = 'Level 2 Donator';
	$valor = "20.00"; 
} else if ($filiacao == '3') {
	$fname = 'Level 3 Donator';
	$valor = "25.00"; 	
} else if ($filiacao == '4') {
	$fname = 'Level 4 Donator';
	$valor = "1.00"; 	
} else {
	echo '<script>window.location.href = "index";</script>';
}
    $datec = date( 'Y-m-d H:i:s' );

	$sz = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username` = '$usuario'");
	
	if(mysqli_num_rows($sz) == 1){
		while($dadosconta = mysqli_fetch_assoc($sz)){
			$idusuario = $dadosconta['id'];
			$email = $dadosconta['EMail'];
		}
	}
	
	$sp = mysqli_query($connect, "SELECT * FROM `players` WHERE `Name` = '$person'");
	
		if(mysqli_num_rows($sp) == 1){
		while($dadosperson = mysqli_fetch_assoc($sp)){
			$idperson = $dadosperson['id'];
		}
	}
	

$sql = "INSERT INTO `orders` ( `gateway`, `produto`, `playerid`, `personagem`, `status`, `ip`, `date`, `entrega`) VALUES ('pagseguro', '$filiacao', '$idusuario', '$idperson', '0', '$ip', '$datec', '0')";


if (mysqli_query($connect, $sql)) {
    $referenceid = mysqli_insert_id($connect);
	echo 'Nº da transação: '.$referenceid;
	} /*else {

    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}*/
	
	

//Infos add to the settings... 
//$sandbox = true;
//$pagseguro['token'] ='';
//$pagseguro['email'] = '';
$pagseguro['currency'] = 'BRL';

//Produto
$pagseguro['itemId1'] = '1';
$pagseguro['itemQuantity1'] = '1';
$pagseguro['itemDescription1'] = 'Filiacao: '.$fname.' Peronagem: '.$person.' N pedido: '.$referenceid;
$pagseguro['itemAmount1'] = $valor;

$pagseguro['GAME_NAME'] = 'SA-MP';
$pagseguro['PLAYER_ID'] = $idusuario;

//reference é com isso que obteremos o retorno do banco de dados
$pagseguro['reference'] = $referenceid;

//Dados do comprador
$pagseguro['senderEmail'] = $email;

//URL de redirecionamento e Notificação
//$pagseguro['redirectURL'] = '1';
$pagseguro['notificationURL'] = 'https://greensiderp.com.br/modules/retorno-ps.php';

// Enviar pedido
if ($sandbox == true){
	$url= 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/';
} else {
	$url= 'https://ws.pagseguro.uol.com.br/v2/checkout/';
}

 $pagseguro = http_build_query($pagseguro);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $pagseguro);
	$xml= curl_exec($curl);
	if($xml == 'Unauthorized'){
		echo 'Não Autorizado';
		exit;
	}
	curl_close($curl);
	$xml= simplexml_load_string($xml);
	if(count($xml -> error) > 0){
		$return = 'Dados Inválidos '.$xml ->error-> message;
		echo $return;
		exit;
	}
	/*
	if ($sandbox == true){
	    echo ('<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>');
	} else {
		echo ('<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>');
		}
*/
		

		
		echo ('
		<script>
		$(function(){
	var count = 2;
	
	var cronometro = setInterval(function(){
		count--;
		
		if(count == 0){
			clearInterval(cronometro);
			ps();
	
		}
		}, 1000);
	});
</script>
		');
		
		
		
	//Esse é o que roda
		
				echo "
		
<script>
function ps() {
checkoutCode = '$xml->code';
PagSeguroLightbox({
         code: checkoutCode
         }, {
                 success : function() {
					 var count = 6;
	
	var cronometro = setInterval(function(){
		count--;
		
		if(count == 0){
			clearInterval(cronometro);
			window.location.href = 'transacoes';
	
		}
		}, 1000);
						 success();
                         
						  
                 },
                 abort : function() {
						  var count = 4;
	
	var cronometro = setInterval(function(){
		count--;
		
		if(count == 0){
			clearInterval(cronometro);
			window.location.href = 'transacoes';
	
		}
		}, 1000);
						 abort();
                 }

         });
		 
}

</script>
			
		";
		

		echo ('
<script>
function abort(){ 

        var title = document.getElementById("m-title");
        title.innerHTML = "Cancelando"; 		
		$.post("checkout.php", {ptype: "cancel", reference: "'.$referenceid.'" }, function(resposta3) {			
			$("#status").html(resposta3);
		});
	};
	
function success(){

	
	    var title = document.getElementById("m-title");
        title.innerHTML = "Transação Realizada com Sucesso!"; 
		$.post("checkout.php", {ptype: "success", reference: "'.$referenceid.'" }, function(resposta4) {		
			$("#status").html(resposta4);	
		});
	};	
		
		
		</script>
		');
		
} 

} else {
	header('Location: index');
}
	

?>