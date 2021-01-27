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
	

	<div class="content well well-small col-md-12 col-xs-12 " style="display: table; ">
		<div class="row-fluid " style="padding-top: 40px; ">

			<div class="col-md-12 ">     
				<div class="col-md-9 "  id="apagar ">
				
					<?php 	if (!isset($_GET['changepass'])){
						$sz = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username`='$usuario' ");
						if(mysqli_num_rows($sz) == 1){
							while($dadosconta = mysqli_fetch_assoc($sz)){
							        $idusuario = $dadosconta['id'];
								$ultimoip = $dadosconta['IP'];
								$email = $dadosconta['EMail'];
								$registradoem = $dadosconta['RegisterDate'];
								$ultimologin = $dadosconta['LoginDate'];
								$linkperfil = $dadosconta['perfilforum'];
								$ticketsuser = $dadosconta['tickets'];
							}
						}
						?>
						<h2>Minha conta</h2>


						<h3>Informações da conta</h3>
						
						<div class="col-md-12 ">
						
							<div class="col-md-3 ">
								<label class="control-label ">Usuário: <b><?php echo $usuario; ?></b></label>
							</div>
							<div class="col-md-4 ">
								<label class="control-label ">Último IP: <b><?php echo $ultimoip; ?></b></label>
									
							</div></body>
							<div class="col-md-5 ">
								<label>Data de registro: <b><?php echo $registradoem; ?></b></label>
							</div>
						</div>
				
						<br>
						<br>
						<br>
						<h3>Alterar Dados</h3>
						<form method="POST " action=" " accept-charset="UTF-8 " class="form-horizontal ">
								<div class="form-group ">
													
								<div class="col-md-8 ">
									
        </div>
       
        </div>
    </body>
    <div class="form-group ">

        <label for="email" class="control-label pull-left">Email</label>
        <div class="col-md-11">
            <input class="form-control" name="email" type="text" value="<?php echo $email; ?>" id="email">
        </div>
    </div>
    <div class="form-group ">
        <label for="perfil" class="control-label pull-left">Perfil do fórum (LINK)</label>
        <div class="col-md-9">
            <input class="form-control" name="linkperfil" type="text" value="<?php echo $linkperfil; ?>" id="perfil">
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="form-group">
        <label for="" class="control-label"><h4>Segurança</h4></label>
        <div class="controls">
            <a href="?changepass" class="col-md-offset-1 btn btn-default">Alterar Senha</a>
        </div>
    </div>
    <hr />
    <div class="form-actions">
        <button id="button" autocomplete="off" type="submit" class="btn btn-primary pull-right" name="save">Salvar</button>
    </div>
    </form>
    <?php 
						if (isset($_POST['save'])){
							$email = $_POST['EMail'];
							$linkperfil = $_POST['linkperfil'];
							mysqli_query($connect, "UPDATE `masters` SET `EMail` = '$email', `perfilforum` = '$linkperfil' WHERE `Username` ='$usuario'");
							echo "<script>window.location = 'meuspersonagens.php';</script>";
						}
					} 
					else{
						?>
    <h2>Alterar Senha</h2>
    <div class="col-md-12">
        <form method="POST">
            <div class="col-md-6 col-md-offset-4" style="margin-top: 80px;">
                <input autofocus type="password" required placeholder="Sua senha atual" class="form-control col-md-4" name="antigasenha" style="margin-bottom: 10px;" />
                <input autofocus type="password" required placeholder="Nova senha" class="form-control col-md-4" name="senha" style="margin-bottom: 10px;" />
                <input type="password" required placeholder="Confirmar nova senha" class="form-control col-md-4" style="margin-bottom: 10px;" name="nsenha">
                <button type="submit" style="margin-bottom: 10px;" class="btn btn-primary col-md-offset-4 col-md-4" style="" name="salvar">Salvar</button>
            </div>
        </form>
    </div>
    <a href="minhaconta" class="btn btn-default">Voltar</a>
    <?php 
					/*	if (isset($_POST['salvar'])){
							if ($_POST['senha'] == $_POST['nsenha']){
								$antigasenha = $_POST['antigasenha'];
								$antigasenha =  hash('whirlpool', $antigasenha);

								$validarsenha = mysqli_query($connect,"SELECT `Password` FROM `masters` WHERE `Password` = '$antigasenha' AND `Username` = '$usuario'");
								if (mysqli_num_rows($validarsenha)){
									$senha = $_POST['senha'];
									$senha = hash('whirlpool', $senha);
									mysqli_query($connect, "UPDATE `masters` SET `Password` = '$senha',`codesenha` = '' WHERE `Username` = '$usuario'");
									echo "<div class='col-md-4 col-md-offset-5 alert alert-success'><center>Sua senha foi alterada com sucesso.</center></div>";
									echo "<script>alert('Sua senha foi alterada com sucesso.');
									window.location = 'minhaconta';</script>";
								}
								else{
									echo "<div class='col-md-6 col-md-offset-4 alert alert-danger'><center>Sua senha atual é inválida.</center></div>";
								}
							}
							else{
								echo "<div class='col-md-6 col-md-offset-4 alert alert-danger'><center>A senha digitada nos campos Nova senha e Confirmar nova senha não são iguais.</center></div>";
							}
						}  */
						
						if(isset($_POST['salvar'])){
							if ($_POST['senha'] == $_POST['nsenha']){
								$antigasenha = mysql_real_escape_string($_POST['antigasenha']);
								//$antigasenha = $_POST['antigasenha'];
								$antigasenha =  hash('whirlpool', $antigasenha);
								$nome = mysql_real_escape_string($_SESSION['usuario']);
								$validarsenha = mysqli_query($connect,"SELECT `Password` FROM `masters` WHERE `Password` = '$antigasenha' AND `Username` = '$nome'");
								if (mysqli_num_rows($validarsenha)){
									$senha = mysql_real_escape_string($_POST['senha']);
									//$senha = $_POST['senha'];
									//$senha = hash('whirlpool', $senha);
									mysqli_query($connect, "UPDATE `masters` SET `Password` = '$senha',`codesenha` = '' WHERE `Username` = '$nome'");
									echo "<div class='col-md-4 col-md-offset-5 alert alert-success'><center>Sua senha foi alterada com sucesso.</center></div>";
									echo "<script>alert('Sua senha foi alterada com sucesso.');
									window.location = 'minhaconta';</script>";
								}
								else{
									echo "<div class='col-md-6 col-md-offset-4 alert alert-danger'><center>Sua senha atual é inválida.</center></div>";
								}
							}
							else{
								echo "<div class='col-md-6 col-md-offset-4 alert alert-danger'><center>A senha digitada nos campos Nova senha e Confirmar nova senha não são iguais.</center></div>";
							}
						}
					}?>
    </div>
    <?php  if (isset($_GET['beneficio'])){
			echo "<script>document.getElementById('apagar').innerHTML = '';</script>";
		?>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">Tickets(
                <?=$ticketsuser; ?>)</div>
            <div class="panel-body">
                <?php
   if ($ticketsuser >= 10 &&  $ticketsuser < 20|| $ticketsuser >= 20 && $ticketsuser < 40 || $ticketsuser == 40){
       if (!isset($_POST['continuar_bene'])){
           echo '<form method="POST">
           Selecione o personagem:<br />
           <select class="form-control" name="personid">';
           $dadosPerson = mysqli_query($connect, "SELECT * FROM `players` WHERE `Username` = '$usuario'");
           while ($dados_personagens = mysqli_fetch_assoc($dadosPerson)){
               ?>
                    <option value="<?=$dados_personagens['ID']; ?>">
                        <?=$dados_personagens['Name'];?>
                    </option>
                    <?php
           }
           echo '
           </select>
           <center><button type="submit" class="btn btn-success" name="continuar_bene" style="margin-top: 10px;">Continuar</button></center>
           </form>';
        
        }
  
           else{
             if ($ticketsuser >= 10 &&  $ticketsuser < 20){
              $id_person = $_POST['personid'];
mysqli_query($connect, "UPDATE `masters` SET `tickets` = '0' WHERE `Username` = '$usuario'");
          
       $beneficio1 = array("2 Namechanges", "2 Trocas de número", "2 Lutas personalizadas", "100 créditos para celular", "US$ 1,000");
       $sortear = rand(0, 4);
        
       switch ($sortear){
           case 0 :
               echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
               mysqli_query($connect, "UPDATE `characters` SET `NameChange` = `NameChange` + 2 WHERE `ID` = '$id_person'");
               break;
             case 1 :
               echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
                 mysqli_query($connect, "UPDATE `characters` SET `AlterNumber` = `AlterNumber` + 2 WHERE `ID` = '$id_person'");
               break;
               case 2 :
                   echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
                 mysqli_query($connect, "UPDATE `characters` SET `AlterLuta` = `AlterLuta` + 2 WHERE `ID` = '$id_person'");
                   break;
            case 3 :
                 echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
mysqli_query($connect, "UPDATE `characters` SET `Creditos` = `Creditos` + 100 WHERE `ID` = '$id_person'");
                 break;
                 case 4:
                     echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
                     mysqli_query($connect, "UPDATE `characters` SET `BankMoney` = `BankMoney` + 1000 WHERE `ID` = '$id_person'");
                     break;
                     
        
       }
             }
         if ($ticketsuser >= 20 &&  $ticketsuser < 40){
              $id_person = $_POST['personid'];
mysqli_query($connect, "UPDATE `masters` SET `tickets` = '0' WHERE `Username` = '$usuario'");
          
       $beneficio1 = array("3 Namechanges", "3 Trocas de número", "3 Lutas personalizadas", "150 créditos para celular", "US$ 2,000");
       $sortear = rand(0, 4);
        
       switch ($sortear){
           case 0 :
               echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
               mysqli_query($connect, "UPDATE `characters` SET `NameChange` = `NameChange` + 3 WHERE `ID` = '$id_person'");
               break;
             case 1 :
               echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
                 mysqli_query($connect, "UPDATE `characters` SET `AlterNumber` = `AlterNumber` + 3 WHERE `ID` = '$id_person'");
               break;
               case 2 :
                   echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
                 mysqli_query($connect, "UPDATE `characters` SET `AlterLuta` = `AlterLuta` + 3 WHERE `ID` = '$id_person'");
                   break;
            case 3 :
                 echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
mysqli_query($connect, "UPDATE `characters` SET `Creditos` = `Creditos` + 150 WHERE `ID` = '$id_person'");
                 break;
                 case 4:
                     echo "<div class='col-md-6 col-md-offset-3' style='text-align: center; font-size: 25pt; border-color: black; border-width: 1px; border-style: solid; background: #eee; border-radius: 6px; padding-top: 8px; padding-bottom: 10px;'>$beneficio1[$sortear]</div>";
                     mysqli_query($connect, "UPDATE `characters` SET `BankMoney` = `BankMoney` + 2000 WHERE `ID` = '$id_person'");
                     break;
                     
        
       }
       
        }
          echo "<div class='col-md-12 alert alert-success' style='text-align: center; margin-top: 10px;'>O benefício foi adicionado ao seu personagem automaticamente.</div>";
       }
   
       /*if ($ticketsuser == 20){
           
       }*/
   }
   else{
       echo "<span class='alert alert-warning col-md-12' style='text-align: center;'>Em contrução...</span>";
   }
   ?>
            </div>
        </div>
        <a href="minhaconta" class="btn btn-default" style="text-align: right;">Voltar</a>
    </div>
    <?php	} ?>
        <div class="col-md-3">
            <?php require_once('static-pages/avisolateral.php'); ?>
            <?php  require_once('static-pages/menulateral.php'); ?>
        </div>
        </div>

        </div>
        </div>
        </div>
        <?php require_once('static-pages/rodape.php'); 
exit;?>

        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="assets/js/bootstrap.min.js"></script>
        </body>

        </html>
