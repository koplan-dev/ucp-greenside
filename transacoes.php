<?php
@session_start();
if(!isset($_SESSION['usuario'])){
	header('location: index');
}
require_once('modules/settings.php'); 
require_once('static-pages/head.php');
$usuario = $_SESSION['usuario'];
?>
    <body oncontextmenu='return false' ondragstart='return false' ">
	
	<?php require_once('static-pages/menusuperior.php'); ?>
	<div class="content well well-small col-md-12 col-xs-12">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">	    
				<div class="col-md-9">					
				
					<?php if(!isset($_GET['ath'])){  
						$tempo = 5000;
						echo $javascript;
						echo '
						<h2>Histórico de transações!</h2>
						<h5>Visualize todas as transações que você efetuou!</h5></br>'; 


						echo '<div class="col-md-12" style="margin-bottom: 20px;">
						<div class="panel panel-default">
						<!-- Default panel contents -->
						<div class="panel-heading">Transações realizadas</div>

						<!-- Table -->
						<table class="table table-bordered table-striped">
						<thead>
						<tr>
						<th>Método</th>
						<th>Nº do pedido</th>
						<th>Produto</th>
						<th>Personagem</th>
						<th>Status</th>
						<th></th>
						</tr>
						</thead>
						<tbody>';

						$su = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username`='$usuario' ");
						if(mysqli_num_rows($su) == 1){
							while($dadosconta = mysqli_fetch_assoc($su)){
							        $idusuario = $dadosconta['id'];
							}
						}
						
						$sq = mysqli_query($connect, "SELECT * FROM `orders` WHERE `playerid` = '$idusuario' ORDER BY `id` DESC LIMIT 0,20 ");
						while ($info = mysqli_fetch_assoc($sq)){

							$pedido = $info['id'];
							$gateway = $info['gateway'];
							$produto = $info['produto'];
							$personagem =  $info['personagem'];  
							$status = $info['status'];
							
							$sp = mysqli_query($connect, "SELECT * FROM `players` WHERE `id` = '$personagem'");
							
							if(mysqli_num_rows($sp) == 1){
								while($dadosconta2 = mysqli_fetch_assoc($sp)){
									$personagemname = $dadosconta2['Name'];
									}
								}
							
							$get_status = array("Aguardando finalização do pedido", "Aguardando pagamento", "Em análise", "Pagamento Aprovado", "Pagamento Aprovado", "Em disputa", "Devolvida", "Cancelada");
							$get_produto = array("0", "Level 1 Donator", "Level 2 Donator", "Level 3 Donator", "Level 4 Donator");
							
							echo '<tr>
							<th scope="row">'.$gateway.'</th>
							<td>'.$pedido.'</td>
							<td>'.$get_produto[(int) $produto].'</td>
							<td>'.$personagemname.'</td>
							<td>'.$get_status[(int) $status].'</td>
							<td> <a href="#" ><button type="button" name="trd"  class="btn btn-primary but" data-toggle="modal" data-target=".bs-example-modal-lg">Detalhes</button></a></td>

							</tr>';
						}
						echo '</tbody>
						</table>
						</div>
						</div>'; 
					}

					?> 

				</div>
				<div class="col-md-3">
					<?php require_once('static-pages/avisolateral.php');
					require_once('static-pages/menulateral.php'); ?>
				</div>


			</div>
		</div>
	</div>
</div>

	
	 <?php require_once('static-pages/rodape.php'); ?>
	 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>