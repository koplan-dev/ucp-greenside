<?php 
	@session_start();
	include_once('modules/settings.php');
	if(!isset($_SESSION['usuario'])){
		header('Location: index');
	}
	$usuario = $_SESSION['usuario'];
	require_once('static-pages/head.php');
?>

<body oncontextmenu='return false' ondragstart='return false' ">

	<?php require_once('static-pages/menusuperior.php'); ?>
	<div class="content well well-small col-md-12 col-xs-12 ">
		<div class="row-fluid " style="padding-top: 40px; ">
			<div class="col-md-12 ">	   
				<div class="col-md-9 ">
					<?php if(!isset($_GET['ath'])){  
						$tempo = 5000;
						echo $javascript;
						echo '
						<h2>Painel de Controle do Administrador | Aplicações</h2>'; 


						echo '<div class="col-md-12 " style="margin-bottom: 20px; ">
						<div class="panel panel-default ">
						<!-- Default panel contents -->
						<div class="panel-heading ">Avaliações Pendentes</div>

						<!-- Table -->
						<table class="table table-bordered table-striped ">
						<thead>
						<tr>
						<th>ID</th>
						<th>Personagem</th>
						<th>Usuário</th>
						<th></th>
						</tr>
						</thead>
						<tbody>';

						$sq = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Status`='0' ");
						while ($info = mysqli_fetch_assoc($sq)){

							$idav = $info['ID'];
							$charname = $info['Name'];
							$username =  $info['Username'];
							$var = "javascript:abrir( 'avperson?idvar=$idav', 'Aplicação de $charname') ";
							echo '<tr>
							<th scope="row ">'.$idav.'</th>
							<td>'.$charname.'</td>
							<td>'.$username.'</td>
							<td><a href=" '.$var.' " ><button type="button " name="idvar "  class="btn btn-primary but " data-toggle="modal " data-target=".bs-example-modal-lg ">Avaliar</button></a></td>

							</tr>';
						}
						echo '</tbody>
						</table>
						</div>
						</div>'; 
					}
                    if ($_GET['ath'] == 3){

                        $tempo = 5000;

						echo $javascript;

						echo '

						<h2>Painel de Controle do Administrador | Avaliações</h2>';





						echo '<div class="col-md-12 " style="margin-bottom: 20px; ">

						<div class="panel panel-default ">

						<!-- Default panel contents -->

						<div class="panel-heading ">Avaliações Concluidas</div>



						<!-- Table -->

						<table class="table table-bordered table-striped ">

						<thead>

						<tr>

						<th>ID</th>

						<th>Personagem</th>

						<th>Usuário</th>
						
						<th>Status</th>
						
						<th>Admin</th>

						<th></th>

						</tr>

						</thead>

						<tbody>';



						$sq = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Status`='1' OR '2' ");

						while ($info = mysqli_fetch_assoc($sq)){



							$idav = $info['ID'];

							$charname = $info['Name'];

							$username =  $info['Username'];

                            $status =  $info['Status'];
                            $status = str_replace("1 ", "Aceito ", $status);
                            $status = str_replace("2 ", "Negado ", $status);

                            $admin =  $info['AdminLevel'];

                            $var2 = "javascript:abrir( 'seeperson?idvar=$idav', 'Aplicação de $charname') ";


							echo '<tr>

							<th scope="row ">'.$idav.'</th>

							<td>'.$charname.'</td>

							<td>'.$username.'</td>

							<td>'.$status.'</td>
							
							<td>'.$admin.'</td>

                            <td><a href=" '.$var2.' " ><button type="button " name="idvar "  class="btn btn-primary but " data-toggle="modal " data-target=".bs-example-modal-lg ">Ver</button></a></td>

							</tr>';

						}

						echo '</tbody>

						</table>

						</div>

						</div>';

					}

					if ($_GET['ath'] == 2){
						$numerocontas = mysqli_query($connect, "SELECT * FROM `masters` WHERE 1 ");
						$numerocontas = mysqli_num_rows($numerocontas);
						$numeropersonagens = mysqli_query($connect, "SELECT * FROM `players` WHERE 1 ");
						$numeropersonagens = mysqli_num_rows($numeropersonagens);
						$media = $numeropersonagens / $numerocontas;
						echo '<div class="col-md-12 ">';
						echo '<h2>Estatísticas</h2>';
						echo '<div class="col-md-6 "><div class="panel panel-default ">
						<div class="panel-heading "><span class="glyphicon glyphicon-user "></span> Contas/Personagens</div>
						<div class="panel-body ">
						<nobr><b>Número de contas:</b> '.$numerocontas.'</nobr><br />
						<nobr><b>Número personagens:</b> '.$numeropersonagens.'</nobr><br />
						<nobr><b>Média Personagens/Contas:</b> '.$media.'</nobr>
						</div>
						</div></div>';

						$numerocarros = mysqli_query($connect, "SELECT * FROM `vehicles` WHERE 1 ");
						$numerocarros = mysqli_num_rows($numerocarros);
						$mediacarros = $numerocarros / $numeropersonagens;
						echo '<div class="col-md-6 "><div class="panel panel-default ">
						<div class="panel-heading "><span class="glyphicon glyphicon-road "></span> Veiculos</div>
						<div class="panel-body ">
						<nobr><b>Número de veículos:</b> '.$numerocarros.'</nobr><br />
						<nobr><b>Veículos por player:</b> '.$mediacarros.'</nobr><br />
						<br />
						</div>
						</div></div>';
						$infomoney = mysqli_query($connect, "SELECT `Bank`, sum(`Bank`) soma_money, `Cash`, sum(`Cash`) soma_mao FROM `players` WHERE 1 ");
						while ($moneys = mysqli_fetch_assoc($infomoney)){
							$bancomoney = $moneys['soma_money'];
							$maomoney = $moneys['soma_mao'];
						}
						$infocasa = mysqli_query($connect, "SELECT `StoredCash`, sum(`StoredCash`) soma_casa FROM `houses` WHERE 1 ");
						while ($moneycasa = mysqli_fetch_assoc($infocasa)){
							$casamoney = $moneycasa['soma_casa'];

						}
						$infoempresa = mysqli_query($connect, "SELECT `BizzEarnings`, sum(`BizzEarnings`) soma_casa FROM `bizz` WHERE 1 ");
						while ($moneyempresa = mysqli_fetch_assoc($infoempresa)){
							$moneysempresa = $moneyempresa['soma_empresa'];

						}
						if ($moneysempresa == 0){
							$moneysempresa = "0 ";
						}
						$totalmoney = $bancomoney + $maomoney + $moneyempresa + $casamoney;
						$mediadinheiro = ($bancomoney + $maomoney + $moneyempresa + $casamoney) / $numeropersonagens;

						echo '<div class="col-md-6 "><div class="panel panel-default ">
						<div class="panel-heading "><span class="glyphicon glyphicon-usd "></span> Economia do Servidor</div>
						<div class="panel-body ">
						<nobr><b>Banco:</b> $'.$bancomoney.'</nobr><br />
						<nobr><b>Dinheiro em mãos:</b> $'.$maomoney.'</nobr><br />
						<nobr><b>Dinheiro em circulação:</b> $'.$totalmoney.'</nobr><br />
						<nobr><b>Cofre de casas:</b> $'.$casamoney.'</nobr><br />
						<!--<nobr><b>Cofre de empresas:</b> $'.$moneysempresa.'</nobr><br />-->
						<nobr><b>Média de dinheiro por player:</b> $'.intval($mediadinheiro).'</nobr><br />
						</div>
						</div></div>';
						/*$inforarma = mysqli_query($connect, "SELECT * FROM `droparmas` WHERE `Com`> 0"); $inforarma2 = mysqli_query($connect, "SELECT * FROM `droparmas` WHERE `NoChao` > 0"); $inforarma = mysqli_num_rows($inforarma); $inforarma2 = mysqli_num_rows($inforarma2); $somarma3 = $inforarma + $inforarma2; $armapplayer = $somarma3 / $numeropersonagens; echo '
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-road"></span> Armas</div>
            <div class="panel-body">
                <nobr><b>Número de armas:</b> '.$somarma3.'</nobr><br />
                <nobr><b>Armas por player:</b> '.$armapplayer.'</nobr><br />
                <br />
            </div>
        </div>
    </div>'; */ echo '
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-road"></span> Rank Jogadores</div>
            <div class="panel-body">'; echo '
                <table class="table">
                    <thead class="table-striped">
                        <tr>
                            <th scope="col">Personagem</th>
                            <th scope="col">Usúario</th>
                            <th scope="col">Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr> '; $queryjogadores = mysqli_query($connect, "SELECT `Name`, `Username`, `Bank` + `Cash` as `totalEco` FROM `players` ORDER BY `totalEco` DESC LIMIT 0,10 "); while ($inforicos = mysqli_fetch_assoc($queryjogadores)){ $nomerich = $inforicos['Name']; $usuariorich = $inforicos['Username']; $moneyrich = $inforicos['totalEco']; echo '
                        <tr>
                            <th>'.$nomerich.'</th>
                            <th>'.$usuariorich.'</th>
                            <th> $'.$moneyrich.'</th>
                        </tr>'; } echo '</tbody>
                </table>
                <br />
            </div>
        </div>
    </div>'; echo '</div>'; } if ($_GET['ath'] == 1){ echo '
    <div class="col-md-12" style="margin-bottom: 20px;">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Postagem de divulgação</div>
            <div class="panel-body">
                <form method="POST">
                    <div class="col-md-5 ">
                        <input placeholder="Título" type="text" name="titulo" class="form-control" />
                    </div>
                    <div class="col-md-6 col-md-push-1">
                        <input type="text" placeholder="Link imagem" name="imagem" class="form-control"></div>
            </div>
            <hr />
            <textarea name="texto" class="form-control col-md-offset-1" style="margin-top: 0px; margin-bottom: 0px; height: 200px; width: 80%!important; resize: none;" placeholder="Digite seu texto aqui, detalhadamente. (Limite: 2000 caracteres)" maxlength="5000">'.$historia.'</textarea>
            <button type="submit" class="col-md-offset-4 btn btn-primary" style="margin-top: 10px; width: 200px; margin-bottom: 10px;" name="save"><strong>Salvar</strong></button>
        </div>
    </div>
    </form>'; if (isset($_POST['save']) && $_POST['titulo'] != NULL){ $titulo = $_POST['titulo']; $imagem = $_POST['imagem']; $texto = $_POST['texto']; $dataregis = $data.", ".$hora; mysqli_query($connect, "INSERT INTO `ucp_posts` (`mensagem`, `imagem`, `por`, `data`, `titulo`) VALUES ('$texto', '$imagem', '$usuario', '$dataregis', '$titulo');"); echo "
    <div class='alert alert-success col-md-8 col-md-offset-2'>
        <center><strong>Postagem realizada com sucesso.</strong></center>
    </div>"; } } ?>

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

    <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        function abrir(URL, janela) {

            var width = 1205;
            var height = 558;

            var left = 85;
            var top = 60;

            window.open(URL, janela, 'width=' + width + ', height=' + height + ', top=' + top + ', left=' + left + ', scrollbars=1, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=yes');

        }

    </script>
</body>

</html>
