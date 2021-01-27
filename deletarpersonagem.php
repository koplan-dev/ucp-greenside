<?php 
@session_start();
include_once('modules/settings.php');
if(!isset($_GET['idchar']) || !isset($_SESSION['usuario'])){
	header('Location: index');
}
require_once('static-pages/head.php');
?>


<body  ondragstart='return false' oncontextmenu='return false'>

	<?php  require_once('static-pages/menusuperior.php'); ?>
	<div class="content well well-small col-md-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">	   
				<div class="col-md-9">
					<?php 	
					$idperson = $_GET['idchar'];
					$usuario = $_SESSION['usuario'];
					$s = "SELECT * FROM `players` WHERE `ID` = '$idperson' AND `Username` = '$usuario'";
					
						if(!isset($_POST['apagar'])){
							echo "<div class='alert alert-warning'> Digite e confirme sua senha para deletar com sucesso o seu personagem.</div>";
							$confirma = "<form method='POST'><input type='password' class='form-control' placeholder='Senha' name='pas'/><form method='POST'><input type='password' class='form-control' placeholder='Confirmar senha' name='conpas'/><button type='submit' name='apagar' class='btn btn-success col-md-12'>Continuar</button></form>";
							echo '<script>
							if(confirm("Você tem certeza que deseja apagar esse personagem?"))
							{
								document.write("'.$confirma.'")
							}
							else
							{
								document.location = "personagem?person='.$idperson.'"
							}
							</script>

							';
						}
						if($_POST['pas'] != $_POST['conpas']){
							mysqli_query($connect, "DELETE FROM `players` WHERE `ID` = '$idperson'");
							echo "<div class='alert alert-warning'> Personagem deletado com sucesso.</div>";
						}
					?>


				</div>
				<div class="col-md-3">
					<?php require_once('static-pages/avisolateral.php');
					require_once('static-pages/menulateral.php');
					?>
				</div>
			</div>

		</div>
	</div>
</div>
<?php require_once('static-pages/rodape.php'); ?>
<!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
<script src="assets/js/bootstrap.min.js"></script>

</body>
</html>