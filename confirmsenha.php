<?php
@session_start();
if(isset($_SESSION['usuario'])){
	header('location: index.php');
}
if(!isset($_GET['keycode']) || !isset($_GET['user']) || $_GET['keycode'] == NULL || $_GET['user'] == NULL ){
	header('location: index.php');
}
require_once('modules/settings.php'); 
require_once('static-pages/head.php');

?>

<body onkeydown='return checartecla(event)' oncontextmenu='return false' ondragstart='return false'">
	<?php require_once('static-pages/menusuperior.php'); ?>

	<div class="content well well-small col-md-12 col-xs-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">     
				<div class="col-md-9">
					<h2>Recuperar Senha</h2>
					
					<?php 
					$codi = $_GET['keycode'];
					$usuario = $_GET['user'];
					$vecode = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username` = '$usuario' AND `codesenha` = '$codi'");					
					if (mysqli_num_rows($vecode) == 1){
						echo '
						<form method="POST">
						<div class="col-md-6 col-md-offset-4">
						<input autofocus type="password" placeholder="Nova senha" class="form-control col-md-4" name="senha" style="margin-bottom: 10px;"/>
						<input type="password" placeholder="Confirmar nova senha" class="form-control col-md-4" style="margin-bottom: 10px;" name="nsenha">
						<button type="submit" style="margin-bottom: 10px;"  class="btn btn-default col-md-offset-5" style="" name="salvar">Salvar</button> 
						</div>
						</form>';
						if (isset($_POST['salvar'])){
							if ($_POST['senha'] == $_POST['nsenha']){
								$senha = $_POST['senha'];
								$senha = hash('whirlpool', $senha);
								mysqli_query($connect, "UPDATE `masters` SET `Password` = '$senha',`codesenha` = '' WHERE `Username` = '$usuario'");
								echo "<div class='col-md-4 col-md-offset-5 alert alert-success'><center>Sua senha foi alterada com sucesso.</center></div>";
								echo "<script>alert('Sua senha foi alterada com sucesso.');
								window.location = 'index.php';</script>";
							}
							else{
								echo "<div class='col-md-6 col-md-offset-5 alert alert-danger'><center>As senhas não são iguais.</center></div>";
							}
						}
					}
					else{
						header('location: index.php');
					}

					?>
				</div>
				<div class="col-md-3">
					<?php require_once('static-pages/avisolateral.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once('static-pages/rodape.php'); 
?>

<!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php exit; ?>