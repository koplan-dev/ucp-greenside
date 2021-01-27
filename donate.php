<?php 
@session_start();
include_once('modules/settings.php');
if(!isset($_SESSION['usuario'])){
	header('Location: index');
}
require_once('static-pages/head.php');
//require_once('gateways/teste.php');
?>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
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
<script type="text/javascript" language="javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" language="javascript">
$(function($) {
	// Quando o formulário for enviado, essa função é chamada
	$("#formulario").submit(function() {
		// Colocamos os valores de cada campo em uma váriavel para facilitar a manipulação
		//var person = $("#personbuy").val();
		var filiacao = document.getElementById("viptt").value;
		var person = document.getElementById("personbuy").value;
		
		// Exibe mensagem de carregamento
		$("#status").html("</br></br></br></br></br><center><div class='loader'></div></center></br></br></br>");
		
		// Fazemos a requisão ajax com o arquivo envia.php e enviamos os valores de cada campo através do método POST
		$.post('enviar.php', {person: person, filiacao: filiacao }, function(resposta) {		
				$("#status").html(resposta);
		});
	});
});
</script>
<?php
	if ($sandbox == true){
	    echo ('<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>');
	} else {
		echo ('<script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>');
		}
 ?>


<body ondragstart='return false'>
    <script>
        function modal(mid) {
            $('#myModal' + mid).modal('hide');

        }

    </script>
    <?php require_once('static-pages/menusuperior.php'); ?>
    <div class="content well well-small col-md-12" style="display: table;">
        <div class="row-fluid" style="padding-top: 40px;">
            <div class="col-md-12">
                <div class="col-md-9">


	<h4>Donate Greenside Roleplay</h4>
	<p>
		Todas as doações feitas serão investida no servidor ou em qualquer outros serviços relacionado ao serve Greenside Roleplay. <br>
		Como forma de retribuição temos algumas algumas vantagens a oferecer aos jogadores que ajudam o servidor, confira a baixo.
		<br><br>
	</p>
	<div class="row-fluid">
		<div class="span12">
			<strong>R$15: Donator Level 1</strong><br>
			<ul>
				<li><b>Donate Payday:</b> Você recebe um bônus de <b>$750</b> e <b>+2</b> pontos de <b>XP a cada payday</b>.</li>
				<li>Você pode solicitar uma mudança gratuita de número de telefone no jogo para qualquer uma das suas contas.</li>
				<li>Você tem o direito de estar no grupo doadores do forum e acessar o fórum privado de doadores.</li>
				<li>Você tem a capacidade de possuir <b>400 objetos móveis (Furniture)</b>.</li>
			</ul>
			<br>
			<strong>R$20: Donator Level 2</strong><br>
			<ul>
				<li><b>Donate Payday:</b> Você recebe um bônus de <b>$1500</b> e <b>+3</b> pontos de <b>XP a cada payday</b>.</li>
				<li>Seu time spam de trocar de trabalho será <b>0 minutos</b> permitindo que você troque de emprego facilmente.</li>
				<li>Você pode mudar sua cor do Tag do seu nome ao ouro assim todos saberam que você é um doador: <b>/toggold</b>.</li>
				<li>Acesso ao comando <b>/togooc</b>, para ativar e desativar o chat global da sua tela.</li>
				<li>Quando você usa o OOC global (/o) seu texto será destacado. (alternando você pode desativar esta opção usando <b>/toggold</b>).</li>
				<li>Todos os seus temporizadores do spam de TRABALHOS PARALELOS (JOB-NON-OFICIAL) serão reduzidos para metade após ter terminado todo o trabalho (exemplo: 5 minutos em vez de 10).</li>
				<li>Você tem a capacidade de possuir <b>600 objetos móveis (Furniture)</b>.</li>
				<li>Você poderá colocar actores adicionais em qualquer empresa que esteja em seu nome.</li>
			</ul>
			<br>
			<strong>R$25: Donator Level 3</strong><br>
			<ul>
				<li><b>Donate Payday:</b> Você recebe um bônus de <b>$2250</b> e <b>+4</b> pontos de <b>XP a cada payday.</b></li>
				<li>Escolha livre de um desses veículos para possuir: <b>FCR-900, Maverick, Bullet</b> ou qualquer outro veículo que pode ser comprado na concessionária.</li>
				<li><b>1+</b> nível livre in game para habilidade da arma <b>(Sistema de Skill)</b>.</li>
				<li><b>50%</b> de sua taxa de anúncios <b>(anúncios privados e regulares)</b>.</li>
				<li>Você tem a capacidade de possuir <b>800 objetos móveis (Furniture)</b>.</li>
				<li>Você pode colocar até <b>2</b> actors adicionais (NPC) na sua empresa.</li>
			</ul>
			<br>
			<strong>R$30: Donator Level 4</strong><br>
			<ul>
				<li><b>Donate Payday:</b> Você recebe um bônus de <b>$3000</b> e <b>+5</b> pontos de <b>XP a cada payday.</b></li>
				<li>Escolha livre de um desses veículos para possuir: <b>Banshee, Infernus, Sand King</b> ou qualquer outro veículo que pode ser comprado na concessionária.</li>
				<li><b>2+</b> nível livre in game para habilidade da arma <b>(Sistema de Skill)</b>.</li>
				<li>Anúncios gratuitos <b>(anúncios privados e regulares)</b>.</li>
				<li><b>Combustível grátis em todos os postos de gasolina de San Andreas.</b></li>
				<li>Você tem a capacidade de possuir <b>1000 objetos móveis (Furniture)</b>.</li>
				<li>A sensação de que você ajudou muito o servidor!</li>
				<li>Você pode colocar até <b>3</b> actors(NPC) adicionais na sua empresa.</li>
			</ul>

			<h5></h5>
		</div>
	</div>
	<p>
		 <b> As doações monetárias não são reembolsáveis e não são transferíveis entre contas de jogadores. Todas as doações serão processadas em REAIS (R$) e todas as vantagens serão recompensadas após as doações terem sido confirmadas. As doações monetárias só podem ser feitas via Pagseguro. Tentativa de cancelar pagamento depois de já ter comprado e recebido o Donate, resultará em banimento permanentemente de sua conta. Estes termos podem mudar a qualquer momento sem aviso prévio.</b>
	</p>
                    </br>
                    <div class="col-md-6 col-md-offset-4">



                        <!-- Trigger the modal with a button -->

                        <button type="button" onClick="modal('m1')" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Comprar</button>

                        <!-- <form action="checkout.php" method="post" onsubmit="return false;"> -->
                        <form name="formulario" id="formulario" action="javascript:" method="post">

                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Qual filiação você deseja comprar?</h4>
                                        </div>
                                        <div class="container"></div>
                                        <div class="modal-body">

                                            </br>
                                            <p>Escolha qual filiação você deseja comprar!</p>
											<select id="viptt" name='viptt' class='form-control col-md-4'>
											<option value='1'>Level 1 Donator - R$15</option>
											<option value='2'>Level 2 Donator - R$20</option>
											<option value='3'>Level 3 Donator - R$25</option>
											<option value='4'>Level 4 Donator - R$30</option>
											</select>

                                        </div>
                                        </br>
                                        </br>
                                        </br>
                                        <div class="modal-footer">
                                            <a href="#" data-dismiss="modal" class="btn btn-danger" style= "float: left;">Cancelar</a>
                                            <a data-toggle="modal" href="#myModal2" onClick="modal('')" class="btn btn-primary">Prosseguir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="myModal2">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Escolher personagem</h4>
                                        </div>
                                        <div class="container"></div>
                                        <div class="modal-body">
                                            Você deseja comprar para qual personagem?
                                            </br>
                                            </br>
                                            <select id="personbuy" name='personbuy' class='form-control col-md-4'>
											<?
											    $s = "SELECT * FROM `players` WHERE `Username` = '$usuario'";
												$s = mysqli_query($connect, $s);
												$s2 = mysqli_num_rows($s);
					 
					                            if ($s2 >= 1){
													while ($person = mysqli_fetch_assoc($s)){
													    $nome = $person['Name'];
														$id = $person['id'];
														$skin = $person['Skin'];
														echo '<option value="'.$nome.'">'.$nome.'</option>';
													}
												}else {
													echo "<p>Você não possue nenhum personagem! </p>";
													}
										    ?>
											</select>


                                            </br>
                                            </br>
                                            </br>

                                        </div>
                                        <div class="modal-footer">
										    <a href="#" data-dismiss="modal" class="btn btn-danger" style= "float: left;">Cancelar</a>
											<input name="formulario" class="btn btn-primary" type="submit" value="Prosseguir" data-toggle="modal" href="#myModal33" onClick="modal('2')"/>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
</form>

                            <div class="modal fade" id="myModal33">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 id="m-title" class="modal-title" font-size:30px> Confirmação</h4>
                                        </div>
                                        <div class="container"></div>
                                        <div id="status" class="modal-body">

                                            Body
                                        </div>
                                        <div class="modal-footer">
										<div id="sb-bt">
										    <a href="#" data-dismiss="modal" class="btn btn-danger" style= "float: left;">Cancelar</a>
										    <input form="comprar" type="submit" class="btn btn-primary" value="Finalizar compra"> 
										</div>	
											
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>

                <div class="col-md-3">
                    <?php require_once('static-pages/avisolateral.php');
					require_once('static-pages/menulateral.php'); ?>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('static-pages/rodape.php'); 
	echo $javascript;?>
    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>
