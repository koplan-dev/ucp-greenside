<?php
@session_start();
if(isset($_SESSION['usuario'])){
  header('location: index');
}
require_once('modules/settings.php'); 
require_once('static-pages/head.php');
?>

<body oncontextmenu='return false' ondragstart='return false'">
  <?php require_once('static-pages/menusuperior.php'); ?>
  
  <div class="content well well-small col-md-12 col-xs-12" style="display: table;">
    <div class="row-fluid" style="padding-top: 40px;">
      <div class="col-md-12">	   
        <div class="col-md-9">
          <?php	 

          if (isset($_POST['entrar'])){
			$usuario = preg_replace('/[^[:alnum:]-]/','',$_POST['usuario']);
            $senha = $_POST['senha'];
			
            if( empty($usuario) or empty($senha)){
              echo '<div class="alert alert-danger" role="alert">Há campos vazios</div>';
            }
            else{
              $senha = hash('whirlpool', $senha);
              $sql =  "SELECT `Username`, `Password`  FROM `masters` WHERE `Username` = '$usuario' AND `Password` = '$senha'";
              $checar = mysqli_query($connect, $sql);
              $verificar = mysqli_num_rows($checar);
              if(isset($_COOKIE['usuario'])){       
                $usuario = $_COOKIE['usuario'];
              }
              $verban = mysqli_query($connect, "SELECT * FROM `blacklist` WHERE `Username` = '$usuario'");
			  $verbanip = mysqli_query($connect, "SELECT * FROM `blacklist` WHERE `IP` = '$ip'");
			  
			  if (mysqli_num_rows($verban) == 1 or mysqli_num_rows($verbanip) >= 1){
				while ($dadosban = mysqli_fetch_assoc($verbanip)){
				  $userban = $dadosban['Username'];
				  $adminban = $dadosban['BannedBy'];
				  $motivoban = $dadosban['Reason'];
				  $databan = $dadosban['Date'];
				}
				while ($dadosban = mysqli_fetch_assoc($verban)){
				  $userban = $dadosban['Username'];
				  $adminban = $dadosban['BannedBy'];
				  $motivoban = $dadosban['Reason'];
				  $databan = $dadosban['Date'];
				}
				setcookie("usuario", "$userban");
				mysqli_query($connect, "UPDATE `blacklist` SET `IP` = '$ip' WHERE `Username` = '$userban'");
				echo '<div class="alert alert-danger">Sua conta está banida.<br />
				<b>Motivo do banimento:</b> '.$motivoban.'<br />
				<b>Banido por:</b> '.$adminban.'<br />
				<b>Horário:</b> '.$databan.'<br />
				</div>';
			return;
			  }

             if ($verificar == 1){
                while ($dados = mysqli_fetch_assoc($checar)){
                  $usuario = $dados['Username'];
                }
                if(mysqli_num_rows($verban) == 0 && mysqli_num_rows($verbanip) == 0){
                  $_SESSION['usuario'] =  $usuario;
                  mysqli_query($connect,"UPDATE `masters` SET `IP` = '$ip' WHERE `Username` = '$usuario'");
                  
                  $checatodosadmin = mysqli_query($connect, "SELECT *, max(Admin) total_admin FROM `players` WHERE `Username` = '$usuario'");
                //  $checartodos_testers = mysqli_query($connect, "SELECT *, max(Tester) total_tester FROM `players` WHERE `Username` = '$usuario'");
                  
                  while($checaradm = mysqli_fetch_assoc($checatodosadmin)){
                $resultadoAdmin = $checaradm['total_admin'];
                  }
                     
                 /* while($checartester = mysqli_fetch_assoc($checartodos_testers)){
                $resultadoTester = $checartester['total_tester'];
                  }
				  
				  
                  if ($resultadoTester > 0){
                      mysqli_query($connect, "UPDATE `masters` SET `AdminLevel` = '1' WHERE `Username` = '$usuario'");
                  }*/
				  
                      if($resultadoAdmin != 0){
                          $resultadoAdmin++;
                             mysqli_query($connect, "UPDATE `masters` SET `AdminLevel` = '$resultadoAdmin' WHERE `Username` = '$usuario'");
                      }
                  }
                  
                  
               
                // echo('<script type="text/javascript">window.location.replace("meuspersonagens.php");</script>');
				 
				 echo('<script type="text/javascript">window.location.href = "meuspersonagens";</script>');
				  // header('location: meuspersonagens');
                  
                }
            
            }
          
          }
          
if ($verificar == 0){
                echo '<div class="alert alert-danger" role="alert">Usuário ou senha inválidos</div>';
}
          ?>
          
          
          <form method="POST" action="login.php">
            <center><div class="input-group input-group-sm col-md-5" style="margin-bottom: 20px;">
              <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
              <input type="text" class="form-control" name="usuario" placeholder="Usuário" aria-describedby="sizing-addon3">
            </div>
            <div class="input-group input-group-sm col-md-5" style="margin-bottom: 20px;">
              <span class="input-group-addon" id="sizing-addon3"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
              <input type="password" class="form-control" placeholder="Senha" name="senha" aria-describedby="sizing-addon3">
              
            </div>
            <div class="btn-group col-md-12">
			<div class="g-recaptcha" data-sitekey="6LfjpmYUAAAAAALdkmSzwqiO5Zu1xLFuz0euQQo2"></div>
              <button type="submit" class="btn btn-primary btn-block col-md-12" name="entrar" type="submit" style="background: #16b7ab; color: #FFF; transition: background-position .1s linear; box-shadow: inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);">Entrar</button>
              <a class="btn btn-block" href="registro" style="background: #eee; color: black; box-shadow: inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05); margin-bottom: 15px;">Registrar</a>
              <a href="recuperar" style="color: #777; text-decoration: none!important; margin-top: 10px;" >Esqueceu sua senha?</a>
            </div>
          </center>
        </form>
		
		
		

      </div>

      <div class="col-md-3">
        <?php require_once('static-pages/avisolateral.php'); ?>
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