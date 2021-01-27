<?php
@session_start();
if(isset($_SESSION['usuario'])){
	header('location: index');
}
require_once('modules/settings.php'); 
require_once('modules/PHPMailer.php'); 
use PHPMailer\PHPMailer\PHPMailer;
require_once('static-pages/head.php');
date_default_timezone_set('America/Sao_Paulo');

//Create a new PHPMailer instance
$mail = new PHPMailer;
$mail->isSendmail();
$mail->CharSet = 'UTF-8';

?>

<body onkeydown='return checartecla(event)' oncontextmenu='return false' ondragstart='return false'">
	<?php require_once('static-pages/menusuperior.php'); ?>

	<div class="content well well-small col-md-12 col-xs-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">     
				<div class="col-md-9">
					<h2>Recuperar Senha</h2>
					<form method="POST">
						<div class="col-md-6 col-md-offset-4">
							<input type="email" placeholder="E-mail" class="form-control col-md-4" name="email" style="margin-bottom: 10px;"/>
							<input type="text" placeholder="Usuário" class="form-control col-md-4" style="margin-bottom: 10px;" name="usuario">
							<button type="submit" style="margin-bottom: 10px;"  class="btn btn-default col-md-offset-5" style="" name="recuperar">Recuperar</button> 
						</div>
					</form>
					<?
					if (isset($_POST['recuperar'])){
						$email = $_POST['email'];
						$usuario = $_POST['usuario'];
						$veema = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username` = '$usuario' AND `EMail` = '$email'");

						if (mysqli_num_rows($veema) == 1){


							function uniqueAlfa($length=16)
							{
								$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
								$len = strlen($salt);
								$pass = '';
								mt_srand(10000000*(double)microtime());

								for ($i = 0; $i < $length; $i++)

								{

									$pass .= $salt[mt_rand(0,$len - 1)];

								}

								return $pass;

							}
							$code = uniqueAlfa(15);
							mysqli_query($connect, "UPDATE `masters` SET `codesenha` = '$code' WHERE `Username` = '$usuario'");

							$quebra_linha = "\n";
							$emailsender='server@greensiderp.com.br';
							$nomeremetente     = "Greenside Roleplay";
							$emailremetente    = "server@greensiderp.com.br";
							$emaildestinatario = "$email";
							$comcopia          = "";
							$comcopiaoculta    = "";
							$assunto           = "Recuperação de Senha";
							$mensagem2 		   = "";


							/* Montando a mensagem a ser enviada no corpo do e-mail. */
							$mensagemHTML = '<head><meta charset="UTF-8" /></head>
							<div style=" margin: 0 auto;">
							<center><img src="https://greensiderp.com.br/assets/images/logo-mail.png" class="img-fluid" /></center>
							<div><p>Olá, '.$usuario.'<br /><br />
							Seu código para recuperação de seus dados cadastrais é: '.$code.'<br /><br />
							<a href="https://greensiderp.com.br/confirmsenha?user='.$usuario.'&keycode='.$code.'">Clique aqui</a> para continuar.<br />
							<p>Deixamos claro, que seus dados cadastrais, tais como senha e e-mail são sigilosos, portanto, deverão ser de conhecimento apenas do proprietário da conta. Caso haja alguma perda em sua conta, por compartilha-la. Não nos responsabilizaremos.</p>
							
							Att,<br />
							Equipe Greenside Roleplay"

							</p>
							<br />
							</div>

							</div>
							';



							/* Montando o cabeçho da mensagem */
							$headers = "MIME-Version: 1.1".$quebra_linha;
							$headers .= "Content-type: text/html; charset=UTF-8".$quebra_linha;
// Perceba que a linha acima conté"text/html", sem essa linha, a mensagem nãchegaráormatada.
							$headers .= "From: ".$emailsender.$quebra_linha;
							$headers .= "Return-Path: " . $emailsender . $quebra_linha;
							$headers .= "Cc: ".$comcopia.$quebra_linha;
							$headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
							$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
// Note que o e-mail do remetente serásado no campo Reply-To (Responder Para)


			$mail->AddAddress($emaildestinatario);
			$mail->IsHTML(true);
			$mail->Subject  = $assunto;
			$mail->Body = $mensagemHTML;
			$mail->setFrom($emailsender, $nomeremetente);
			$mail->send();
			
			/*if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}*/
							/* Enviando a mensagem */
							/*mail($emaildestinatario, $assunto, $mensagemHTML, $headers, "-r". $emailsender);*/

							/* Mostrando na tela as informaçs enviadas por e-mail */
							
							print '<div class="alert alert-success col-md-6 col-md-offset-4">
							<center><strong>Mensagem enviada com sucesso!</strong></center></div>'; 
							
						}
						else{
							echo '<center><div class="col-md-6 col-md-offset-4 alert alert-danger">Usuário ou email inválido.</div></center>';


						}
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