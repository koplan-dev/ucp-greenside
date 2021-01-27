<?php 
@session_start();
include_once('modules/settings.php');
if(!isset($_SESSION['usuario'])){
	header('Location: index');
}
require_once('static-pages/head.php');
?>


<body ondragstart='return false' >
	<?php require_once('static-pages/menusuperior.php'); ?>
	<div class="content well well-small col-md-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">	   
				<div class="col-md-9">

					<h2>Meus Personagens</h2>

					<?php 
					$usuario = $_SESSION['usuario'];
					$sz55 = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Username` = '$usuario' AND `Status` = '0'");
					$sz55 = mysqli_num_rows($sz55);
					if ($sz55 == 1){
						echo '<div class="alert alert-warning"><center>Você possui um personagem aguardando avaliação.</center></div>';
					}
					$sxx1 = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Username` = '$usuario' AND `Status` = '2'");
					$sxx = mysqli_num_rows($sxx1);
					if ($sxx == 1){
						echo '<div class="alert alert-warning">
						Sua ultima  aplicação enviada foi negada. <a href="criarpersonagem">Clique aqui</a> para reenviar.</div>';
					}
					echo '<div class="col-md-12 col-md-offset-2" style="margin-bottom: 20px;">';
					$sz = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username` = '$usuario'");
					if(mysqli_num_rows($sz) == 1){
						while($dadosconta = mysqli_fetch_assoc($sz)){
							$ultimoip = $dadosconta['IP'];
							$email = $dadosconta['EMail'];
							$registradoem = $dadosconta['RegisterDate'];
							$ultimologin = $dadosconta['LastLogin'];
						}
					}
					$s = "SELECT * FROM `players` WHERE `Username` = '$usuario'";
					$s = mysqli_query($connect, $s);
					$s2 = mysqli_num_rows($s);



					if ($s2 >= 1){
						echo "<div class='col-md-12'>";
						while ($person = mysqli_fetch_assoc($s)){
							$nome = $person['Name'];
							$nome = str_replace("_", "<br />", $nome);
							$id = $person['id'];
							$skin = $person['Skin'];
							$horajo[] = $person['TotalTimePlayed']; 
							if ($skin >  299){
								$skin = '<img src="assets/images/skins/skinssamp/Skin_'.$skin.'.png" style=" width: 100px;">';
							}
							else{
								$skin = '<img src="assets/images/skins/'.$skin.'.png" style=" width: 100px;">';
							}

							echo '<div class="well well-small col-md-3 divs" style="box-shadow: 0 0 6px 2px #b0b2ab; margin-right: 20px; display:block; margin-top: 20px;"><center><div style="background: #f3f3f3; border-radius: 5px;">'.$skin.'
							</center>
							<center>
							<div style="font-size: 19pt; padding: 15px 10px 10px 2px; border-top: 1px solid #c5c8c0; border-bottom: 1px solid #c5c8c0;">
							<p>'.$nome.'</p>
							</div>
							<a href="personagem?person='.$id.'" class="btn btn-primary btn-plan-select col-md-8 col-md-offset-2 but" style="">Mais</a>
							</center>
							</div>

							';
						}
						echo "</div></div>";
					}
					else{
						echo '</div><div class="col-md-offset-0" style=""><div class="alert alert-warning">Você não tem nenhum personagem. <a href="criarpersonagem">Clique aqui</a> para criar um.</div></div>';
					}
					$veradm = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username` = '$usuario' AND `AdminLevel` >= 1");
					if(mysqli_num_rows($veradm) >= 1){
						while($dadosadm = mysqli_fetch_assoc($veradm)){
							$leveladm = $dadosadm['AdminLevel'];
						}
					}
					$arrayadm = array("", "Moderador", "Administrador 1", "Administrador 2", "Administrador 3", "Lead Admin", "Manager", "Developer");
					$horasjogadas = $horajo[0] + $horajo[1] + $horajo[2];
					echo '

					<div class="row" style="">


					</div>
					<div class="panel panel-default" style="margin-top: 20px;">
					<div class="panel-body">
					<div class="col-md-6">
					<strong>Nome de usuário:</strong> '.$usuario.'<br>
					<strong>E-mail:</strong> '.$email.'<br>
					<strong>Registrado em:</strong> '.$registradoem.'<br>
					<strong>IP último login:</strong> '.$ultimoip.'<br>	
					</div>
					<div class="col-md-5"><strong>Admin:</strong> '.$arrayadm[$leveladm].'
					<br /><strong>Personagens criados:</strong> '.$s2.'<br>
					<strong>Tempo conectado:</strong> '.$horasjogadas.' minuto(s)<br>
					<!-- <strong>Última atividade:</strong> '.$ultimologin.'<br>  -->

					</div>
					</div>
					</div>';
					?>


				</div>
				<div class="col-md-3">
					<?php require_once('static-pages/avisolateral.php');
					require_once('static-pages/menulateral.php'); ?>
				</div></div>
			</div>
		</div>
	</div>
	<?php require_once('static-pages/rodape.php'); 
	$tempo = 120000;
	echo $javascript;?>

	<!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>


















