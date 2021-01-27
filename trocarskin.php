<?php 
@session_start();
include_once('modules/settings.php');
if(!isset($_GET['person']) || !isset($_SESSION['usuario'])){
	header('Location: index');
}
require_once('static-pages/head.php');
?>

<body  ondragstart='return false'  oncontextmenu='return false'>
	<?php require_once('static-pages/menusuperior.php'); ?>

	<div class="content well well-small col-md-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">	   
				<div class="col-md-9">
					<?php 	

					$idperson = mysql_real_escape_string($_GET['person']);
					$usuario = $_SESSION['usuario'];
					$s = "SELECT * FROM `players` WHERE `ID` = '$idperson' AND `Username` = '$usuario'";

					$s = mysqli_query($connect, $s);
					$s1 = mysqli_num_rows($s);
					if ($s1 == 0){
						echo '<div class="alert alert-danger">Personagem inválido. <a href="meuspersonagens">Clique aqui para retornar.</a></div>';
					}

					else{
						while ($per = mysqli_fetch_assoc($s)){
							$sexo = $per['Gender'];
						}

						$skinsproibidas = array(0, 265, 266, 267,275, 276, 277, 278, 279,280, 281, 282, 283, 284, 285, 286, 287, 288, 289, 99);
						$skinsmas = array(1,2,3,4,5,6,7,8,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,32,33,34,35,36,37,42,43,44,45,46,47,48,49,50,51,52,57,58,59,60,61,62,66,67,68,70,71,72,73,78,79,80,81,82,83,84,86,94,95,96,97,98,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,132,133,134,135,136,137,142,143,146,147,149,153,154,155,156,158,159,160,161,162,163,164,165,166,167,168,170,171,173,174,175,176,177,179,180,181,182,183,184,185,186,187,188,189,200,202,203,204,206,208,209,210,212,213,217,220,221,222,223,227,228,229,230,234,235,236,239,240,247,248,249,250,252,253,254,255,258,259,260,261,262,264,268,269,270,271,272,273,289,290,291,292,293,294,295,296,297,299, 9,10,11,12,13,31,39,40,41,53,54,55,56,63,64,65,69,75,76,77,85,87,88,89,90,91,92,93,129,130,131,138,139,140,141,145,148,150,151,152,157,169,178,190,191,192,193,194,195,196,197,198,199,201,205,207,211,214,215,216,219,224,225,226,231,232,233,237,238,251,256,257,263,298);
						$valorskinsmas = count($skinsmas);
						$arraySkins = $skinsmas;  // Operador Ternário, se o sexo for igual a 1 ele atribui o array $skinsmas para o $arraySkins, se não for, atribui $skinfem.

						/* $x = isset($_GET['pag']) ? $_GET['pag'] : "1";
						if ($x > 1){
							$x = $x * 30;
							$xa = $x + 30;
						}
						else{
							$xa = $x + 30;
						}
						$click = 'style: border-color: red;';
						echo '<form method="POST">';
						
						
						//for($skin = $x; $skin < $xa; ){
						$skin = $x;
						$incrementador = 0; */

						
				/*		do {
							$skin++;
							if(in_array("$skin", $skinsproibidas) == 0){ // Verifica se $skin existe dentro de $skinsproibidas, se não existir ele segue a execução.
								if (in_array($skin, $arraySkins) > 0){
									
									$key = array_search($skin, $arraySkins); // Verifica se $skin existe dentro de $arraySkins e retorna a posição dele no array.
									if($key!==false){ // Operador not identical, verifica se é falso e se $key é do mesmo tipo de false ( compara boolean com boolean)
										unset($arraySkins[$key]); // Deleta do $arraySkins a posição do valor atual de $skin;
									}
									if ($xa < $skin){

									}
									else{
									echo '<button name="skin" onclick="" type="submit" value="'.$skin.'" class="col-md-2 divs" style="box-shadow: 0 0 6px 2px #b0b2ab; margin-right: 20px; display:block;"><center><div style="background: #f3f3f3; border-radius: 5px;"><img src="images/skins/skinssamp/Skin_'.$skin.'.png" style="width: 90px;">
									</center></button>';
									$incrementador++; // Variável de controle para o do-while, só é incrementada caso ache alguma skin compativel.
								}
								}
								

							}
						} 


						while($incrementador < 30);
					}
					*/
					echo '<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
					<div class="panel-heading">Alterar Skin</div>
					<div class="panel-body">
					<form method="POST">
					<input  type="text"  class="form-control btn" name="skin" placeholder="ID Skin" required size="3"/><br /><br />
					<center><button name="salvarskin" class="btn btn-default">Visualizar</button></center>
					</form>
					</div>
					</div>
					</div>';
				}

				if (isset($_POST["salvarskin"])){
					$skinpost = $_POST["skin"];
					if(in_array("$skinpost", $skinsproibidas) == 0){	
						echo '<center><div class="well col-md-12"><button autofocus readonly name="skin" onclick="" type="submit" value="'.$skinpost.'" class="well well-small col-md-offset-5 col-md-2 divs" style="box-shadow: 0 0 6px 2px #b0b2ab; margin-right: 20px; display:block;"><center><div style="background: #f3f3f3; border-radius: 5px;"><img src="assets/images/skins/'.$skinpost.'.png" style="width: 90px;">
						</center></button><form method="POST"><button name="salvar" type="submit" class="btn btn-success col-md-offset-5 col-md-2 " value="'.$skinpost.'">Salvar</button></form></div></center>';
					}
					else{
						echo '<div class="col-md-4 col-md-offset-4 alert alert-danger">A skin selecionada não é permitida.</div>';
					}

				}
				if(isset($_POST['salvar']))
				{			
						$skinpost = $_POST["salvar"];
						mysqli_query($connect, "UPDATE `players` SET `Skin` = '$skinpost' WHERE `ID` = '$idperson'");
						echo '<div class="col-md-4 col-md-offset-4 alert alert-success">Skin alterada.</div>';
						
				}
					?>
				</div>
				<div class="col-md-3">
					<?php 

					require_once('static-pages/avisolateral.php');
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