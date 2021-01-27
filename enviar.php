<?php
@session_start();
include_once('modules/settings.php');
if(!isset($_SESSION['usuario'])){
	header('Location: index');
}
$person = $_POST["person"];
$filiacao = $_POST["filiacao"];

if (isset($person) && $person != null && isset($filiacao) && $filiacao != null) {
	


if ($filiacao == '1') {
	$fname = 'Level 1 Donator';
	$valor = 15; 
}else if ($filiacao == '2') {
	$fname = 'Level 2 Donator';
	$valor = 20; 
} else if ($filiacao == '3') {
	$fname = 'Level 3 Donator';
	$valor = 25; 	
} else if ($filiacao == '4') {
	$fname = 'Level 4 Donator';
	$valor = 30; 	
}



// Enviado o modal


	echo '
            <div id="status" class="modal-body">

                <table id="example1" style="width:100%; font-size:11px; text-align: center;" class="table table-bordered table-striped dataTable" role="grid">
                    <thead>
                        <tr role="row" style="width:100%; text-align: center;">
                            <th class="sorting" rowspan="1" colspan="1" style="text-align: center;">Produto</th>
							<th class="sorting" rowspan="1" colspan="1" style="text-align: center;">Personagem</th>
                            <th class="sorting" rowspan="1" colspan="1" style="text-align: center;">Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr role="row" style="width:100%; text-align: center;">
                            <td style="text-align: center;">'.$fname.'</td>
                            <td style="text-align: center;">'.$person.'</td>
                            <td style="text-align: center;">R$'.$valor.' </td>
                        </tr>
						
                    </tbody>
                    <tbody>
                    </tbody>
                </table>


                <div style="text-align:left;">
                    <h2 style="font-size:30px;">Termos e condições</h2>
                    <div style="width: 100%; height: 200px; overflow-y: scroll; background-color:#E8E8E8; padding:5px;">
                        1. Ao adquirir uma conta premium no Greenside Roleplay você adere automaticamente as regras abaixo citadas.
                        <br><br> 2. O Greenside Roleplay e seus gestores se reservam o direito de encerrar todas as atividades de seus servidores, a qualquer momento que se fizer necessário, sem aviso prévio.
                        <br><br> 3. Os benefícios adquiridos com a conta premium são pessoais. Você poderá transferir Trocas de Nome e Trocas de Número para personagens vinculados a mesma conta em que adquiriu os benefícios. Não é permitido a transferência de benefícios para personagens em contas diferentes, não insista!
                        <br><br> 4. Os benefícios tem duração de 30 dias corridos a partir da ativação do pacote, sujeito a interrupção por questões técnicas quando o servidor estiver offline (manutenção ou queda).
                        <br><br> 4.1 Ao adquirir uma conta premium você não está imune as punições administrativas do servidor. É dever de todos os jogadores, inclusive os jogadores premium, respeitar todas as regras. Não haverá devolução do valor pago caso você sofra alguma sanção da equipe.
                        <br><br> 4.2 Não haverá suspensão do prazo de validade dos benefícios em caso de banimento.
                        <br><br> 5. O jogador só terá direito aos benefícios listados no tópico oficial, não sendo exigível nenhuma outra vantagem ou direito perante a administração.
                        <br><br> 6. O pacote só poderá ser consumido pelo jogador no mês referente à doação, não podendo ser prorrogado ou deixado em espera para meses subsequentes.
                        <br><br> 7. Se o jogador depositar o valor referente a dois ou mais pacotes de benefícios, ele poderá indicar outros personagens para receber os benefícios de cada pacote. Os pacotes não são cumulativos.
                        <br><br> 8. São guardados os princípios da probidade e da boa fé na execução deste termos, sendo passível de revogação imediata dos benefícios em caso de descumprimento de qualquer das cláusulas.
                        <br><br> 9. Qualquer abertura de disputa/protesto/contestação para estornar o valor da compra após ter recebido os benefícios está sujeita a banimento de todas as contas do usuário.
                        <br><br> 10. Os benefícios serão creditados em até 48h úteis após a comprovação da doação pelas instituições financeiras. O personagem a receber os benefícios deve estar offline após a compra ser aprovada pelo UCP. Importunar membros da administração pedindo para que seja creditados os benefícios poderá acarretar punição in-game.
                        <br><br> 11. O canal privado no Teamspeak 3 não deve ser utilizado para comunicação in-character ou abusos de qualquer espécie. A mínima suspeita de má utilização desse benefício pelo jogador implicará em suspensão imediata do benefício sem direito a devolução do valor pago.
                        <br><br> 12. Estes termos poderão sofrer alterações futuras.
                    </div>

                    <h2 style="font-size:30px;">Método de pagamento</h2>
                    <form id="comprar" action="javascript:" method="post">  
                       
					   <input type="radio" id="ptype" name="method" value="pagseguro" checked> <img width="230px" height="60px" src="assets/images/pslogo.png"> <br><br><br>
					   <input type="radio" id="ptype" name="method" value="paypal"> <img width="190px" height="40px" src="assets/images/paypal-logo.png"> <br><br>
					   
					</form>					   
                </div>
            </div>

	';

	echo '			
	
<script type="text/javascript" language="javascript">

$(function($) {
	$("#comprar").submit(function() {	
		var type = document.getElementById("ptype").value;
		//$("#status").html("<div class="loader"></div>");
		

		
		$("#sb-bt").html("");

		$.post("checkout.php", {person: "'.$person.'", filiacao: "'.$filiacao.'", ptype: type }, function(resposta2) {		
				$("#status").html(resposta2);
				
		});
	});
	});
	

</script>

';

} else {
	header('Location: index');
}
	


?>