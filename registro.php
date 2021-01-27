<?php 
@session_start();
include_once('modules/settings.php');
if(isset($_SESSION['usuario'])){
	header('Location: index.php');
}
require_once('static-pages/head.php');
?>
<body oncontextmenu='return false' ondragstart='return false' >
	<?php require_once('static-pages/menusuperior.php'); ?>

	<div class="content well well-small col-md-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">	   
				<div class="col-md-9">
					<h2 style="">Questionário</h2>

					<?php
					
					if(isset($_POST['continuar'])){
						$use = $_POST['usuario'];
						$ema = $_POST['email'];
						$senha = $_POST['senha'];
						$senha = hash('whirlpool', $senha);
						$sq = "SELECT `Username` FROM `masters` WHERE `Username` = '$use'";
						$sq2 = "SELECT `EMail` FROM `masters` WHERE `EMail` = '$ema'";
						$qu2 = mysqli_query($connect, $sq2);
						$qu2 = mysqli_num_rows($qu2);
						$qu = mysqli_query($connect, $sq);
						$qu = mysqli_num_rows($qu);
						if($qu == 1){
							echo '<div class="alert alert-danger" style="margin-top: 30px; margin-bottom: 30px;"><p style="font-size: 12px;">Este usuário já está sendo utilizado</p></div>';
						}
						elseif($qu2 == 1){
							echo '<div class="alert alert-danger" style="margin-top: 30px; margin-bottom: 30px;"><p style="font-size: 12px;">Este e-mail já está sendo utilizado</p></div>';
						}
						if ($qu2 == 0 && $qu == 0){
							if(isset($_COOKIE['usuario'])){
								$usuario = $_COOKIE['usuario'];
							}
						
						
							$recomendado = isset($_GET['ref']) ? $_GET['ref'] : NULL;
				
							if ($recomendado != NULL){
				$dadoEnviadoRecomendado = 	mysqli_query($connect, "SELECT * FROM `masters` WHERE `ID` = '$recomendado'");
				while ($consultardadocompartilhado = mysqli_fetch_assoc($dadoEnviadoRecomendado)){
				    $TicketsIP = $consultardadocompartilhado['IP'];
				}
				$valirdarIp = mysqli_query($connect, "SELECT * FROM `masters` WHERE `IP` = '$ip'");
				$totalIpEncontrado = mysqli_num_rows($validarIp);
				if ($TicketsIP != $ip && $totalIpEncontrado == 0){
				mysqli_query($connect, "UPDATE `masters` SET `tickets` = `tickets` + 1 WHERE `id` = '$recomendado'");
				}
							}
							$verban = mysqli_query($connect, "SELECT * FROM `blacklist` WHERE `Username` = '$usuario'");
							$verbanip = mysqli_query($connect, "SELECT * FROM `blacklist` WHERE `IP` = '$ip'");
							if(mysqli_num_rows($verban) == 0 && mysqli_num_rows($verbanip) == 0){
								$dataregis = $data.", ".$hora; 
								mysqli_query($connect, "INSERT INTO `masters` ( `Username`, `Password`, `RegisterDate`, `IP`, `EMail`) VALUES ('$use', '$senha', '$dataregis', '$ip', '$ema')");
								$_SESSION['usuario'] = $use;
								echo('<script type="text/javascript">window.location.href = "meuspersonagens";</script>');
							}
							else{
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
								}

							}
						}
					} 

					if ($contador < 8){
						?>

						<form method="POST" id="deletar">
							<div class="well" style="background: white;" >
								<ol>
									<li><b><p>Um policial aborda você sem motivo aparante, o que você faz?</p></b></li>
									<input type="radio" name="pergunta1" value="1" id="1" /> <label for="1"> Perguntar á ele no /b o motivo da abordagem.</label><br />
									<input type="radio" name="pergunta1" value="2" id="2" /> <label for="2"> Seguir completamente IC, independetemente.</label><br />  
									<input type="radio" name="pergunta1" value="3" id="3" /> <label for="3"> Dirigir para longe, já que você não fez nada de errado.</label><br />
									<input type="radio" name="pergunta1" value="4" id="4" /> <label for="4">Descer do seu carro e atirar no policial.</label><br /><br />


									<li><b><p>O que significa "RP"?</p></b></li>
									<input type="radio" name="pergunta2" value="1" id="5" /> <label for="5"> Rollplay.</label><br />
									<input type="radio" name="pergunta2" value="2" id="6" /> <label for="6"> Rollback.</label><br />  
									<input type="radio" name="pergunta2" value="3" id="7" /> <label for="7"> Roleplay.</label><br />
									<input type="radio" name="pergunta2" value="4" id="8" /> <label for="8">Ragnarok.</label><br /><br />

									<li><b><p>Você vê algum praticando bunny-hopping. O que você faz?</p></b></li>
									<input type="radio" name="pergunta3" value="1" id="9" /> <label for="9">Ofender ele porque bunny-hopping é errado.</label><br />
									<input type="radio" name="pergunta3" value="2" id="10" /> <label for="10">Puxa sua pistola e começa a atirar nele.</label><br />  
									<input type="radio" name="pergunta3" value="3" id="11" /> <label for="11">Fazer o mesmo que ele, porque é legal.</label><br />
									<input type="radio" name="pergunta3" value="4" id="12" /> <label for="12">Enviar uma PM para ele, explicando que é contra as regras.</label><br /><br />

									<li><b><p>Qual dos seguintes comandos é OOC?</p></b></li>
									<input type="radio" name="pergunta4" value="1" id="13" /> <label for="13">/PM</label><br />
									<input type="radio" name="pergunta4" value="2" id="14" /> <label for="14">/AME</label><br />  
									<input type="radio" name="pergunta4" value="3" id="15" /> <label for="15">/DO</label><br />
									<input type="radio" name="pergunta4" value="4" id="16" /> <label for="16">/ME</label><br /><br />

									<li><b><p>Qual dos seguintes é um anúncio realista?</p></b></li>
									<input type="radio" name="pergunta5" value="1" id="17" /> <label for="17">Estou vendendo drogas e armas, me ligue.</label><br />
									<input type="radio" name="pergunta5" value="2" id="18" /> <label for="18">Alguém sabe onde eu consigo drogas? :)</label><br />  
									<input type="radio" name="pergunta5" value="3" id="19" /> <label for="19">Compro algum veículo usado, de preferência SUV. </label><br />
									<input type="radio" name="pergunta5" value="4" id="20" /> <label for="20">O ID 12 me roubou, não comprem nada dele.</label><br /><br />

									<li><b><p>Alguém está te ofendendo no PM. O que você faz?</p></b></li>
									<input type="radio" name="pergunta6" value="1" id="21" /> <label for="21">Ofender ele de volta.</label><br />
									<input type="radio" name="pergunta6" value="2" id="22" /> <label for="22">Encontrar ele e matá-lo, depois reportar no fórum.</label><br />  
									<input type="radio" name="pergunta6" value="3" id="23" /> <label for="23">Tirar screenshot e denunciar o jogador no fórum.</label><br />
									<input type="radio" name="pergunta6" value="4" id="24" /> <label for="24">Nenhuma das opções acima</label><br /><br />

									<li><b><p>Um administrador está sendo injusto. O que você deverá fazer?</p></b></li>
									<input type="radio" name="pergunta7" value="1" id="25" /> <label for="25">Floodar o /sos dizendo que o administrador é injusto.</label><br />
									<input type="radio" name="pergunta7" value="2" id="26" /> <label for="26">Começar a insultar o administrador.</label><br />  
									<input type="radio" name="pergunta7" value="3" id="27" /> <label for="27">Ofender sua mãe, sua família e todo ser existente que ele conhece.</label><br />
									<input type="radio" name="pergunta7" value="4" id="28" /> <label for="28">Enviar uma MP no fórum para o Head of Staff.</label><br /><br />

									<li><b><p>Você vê uma viatura policial perseguindo um carro. O que você faz?</p></b></li>
									<input type="radio" name="pergunta8" value="1" id="29" /> <label for="29">Você é um criminoso, então começa a atirar nas viaturas.</label><br />
									<input type="radio" name="pergunta8" value="2" id="30" /> <label for="30">Entra na perseguição e tenta desabilitar o veículo perseguido.</label><br />  
									<input type="radio" name="pergunta8" value="3" id="31" /> <label for="31">Encosta na lateral e deixa que todos passem.</label><br />
									<input type="radio" name="pergunta8" value="4" id="32" /> <label for="32">Tenta atrapalhar a perseguição de alguma forma.</label><br /><br />

									<li><b><p>Selecione uma área na qual você pode cometer um crime.</p></b></li>
									<input type="radio" name="pergunta9" value="1" id="33" /> <label for="33">Binco.</label><br />
									<input type="radio" name="pergunta9" value="2" id="34" /> <label for="34">Hospitais.</label><br />  
									<input type="radio" name="pergunta9" value="3" id="35" /> <label for="35">Departamentos de polícia.</label><br />
									<input type="radio" name="pergunta9" value="4" id="36" /> <label for="36">Headquarter SACFD.</label><br /><br />

									<li><b><p>Qual das alternativas é um bom exemplo de roleplay?</p></b></li>
									<input type="radio" name="pergunta10" value="1" id="37" /> <label for="37">/me KKKKKKKKKKKKKKK.</label><br />
									<input type="radio" name="pergunta10" value="2" id="38" /> <label for="38">/me Compro armas e vendo drogas.</label><br />
									<input type="radio" name="pergunta10" value="3" id="39" /> <label for="39">/me soca a cabeça de John e mata ele.</label><br />
									<input type="radio" name="pergunta10" value="4" id="40" /> <label for="40">/me rí.</label><br /><br />
								</div>

								<center><button type="submit" class="btn btn-success" name="submit">Enviar</button></center>
							</ol>
						</form>
						<?php 
						if (isset($_POST['submit'])){
							$contador = 0;
							if ($_POST['pergunta1'] == 2){
								$contador = $contador + 1;
							}

							if ($_POST['pergunta2'] == 3){
								$contador = $contador + 1;
							}

							if ($_POST['pergunta3'] == 4){
								$contador = $contador + 1;
							}

							if ($_POST['pergunta4'] == 1){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta5'] == 3){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta6'] == 3){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta7'] == 4){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta8'] == 3){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta9'] == 1){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta9'] == 1){
								$contador = $contador + 1;
							}
							if ($_POST['pergunta10'] == 4){
								$contador = $contador + 1;
							}
							if ($contador < 8){
								echo '<div class="alert alert-danger"><center>Você acertou ('.$recomendado.'/10) tente novamente.</center></div>';

							}
							
						}
						

					}
					if ($contador >= 8){

						echo "<script>document.getElementById('deletar').innerHTML = '';</script>";
						echo '<div class="alert alert-warning" style="margin-top: 30px; margin-bottom: 30px;"><p style="font-size: 12px;">Escolha um nome de usuário.</p></div>';


						?>
						<form method="post">
							<div class="controls col-md-12 input-group-sm">
								<input id="" placeholder="Usuário" class="form-control" type="text" autofocus="" pattern="[a-zA-Z0-9]{2,64}" autocomplete="off" name="usuario" required"" style="margin-bottom: 20px;">
								<input id="" placeholder="E-mail" class="form-control" type="email" autocomplete="off" name="email" required" style="margin-bottom: 20px;"">
								<input id="" placeholder="Senha" class="form-control" type="password" autocomplete="off" name="senha" required"" style="margin-bottom: 20px;">
								<button type="submit" class="btn btn-primary col-md-12" name="continuar" style="color: #fff; background-color: #16b7ab;">Continuar</button>
							</div>

						</form>
						<?php } ?>

					</div>
					<div class="col-md-3">
						<?php require_once('static-pages/avisolateral.php'); ?>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php 	require_once('static-pages/rodape.php'); ?>

	<!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>

