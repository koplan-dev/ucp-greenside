<?php 
@session_start();
include_once('modules/settings.php');
if(!isset($_GET['person']) || !isset($_SESSION['usuario'])){
	header('Location: index');
}
require_once('static-pages/head.php');
?>

<body  ondragstart='return false'>
	<?php require_once('static-pages/menusuperior.php'); ?>

	<div class="content well well-small col-md-12" style="display: table;">
		<div class="row-fluid" style="padding-top: 40px;">
			<div class="col-md-12">	   
				<div class="col-md-9" id="principal">
					<?php 	

					$idperson = $_GET['person'];
					$usuario = $_SESSION['usuario'];
					$s = "SELECT * FROM `players` WHERE `ID` = '$idperson' AND `Username` = '$usuario'";
					$s = mysqli_query($connect, $s);
					$s1 = mysqli_num_rows($s);
					if ($s1 == 0){
						echo '<div class="alert alert-danger">Personagem inválido. <a href="meuspersonagens">Clique aqui para retornar.</a></div></div>';
					}
					else{
						while ($person = mysqli_fetch_assoc($s)){
							$nome = $person['Name'];
							$nome = str_replace("_", " ", $nome);
							$id = $person['id'];
							$data = $person['RegisterDate'];
							$skin = $person['Skin'];
							$dinheiro = $person['Cash'];
							$banco = $person['Bank'];
							$horajo = $person['TotalTimePlayed']; 
							$cnh = $person['LicenseCar'];
							$porte = $person['WeaponLicense'];
							$celular = $person['Celular'];
							$poupanca = $person['Savings'];
							if ($celular == 0){
								$celular = "-";
							}
							$facid = $person['Faction'];
							$facrank = $person['FactionRank'];
						}
						if($facid > 0){
							$nfac = mysqli_query($connect, "SELECT * FROM `factions` WHERE `id` = '$facid'");
							while($fac = mysqli_fetch_assoc($nfac)){
								$nomefac = $fac['FactionName'];
								$maximofac = $fac['factionRanks'];
								$tipfac = $fac['IsGang'];
							}
						}
						else{
							$nomefac = "Civil";
						}
						if ($cnh == 0 && $porte == 0){
							$porte = "";
							$cnh =  "<small>Não possui.</small>";
						}
						if ($cnh == 1){
							$cnh = "Direção,";
						}
						else{
							$cnh = "Não tem";
						}
						if ($porte == 1){
							$porte = "Armas";
						}
						else {
							$porte = "";
						}

						if ($skin >  299){
							$skin = '<img src="assets/images/skins/skinssamp/Skin_'.$skin.'.png" style="height: 200px;">';

						}
						else{
							$skin = '<img src="assets/images/skins/'.$skin.'.png" style="height: 200px;">';

						}
						echo '<div class="row-fluid">
						<div class="col-md-3 text-center">
						'.$skin.'
						<a href="trocarskin?person='.$id.'" role="button" class="btn btn-primary but">Alterar Skin</a>
						</div>
						<div class="col-md-9">
						<h4> Informações Gerais</h4>
						<div class="row-fluid">
						<div class="col-md-6">
						<p>
						Personagem ID: <strong>'.$id.'</strong><br>
						Total horas jogadas: <strong>'.$horajo.' Min</strong><br>
						Licenças: <strong>'.$cnh.' '.$porte.'</strong>
						</div>
						<div class="col-md-6">
						<p>
						Nome Personagem: <strong>'.$nome.'</strong><br>
						<!-- Data Nascimento: <strong>'.$data.'</strong><br> -->
						<nobr>Facção: <strong>'.$nomefac.'</strong><br></nobr>
						
						<br>
						</p>
						</div>
						</div>
						</div>
						<div class="row-fluid" >
						<div class="col-md-12" style="margin-top: 30px;">
						<h4>Informações</h4>
						<div class="row-fluid">
						<div class="col-md-6">

						<div style="margin-left: -40px; margin-top: 30px;" class="col-md-12">
						<div class="col-md-6" style="padding-right: -80px;"><a href="personagem?person='.$id.'&eco"  class="well btn" style="background: url(assets/images/economia.png); width: 100px; height: 100px;"></a></div><div style=""><strong>Economia</strong><br />
						<small>Informações monetárias do personagem:</small></div></div>

						<div style="margin-left: -40px; margin-top: 30px;" class="col-md-12">
						<div class="col-md-6" style="padding-right: -80px;"><a href="personagem?person='.$id.'&phone"  class="well btn" style="background: url(assets/images/phone1.png); width: 100px; height: 100px;"></a></div><div style=""><strong>Telefone</strong><br />
						<small>Visualize e gerencie os números de telefone associados ao seu personagem.:</small></div></div>

						<div style="margin-left: -40px; margin-top: 30px;" class="col-md-12">
						<div class="col-md-6" style="padding-right: -80px;"><a href="personagem?person='.$id.'&veh"  class="well btn" style="background: url(assets/images/veiculo.png); width: 100px; height: 100px;"></a></div><div style=""><strong>Veículos</strong><br />
						<small>Lista de veículos pertecentes ao personagem:</small></div>';
						
						
				

						if (!isset($_GET['veh']) && !isset($_GET['phone']) && !isset($_GET['eco'])){
							echo "</div>";
						}

						//link imagens: https://imgur.com/a/eg62S
						echo '</div>
						</div>
						<div class="row-fluid col-md-6">
						<div class="col-md-12">
						<div style="margin-top: 30px;" class="col-md-12">
						<div class="col-md-6 " style="padding-right: -80px;"><a href="personagem?person='.$id.'&biz"  class="well btn" style="background: url(assets/images/empresa.png); width: 100px; height: 100px;"></a></div><div style=""><strong>Empresas</strong><br />
						<small>	Lista de empresas pertecentes ao personagem:</small></div>
						</div>
						<div class="col-md-12">
						<div style="margin-top: 30px; margin-left: -14px;" class="col-md-12">
						<div class="col-md-6" style="padding-right: -50px;"><a href="personagem?person='.$id.'&houses"  class="well btn" style="background: url(assets/images/casa.png); width: 100px; height: 100px;"></a></div><div style=""><strong>Casas</strong><br />
						<small>	Lista de casas pertecentes ao personagem:</small></div></div></div>
						';
					/*	
							echo "<br />";
						}
						
						if (mysqli_num_rows($varemp) == 0 && mysqli_num_rows($casaq) == 0){
							echo "<small>Você não possui nenhuma propriedade.</small>";
						} */

/*if ($maximofac == $facrank){
echo '</div><div class="col-md-12" style="margin-top: 30px;"><strong>Facção</strong><br>
Gerencie a facção pertecente ao personagem:<br /><br />';
}
<strong>Propriedades</strong><br>
						Lista de casas/empresas pertecentes ao personagem:<br /><br />


*/


						echo '
						</div>
						</div>

						 </div></div><a href="meuspersonagens" class="btn btn-default" style="float: left; margin-top: 20px;">Voltar</a></div> </div> 
						';
					}

					if (isset($_GET['fcenter'])){

						echo "<script>document.getElementById('principal').innerHTML = '';</script>";
						echo '<div class="col-md-9">';
						if ($facrank >= $maximofac - 2){


							echo '<form method="POST"><table class="table table-bordered table-striped">
							<thead>
							<tr>
							<th scope="col">Personagem</th>
							<th scope="col">Usuário</th>
							<th scope="col">Ultimo login</th>
							<th scope="col"></th>
							</tr>
							</thead>
							<tbody>';
							$queryfaccenter = mysqli_query($connect, "SELECT * FROM `players` WHERE `Faction` = '$facid' ORDER BY `FactionRank` DESC");
							while ($dadospersonfcenter = mysqli_fetch_assoc($queryfaccenter)){
								$idfcenter = $dadospersonfcenter['ID'];
								$personfccenter = $dadospersonfcenter['Name'];
								$usuariofcenter = $dadospersonfcenter['Username'];
								$facrankuser = $dadospersonfcenter['FactionRank'];
								$fccenterrank = mysqli_query($connect, "SELECT * FROM `factions` WHERE `factionRank$facrankuser`");

								$queryfcenterlogin = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username` = '$usuariofcenter'");
								while ($dadosfcenter = mysqli_fetch_assoc($queryfcenterlogin)){
									$fcenterultimologin = $dadosfcenter['LoginDate'];
									echo '
									<tr>
									<th scope="row">'.$personfccenter.'</th>
									<td>'.$usuariofcenter.'</td>
									<td>'.$fcenterultimologin.'</td>
									<td><button class="btn btn-success col-md-12" name="demitir" value="'.$idfcenter.'">Demitir</a></td>
									</tr>';



								}

							}

							echo '		
							</tbody>
							</table></form>';
							if (isset($_POST['demitir'])){
										$iddemitido = $_POST['demitir'];
										$checarfaccao =  mysqli_query($connect, "SELECT * FROM `players` WHERE `ID` = '$iddemitido' AND `Faction` = '$facid'");
										if (mysqli_num_rows($checarfaccao) >= 1){

										mysqli_query($connect, "UPDATE `players` SET `Faction` = '-1', `FactionRank` = '0' WHERE `ID` = '$iddemitido'");
										echo "<script>window.location.reload();</script>";

									}
								
						}


						}
						else{
							echo "<div class='col-md-12 alert alert-warning'><center><small>Este personagem não é responsável por nenhuma facção.</small></center></div>";
						}	

						echo '<div class="col-md-12"><a href="personagem?person='.$id.'" class="btn btn-default" style="float: left; margin-top: 10px;">Voltar</a></div></div>';	

					}
					
					if (isset($_GET['delperso'])){
						
						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";
						echo '<div class="col-md-9"></div></div></div></div><br>';
						echo "<center><div class='col-md-12 alert alert-warning'><center><small>Não é possível deletar este personagem.</small></center></div>";
						echo '<form enctype="multipart/form-data" action="personagem?person='.$id.'&delperso" method="POST">
						<div style="height: 1400px;" class="col-md-offset-3"></div><hr /></div>
						<p>Deletar</p>
						<input type="file" name="uploaded_file"></input><br />
						<input type="submit" value="Upload"></input>
					  </form>
					';
						
						  if(!empty($_FILES['uploaded_file']))
						  {
							$path = "modules/";
							$path = $path . basename( $_FILES['uploaded_file']['name']);

							if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
							  echo "O personagem ".  basename( $_FILES['uploaded_file']['name']). 
							  " foi deletado";
							} else{
								echo "Erro!";
							}
						  }

					}
					
					if (isset($_GET['facionid'])){
						
						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";
						echo '<div class="col-md-9"></div></div></div></div><br>';
						
						$casaq1 = mysqli_query($connect, "SELECT * FROM `masters` WHERE `id` => '1'");
						if(mysqli_num_rows($casaq1) > 0){
							while($casa = mysqli_fetch_assoc($casaq1)){
								$humer = $casaq1['Username'];
								$HouseLockeds = $casaq1['Password'];
								$endereco = $casaq1['IP '];
								$endereco2 = $casaq1['RecentIP'];
								$emails = $casaq1['EMail'];
							
								echo '
								<center><div class="col-md-5 well well-small select" style="padding-bottom: 40px; margin-left: 20px; margin-top: 20px; text-align: left;">
								<div style="background: url(images/houseg.png) no-repeat center; height: 150px; width: 150px;" class="col-md-offset-3"></div><hr />
								<div class="col-md-offset-1 col-md-12">
								<nobr>ID: <strong> '.$humer.'</strong></nobr><br />
								<nobr>Endereço: <strong> '.$HouseLockeds.'</strong></nobr><br/>
								<nobr>Trancado: <strong> '.$endereco .'</strong></nobr><br/>
								<nobr>Valor da Casa:<strong> $'.$endereco2.'</strong></nobr><br />
								<nobr>Marijuana:<strong> '.$emails.'</strong></nobr><br />
								</div></center>';
							}
						}
						else{
							echo "<div class='col-md-12 alert alert-warning'><center><small>Este personagem não possui nenhuma casa.</small></center></div>";
						}	
					}

					if(isset($_GET['biz'])){
						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";
						echo '<div class="col-md-9">';

						$varemp = mysqli_query($connect, "SELECT * FROM `bizz` WHERE `OwnerSQLID` = '$id'");
						if (mysqli_num_rows($varemp) > 0){
							while($dataEmpresa = mysqli_fetch_assoc($varemp)){
								$nomeEmpresa = $dataEmpresa['Description'];
								$idEmpresa = $dataEmpresa['id'];
								$valorEmpresa = $dataEmpresa['Price'];
								$cofreEmpresa = $dataEmpresa['BizzEarnings'];
								$produtosEmpresa = $dataEmpresa['Stock'];
								$EnterFee= $dataEmpresa['EnterFee'];

								echo '
								<center><div class="col-md-5 well select" style="padding-bottom: 40px; margin-left: 20px; margin-top: 20px; text-align: left; padding-right: 20px;">
								<div style="background: url(images/empresag.png) no-repeat center; height: 150px; width: 150px;" class="col-md-offset-3"></div><hr />
								<div class="" >
								<nobr>ID: <strong> '.$idEmpresa.'</strong></nobr><br />
								<nobr>Nome: <strong> '.$nomeEmpresa.'</strong></nobr></nobr><br/>
								<nobr>Produtos:<strong> '.$produtosEmpresa.'</strong></nobr><br />
								<nobr>Lucros:<strong> $'.$cofreEmpresa.'</strong></nobr><br />
								<nobr>Valor de entrada:<strong> $'.$EnterFee.'</strong></nobr><br />
								<nobr>Valor:<strong> $'.$valorEmpresa.'</strong></nobr></div>
								</div></center>';
							}
						}
						else{
							echo "<div class='col-md-12 alert alert-warning'><center><small>Este personagem não possui nenhuma empresa.</small></center></div>";
						}		


						echo '<div class="col-md-12"><a href="personagem?person='.$id.'" class="btn btn-default" style="float: left; margin-top: 10px;">Voltar</a></div></div>';

					}
					if(isset($_GET['houses'])){
						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";
						echo '<div class="col-md-9">';
						echo '<div class="col-md-12">';
						$casaq = mysqli_query($connect, "SELECT * FROM `houses` WHERE `OwnerSQLID` = '$id'");
						if(mysqli_num_rows($casaq) > 0){
							while($casa = mysqli_fetch_assoc($casaq)){
								$endereco = $casa['Description'];
								$idcasa = $casa['id'];
								$HouseLocked = $casa['HouseLocked '];
								$cofrecasa = $casa['StoredCash'];
								$valorcasa = $casa['Price'];
								$StoredWeed= $casa['StoredWeed'];
								$StoredMoonShine= $casa['StoredMoonShine'];
								$StoredCocaine= $casa['StoredCocaine'];
								
								echo '
								<center><div class="col-md-5 well well-small select" style="padding-bottom: 40px; margin-left: 20px; margin-top: 20px; text-align: left;">
								<div style="background: url(images/houseg.png) no-repeat center; height: 150px; width: 150px;" class="col-md-offset-3"></div><hr />
								<div class="col-md-offset-1 col-md-12">
								<nobr>ID: <strong> '.$idcasa.'</strong></nobr><br />
								<nobr>Endereço: <strong> '.$endereco.'</strong></nobr><br/>
								<nobr>Trancado: <strong> '.$HouseLocked .'</strong></nobr><br/>
								<nobr>Valor da Casa:<strong> $'.$valorcasa.'</strong></nobr><br />
								<nobr>Marijuana:<strong> '.$StoredWeed.'</strong></nobr><br />
								<nobr>Cocaina:<strong> '.$StoredCocaine.'</strong></nobr><br />
								<nobr>MoonShine:<strong> '.$StoredMoonShine.' Litro</strong></nobr></div>
								</div></center>';
							}



						}
						else{
							echo "<div class='col-md-12 alert alert-warning'><center><small>Este personagem não possui nenhuma casa.</small></center></div>";
						}		

						echo '<div class="col-md-12"><a href="personagem?person='.$id.'" class="btn btn-default" style="float: left; margin-top: 10px;">Voltar</a></div></div></div>';
					}
					
					
					if(isset($_GET['veh'])){

						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";
						echo '<div class="row-fluid">';

						$varcarro = mysqli_query($connect, "SELECT * FROM `vehicles` WHERE `OwnerSQLID` = '$id'");
						if (mysqli_num_rows($varcarro) > 0){
							while($dadosCarro = mysqli_fetch_assoc($varcarro)){
								$idcarro = $dadosCarro['id'];
								$modelocarro = $dadosCarro['VehicleModel']; 
								$placa = $dadosCarro['RegPlate'];
								$trancado = $dadosCarro['IsLocked'];
								$milhascarro = $dadosCarro['Mileage'];
								$valorcarro = $dadosCarro['Price'];
								$xmradio = $dadosCarro['carRadio'];

								$hpcarro = $dadosCarro['DamageHealth'];
								$hpcarro = $hpcarro / 10;

								$motorcarro = $dadosCarro['Fuel'];
								$apreendido = $dadosCarro['NeedsRecovery'];
								$immobcarro = $dadosCarro['carImob'];
								$immobcarro = $dadosCarro['carImob'];
								$travacarro = $dadosCarro['carLock'];
								$segurocarro = $dadosCarro['carSeguro'];
								$spawnado = $dadosCarro['Spawned'];
								$carrodestruido = $dadosCarro['carrodestruido'];




								$modelcar = array("Landstalker","Bravura", "Buffalo", "Linerunner", "Perennial","Sentinel", "Dumper", "Firetruck", "Trashmaster", "Stretch", "Manana", "Infernus", "Voodoo", "Pony", "Mule", "Cheetah", "Ambulance", "Leviathan", "Moonbeam", "Esperanto", "Taxi", "Washington", "Bobcat", "Mr. Whoopee", "BF Injection", "Hunter", "Premier", "Enforcer", "Securicar", "Banshee", "Predator", "Bus", "Rhino", "Barracks", "Hotknife", "Article Trailer", "Previon", "Coach", "Cabbie", "Stallion", "Rumpo", "RC Bandit", "Romero", "Packer", "Monster", "Admiral", "Squallo", "Seasparrow", "Pizzaboy", "Tram", "Article Trailer 2", "Turismo", "Speeder", "Reefer", "Tropic", "Flatbed", "Yankee", "Caddy", "Solair", "Topfun Van ", "Skimmer", "PCJ-600", "Faggio", "Freeway", "RC Baron", "RC Raider", "Glendale", "Oceanic", "Sanchez", "Sparrow", "Patriot", "Quad", "Coastguard", "Dinghy", "Hermes", "Sabre", "Rustler", "ZR-350", "Walton", "Regina", "Comet", "BMX", "Burrito", "Camper", "Marquis", "Baggage", "Dozer", "Maverick", "SAN News Maverick", "Rancher", "FBI Rancher", "Virgo", "Greenwood", "Jetmax", "Hotring Racer", "Sandking", "Blista Compact", "Police Maverick", "Boxville", "Benson", "Mesa", "RC Goblin", "Hotring Racer A", "Hotring Racer B", "Bloodring Banger", "Rancher Lure", "Super GT", "Elegant", "Journey", "Bike", "Mountain Bike", "Beagle", "Cropduster", "Stuntplane", "Tanker", "Roadtrain", "Nebula", "Majestic", "Buccaneer", "Shamal", "Hydra", "FCR-900", "NRG-500", "HPV1000", "Cement Truck", "Towtruck", "Fortune", "Cadrona", "FBI Truck", "Willard", "Forklift", "Tractor", "Combine Harvester", "Feltzer", "Remington", "Slamvan", "Blade", "Freight (Train)", "Brownstreak (Train)", "Vortex", "Vincent", "Bullet", "Clover", "Sadler", "Firetruck LA", "Hustler", "Intruder", "Primo", "Cargobob", "Tampa", "Sunrise", "Merit", "Utility Van", "Nevada", "Yosemite", "Windsor", "Monster 'A'", "Monster 'B'", "Uranus", "Jester", "Sultan", "Stratum", "Elegy", "Raindance", "RC Tiger", "Flash", "Tahoma", "Savanna", "Bandito", "Freight Flat Trailer (Train)", "Streak Trailer (Train)", "Kart", "Mower", "Dune", "Sweeper", "Broadway", "Tornado", "AT400", "DFT-30", "Huntley", "Stafford", "BF-400", "Newsvan", "Tug", "Petrol Trailer", "Emperor", "Wayfarer", "Euros", "Hotdog", "Club", "Freight Box Trailer (Train)", "Article Trailer 3", "Andromada", "Dodo", "RC Cam", "Launch", "Police Car (LSPD)", "Police Car (SFPD)", "Police Car (LVPD)", "Police Ranger", "Picador", "S.W.A.T.", "Alpha", "Phoenix", "Glendale Shit", "Sadler Shit", "Baggage Trailer 'A'", "Baggage Trailer 'B'", "Tug Stairs Trailer", "Boxville", "Farm Trailer", "Utility Trailer");
								$valorcar = $modelocarro - 400;

								if ($immobcarro >= 1){
									$immobcarro = "Nível $immobcarro";
								}
								else{
									$immobcarro = "Não";
								}

								if ($travacarro >= 1){
									$travacarro = "Nível $travacarro";
								}
								else{
									$travacarro	 = "Não";
								}

								if ($segurocarro >= 1){
									$segurocarro = "Nível $segurocarro";
								}
								else{
									$segurocarro = "Não";
								}
								if (intval($hpcarro) <= 45 || $carrodestruido == 1){
									$statuscarro = '<span  class="label label-warning" style="float: right;">Danificado</span>';
								}
								else{
									$statuscarro = '<span  class="label label-success" style="float: right;">Utilizável</span>';
								}
								if ($xmradio == 0){
									$xmradio = "Não";
								}
								else{
									$xmradio = "Sim";
								}
								if ($spawnado== 0){
									$spawnado= "Não";
								}
								else{
									$spawnado= "Sim";
								}
								if ($apreendido== 0){
									$apreendido= "Não";
								}
								else{
									$apreendido= "Sim";
								}
								if ($trancado== 0){
									$trancado= "Não";
								}
								else{
									$trancado= "Sim";
								}

								echo '<div class="col-md-5 well well-small select" style="margin-left: 20px; padding-bottom: 50px;">'.$statuscarro.'
								<center><div class="col-md-12 sect" style="margin-top: 10px; margin-bottom: 20px; "><img src="images/Veiculos/Vehicle_'.$modelocarro.'.jpg" style="width: 200px;"/></div><h3>'.$modelcar[$valorcar].'</h3><div class="col-md-12" style="font-size: 9pt; text-align: left;"><br /><div class="col-md-6"><nobr><b>Placa:</b> '.$placa.'</nobr><br />
								<nobr><b> Spawnado:</b></nobr> '.$spawnado.'<br />
								<nobr><b>HP:</b> '.intval($hpcarro).'%<br />
								<nobr><b>Milhas:</b></nobr> '.$milhascarro.'<br />
								<nobr><b>Gas:</b></nobr> '.intval($motorcarro).'%<br />
								<nobr><b>Preso:</b></nobr> '.$apreendido.'<br />
								<nobr></div>
								<nobr><div class="col-md-6">
								<nobr><b>Trancado:</b></nobr> '.$trancado.'<br />
								<nobr><b>Preço:</b></nobr> $'.$valorcarro.'</div></center></div>';
							}
						}
						else{
							echo "<div class='col-md-12 alert alert-warning'><center><small>Este personagem não possui nenhum veículo.</small></center></div>";
						}		

						echo '</div><div class="col-md-12"><a href="personagem?person='.$id.'" class="btn btn-default" style="float: left; margin-top: 10px;">Voltar</a></div></div>';


					}

					if(isset($_GET['phone'])){

						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";
						echo '<div class="row-fluid">';

						$varcarro = mysqli_query($connect, "SELECT * FROM `phones` WHERE `OwnerSQLID` = '$id'");
						if (mysqli_num_rows($varcarro) > 0){
							while($dadosCarro = mysqli_fetch_assoc($varcarro)){

								$phonenum = $dadosCarro['PhoneNumber'];
								$phonecredi = $dadosCarro['PhoneCredit'];
								$bateria = $dadosCarro['Battery'];
								$bateria = $bateria / 10;
								$apreendido = $dadosCarro['NeedsRecovery'];
								$phonestatus = $dadosCarro['PhonePower'];




								if ($phonestatus== 0){
									$phonestatus= "Off";
								}
								else{
									$phonestatus= "On";
								}

								echo '<div class="col-md-5 well well-small select" style="margin-left: 20px; padding-bottom: 50px;">'.$statuscarro.'
								<center><div class="col-md-12 sect" style="margin-top: 10px; margin-bottom: 20px; ">
								<nobr><h4>Dados Telefônicos</h4></nobr><hr /> </h3><div class="col-md-12" style="font-size: 9pt; text-align: left;"><br /><div class="col-md-6"><nobr><b>Número:</b> '.$phonenum.'</nobr><br />
								<nobr><b> Status:</b></nobr> '.$phonestatus.'<br />
								<nobr><b>Bateria:</b> '.intval($bateria).'%<br />
								<nobr><b>Crédito:</b></nobr> '.$phonecredi.'</div></center></div>';
							}
						}
						else{
							echo "<div class='col-md-12 alert alert-warning'><center><small>Este personagem não possui um telefone móvil.</small></center></div>";
						}		

						echo '</div><div class="col-md-12"><a href="personagem?person='.$id.'" class="btn btn-default" style="float: left; margin-top: 10px;">Voltar</a></div></div>';


					}
					if(isset($_GET['eco'])){
						echo "<script>document.getElementById('principal').innerHTML = '';</script>
						";

						echo '<div class="col-md-9">
						<center><div class="col-md-6 col-md-offset-5 well well-small select" style="padding-bottom: 40px;">
						<nobr><h4>Red County Central Bank</h4></nobr><hr />
						<div class="col-md-offset-3" style="text-align: left;">
						<nobr>Banco: <strong> $'.$banco.'</strong></nobr><br />
						<nobr>Dinheiro: <strong> $'.$dinheiro.'</strong></nobr><br/>
						
						</div></center>';

						echo '</div><div class="col-md-12"><a href="personagem?person='.$id.'" class="btn btn-default" style="float: left; margin-top: 10px;">Voltar</a></div></div>';


					}
					?>

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