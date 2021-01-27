<?php 
session_cache_expire(360);
@session_start();
include_once('modules/settings.php');
if(!isset($_SESSION['usuario'])){
	header('Location: index');
}
require_once('static-pages/head.php'); 

$usuario = $_SESSION['usuario'];
?>


<body ondragstart='return false' oncontextmenu='return false'>

    <?php require_once('static-pages/menusuperior.php'); ?>
    <div class="content well well-small col-md-12" style="display: table;">
        <div class="row-fluid" style="padding-top: 40px;">
            <div class="col-md-12">
                <div class="col-md-9">
                    <?php 	
					
					$s = "SELECT * FROM `players` WHERE `Username` = '$usuario'";
					$s = $s = mysqli_query($connect, $s);
					$s1 = mysqli_num_rows($s);
					$s2 = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Username` = '$usuario' AND `Status` = '0'");
					$s2 = mysqli_num_rows($s2);
					if ($s1 == 4 || $s2 == 1){
						echo '<div class="alert alert-danger">Você possui o máximo de personagens permitidos e/ou tem algum personagem aguardando avaliação. <a href="meuspersonagens">Clique aqui para retornar</a>  ao inicio.</div>';
					}

					else{
						$sxx1 = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Username` = '$usuario' AND `Status` = '2'");
						$sxx = mysqli_num_rows($sxx1);
						if ($sxx == 1){
							while ($info = mysqli_fetch_assoc($sxx1)){
								$idupdate = $info['ID'];
								$adm = $info['AdminLevel'];
								$motivo = $info['Motivo'];
								$avaliadov = $info['VezesAvaliado'];
								$charname = $info['Name'];
								$nome = $info['Nome'];
								$sobrenome = $info['Sobrenome'];
								
								$nascimento = $info['Birthdate'];
								$historia = $info['History'];
								$origem = $info['Origin'];
							}

							echo '<h2>Reenviar aplicação para criar personagem</h2>
							<div class="alert alert-danger">
							Sua aplicação foi negada. <br />
							Admin: '.$adm.'<br />
							Motivo: '.$motivo.'<br />
							Avaliado: '.$avaliadov.' Vez(es).
							</div>
							<div class="alert alert-warning">
							<col-md- style="color:red;">Atenção</col-md-> -&gt; Os dados solicitados abaixo(nome, local de origem, nascimento etc.) são os dados do seu PERSONAGEM.
							</div>';
						}
						else{
							echo '<h2>Criar novo personagem</h2>
							<div class="alert alert-notice">
							Para criar um novo personagem é preciso enviar uma aplicação que será avaliada por nossos administradores.
							</div>
							<div class="alert alert-warning">
							<col-md- style="color:red;">Atenção</col-md-> -&gt; Os dados solicitados abaixo(nome, local de origem, nascimento etc.) são os dados do seu PERSONAGEM.
							</div>';
						}

						if(isset($_POST['cadastrar'])){
							if ($usuario == NULL){
								setcookie("user",  $usuario);
								$usuario = $_COOKIE['user'];
							}
							$id = $_POST['ID'];
							$nome = $_POST['nome'];
							$sobrenome = $_POST['sobrenome'];
							
							$nascimento = $_POST['nascimento'];
							$origem =  $_POST['origem'];
							$historia = $_POST['historia'];
							$sexo = $_POST['sexo'];
							
							$charname = $nome .'_'. $sobrenome; 

							$pes = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Name` = '$charname'");
							$pes = mysqli_num_rows($pes);
							$pes1 = mysqli_query($connect, "SELECT * FROM `players` WHERE `Name` = '$charname'");
							$pes1 = mysqli_num_rows($pes1);
							if($sxx == 1 && $pes1 == 0){
								mysqli_query($connect, "UPDATE `avaliacoes` SET `Name` = '$charname', `Gender`= '$sexo', `History` = '$historia', `Origin` = '$origem', `Birthdate` = '$nascimento', `Nome` = '$nome', `Sobrenome` = '$sobrenome', `Status` = '0' WHERE `ID` = $idupdate");
								
								//echo('<script type="text/javascript">location.href = meuspersonagens.php;</script>');
								echo('<script type="text/javascript">window.location.href = "meuspersonagens";</script>');
							}
							else{
								if($pes1 == 1 || $pes == 1 && $sxx == 0){
									echo '<div class="alert alert-danger">Este pesonagem já está sendo utilizado.</div>';
								}
								else{
									$executarquery = "INSERT INTO `avaliacoes` (`Username`, `Name`, `Birthdate`, `Origin`, `History`, `Gender`, `Nome`, `Sobrenome`) VALUES ('$usuario', '$charname', '$nascimento', '$origem', '$historia', '$sexo', '$nome', '$sobrenome')";
									mysqli_query($connect, $executarquery);
							
									//echo('<script type="text/javascript">location.href = meuspersonagens.php;</script>');
									echo('<script type="text/javascript">window.location.href = "meuspersonagens";</script>');

								}
							}
						}

						echo '
<form id="" class="form form-vertical" method="post">
    <div class="row-fluid">
        <fieldset>
            <legend>Informações Gerais</legend>
            <div class="col-md-12">
			
                <div class="col-md-6">
                    <input style="width:100%;" id="nnn" placeholder="Nome do personagem" value="'.$nome.'" class="form-control" type="text" autocomplete="off" name="nome" required="" maxlength="">
				</div>			
				
                <div class="col-md-6">
                    <input style="width:100%;" id="nnn" placeholder="Sobrenome do personagem" value="'.$sobrenome.'" class="form-control" type="text" autocomplete="off" name="sobrenome" required="" maxlength="">
                </div>
				
            </div>
    </div>
	
    <div class="row-fluid">
        <div class="col-md-12">
		
            <div class="col-md-6" style="margin-top: 15px;">
                <input style="width:100%;" value="'.$nascimento.'" placeholder="Data de nascimento (DD/MM/AA)" class="form-control" input type="date" min="1965-01-01" autocomplete="off" name="nascimento" required="">
            </div>
			
            <div class="col-md-6" style="margin-top: 15px;">
                <input style="width:100%;" value="'.$origem.'" placeholder="Local de origem" class="form-control" type="text" autocomplete="off" name="origem" required="">
            </div>
			
        </div>
    </div>
	
	<div class="row-fluid">
        <div class="col-md-12">
	
            <div class="col-md-6" style="margin-top: 15px;">
                <select style="width:100%;" class="form-control" name="sexo">
						<option value="1">Masculino</option>
						<option value="2">Feminino</option>
				</select>
            </div>
		
			
        </div>
    </div>
	
	</br></br>
    </fieldset>

<!--						<div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;"><fieldset>
						<legend>Aparência</legend>
						<span class="alert alert-warning col-md-12">A aparência não é salva quando sua aplicação é negada!</span>
						<div class="col-md-3" style="">
						Altura
						<select name="altura" style="width:100%;" class="form-control" >
						<option value="1">1,10m</option>
						<option value="2">1.20m</option>
						<option value="3">1,25m</option>
						<option value="4">1,30m</option>
						<option value="5">1,35m</option>
						<option value="6">1,40m</option>
						<option value="7">1,45m</option>
						<option value="8">1,50m</option>
						<option value="9">1,55m</option>
						<option value="10">1,60m</option>
						<option value="11">1,65m</option>
						<option value="12">1,70m</option>
						<option value="13">1,75m</option>
						<option value="14">1,80m</option>
						<option value="15">1,85m</option>
						<option value="16">1,90m</option>
						<option value="17">1,95m</option>
						<option value="18">2,00m</option>
						<option value="19">2,10m</option>
						</select></div>
						<div class="col-md-3" style="">
						Peso
						<select name="peso" style="width:100%;" class="form-control" >
						<option value="1">50kg</option>
						<option value="2">60kg</option>
						<option value="3">70kg</option>
						<option value="4">80kg</option>
						<option value="5">90kg</option>
						<option value="6">100kg</option>
						<option value="7">110kg</option>
						<option value="8">120kg</option>
						<option value="9">130kg</option>
						<option value="10">140kg</option>
						<option value="11">150kg</option>
						</select></div>
						<div class="col-md-6" style="">
						Etnia
						<select name="etnia" style="width:100%;" class="form-control" >
						<option value="1">Caucasiano</option>
						<option value="2">Negro</option>
						<option value="3">Asiático</option>
						<option value="4">Hispânico</option>
						<option value="5">Mediterrâneo</option>
						<option value="6">Desconhecida</option>
						</select></div>

						<div class="col-md-6" style="margin-top: 15px;">
						Cor dos olhos
						<select name="olhos" style="width:100%;" class="form-control" >
						<option value="1">Castanhos-claro</option>
						<option value="2">Castanhos-escuro</option>
						<option value="3">Azuis</option>
						<option value="4">Verdes</option>
						</select></div>
						<div class="col-md-6" style="margin-top: 15px;">
						Cabelo
						<select name="cabelo" style="width:100%;" class="form-control">
						<option value="1">Preto</option>
						<option value="2">Branco</option>
						<option value="3">Grisalho</option>
						<option value="4">Loiro</option>
						<option value="5">Afro</option>
						<option value="6">Careca</option>
						</select></div>
						</fieldset></div> -->

						<div style="height: 80px;"></div>
						<div class="control-group" >
						<label>Escreva uma pequena história sobre seu personagem (pelo menos 2 parágrafos)</label>
						<div class="controls" style="">

						<textarea id="icolavel" ondrop="return false" onKeyDown="'.$fuverificar.'" name="historia" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 200px; width: 100%!important; resize: none;" placeholder="Digite sua resposta aqui, detalhadamente. (Limite: 5000 caracteres)" maxlength="5000" required="">'.$historia.'</textarea>
						</div>
						</div>
						<br>
						<br />
						<br>
						<br>
						<div class="alert alert-warning">
						Após sua aplicação ser aceita, para entrar no servidor você deverá utilizar para o login o nome do usuário e a senha de sua conta no UCP.
						O personagem só será realmente criado no servidor quando a aplicação for aceita, portanto, até lá, esse personagem estará indisponível.
						</div>
						<div class="control-group">
						<label></label>
						<div align="center" class="controls">
						<input type="submit" name="cadastrar" class="btn btn-primary" value="Enviar">
						</div>
						</div>
						</form>';

					}
					?>




                </div>
                <div class="col-md-3">
                    <?php require_once('static-pages/avisolateral.php'); ?>

                    <?php 


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
    <script>
        function Verificar()

        {

            var ctrl = window.event.ctrlKey;

            var tecla = window.event.keyCode;

            if (ctrl && tecla == 86) {
                event.keyCode = 0;
                event.returnValue = false;
            }

        }

    </script>
    <script>
        < /body> <
        /html>
