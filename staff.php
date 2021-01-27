<?php
@session_start();
require_once('modules/settings.php'); 
require_once('static-pages/head.php');
/* 
<21:58:38> "[OFF] R. Howard ($truth)": 808000 - Helper
<21:58:49> "[OFF] R. Howard ($truth)": 40BFFF - Moderator
<21:59:00> "[OFF] R. Howard ($truth)": 00BF40 - Administrator
<21:59:11> "[OFF] R. Howard ($truth)": BF4000 - Supervisory
<21:59:26> "[OFF] R. Howard ($truth)": FF0000 - Manager
*/
?>

    <body ondragstart='return false' oncontextmenu='return false'>

        <?php $staff = 1;
	require_once('static-pages/menusuperior.php'); ?>
        <div class="content well well-small col-md-12 col-xs-12" style="display: table;">

            <div class="row-fluid" style="padding-top: 40px;">
                <div class="col-md-12">
                    <div class="col-md-9">
                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color: #428BCA;">
                                        <h4 class="panel-title" style="color: white;">
                                        <center><strong>Management</strong></center>
                                        </h4>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <?php $query = mysqli_query($connect, "SELECT * FROM `masters` WHERE `AdminLevel` > 4 AND `AdminLevel` < 7");
									if(mysqli_num_rows($query) > 0){
										while ($datainfo = mysqli_fetch_assoc($query)){
											$nameadmin = $datainfo['Username'];
											$consadm = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username` = '$nameadmin'");
											while($infoda = mysqli_fetch_assoc($consadm)){
												$perfilforum = $infoda['perfilforum'];
												echo  '<a target="_blank" href= "'.$perfilforum.'">'.$nameadmin.'</a><br />';
											}
										}

									} ?><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
								<div class="panel-heading " style="background-color: #428BCA; ">
									<h4 class="panel-title " style="color: white; "><center><strong>Lead Admins</strong></center></h4>
								</div>
								<div class="panel-body ">
									<?php $query = mysqli_query($connect, "SELECT * FROM `masters` WHERE `AdminLevel`='3' ");
									if(mysqli_num_rows($query) > 0){
										while ($datainfo = mysqli_fetch_assoc($query)){
											$nameadmin = $datainfo['Username'];
											$consadm = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username`='$nameadmin' ");
											while($infoda = mysqli_fetch_assoc($consadm)){
												$perfilforum = $infoda['perfilforum'];
												echo  '<a target="_blank " href= " '.$perfilforum.' ">'.$nameadmin.'</a><br />';
											}
										}

									} ?><br>
								</div>
							</div>
							
						</div>
					</div>
					<div class="row-fluid ">
						<div class="col-md-12 ">
							<div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color: #428BCA;">
                                        <h4 class="panel-title" style="color: white;">
                                            <center><strong>Admins</strong></center>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <?php $query = mysqli_query($connect, "SELECT * FROM `masters` WHERE `AdminLevel`='2' ");
									if(mysqli_num_rows($query) > 0){
										while ($datainfo = mysqli_fetch_assoc($query)){
											$nameadmin = $datainfo['Username'];
											$consadm = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username` = '$nameadmin'");
											while($infoda = mysqli_fetch_assoc($consadm)){
												$perfilforum = $infoda['perfilforum'];
												echo  '<a target="_blank" href= "'.$perfilforum.'">'.$nameadmin.'</a><br />';
											}
										}

									} ?><br>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="col-md-12">
                                <div class="panel panel-primary">
								<div class="panel-heading " style="background-color: #428BCA; ">
									<h4 class="panel-title " style="color: white; "><center><strong>Testers</strong></center></h4>
								</div>
								<div class="panel-body ">
									<?php $query = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Tester`='1' ");
									if(mysqli_num_rows($query) > 0){
										while ($datainfo = mysqli_fetch_assoc($query)){
											$nameadmin = $datainfo['Username'];
											$consadm = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username`='$nameadmin' ");
											while($infoda = mysqli_fetch_assoc($consadm)){
												$perfilforum = $infoda['perfilforum'];
												echo  '<a target="_blank " href= " '.$perfilforum.' ">'.$nameadmin.'</a><br />';
											}
										}

									} ?><br>
								</div>
							</div>
							
						</div>
						<div class="col-md-12 ">
							<div class="panel panel-primary">
                                    <div class="panel-heading" style="background-color: #428BCA;">
                                        <h4 class="panel-title" style="color: white;">
                                            <center><strong>Trial Admins</strong></center>
                                        </h4>
                                    </div>
                                    <div class="panel-body">
                                        <?php $query = mysqli_query($connect, "SELECT * FROM `masters` WHERE `AdminLevel` = '1'");
									if(mysqli_num_rows($query) > 0){
										while ($datainfo = mysqli_fetch_assoc($query)){
											$nameadmin = $datainfo['Username'];
											$consadm = mysqli_query($connect,"SELECT * FROM `masters` WHERE `Username` = '$nameadmin'");
											while($infoda = mysqli_fetch_assoc($consadm)){
												$perfilforum = $infoda['perfilforum'];
												echo  '<a target="_blank" href= "'.$perfilforum.'">'.$nameadmin.'</a><br />';
											}
										}

									} ?><br>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="col-md-3">
                        <?php require_once('static-pages/avisolateral.php'); ?>
                        <?php if(isset($_SESSION['usuario'])){
						$usuario = $_SESSION['usuario'];
						require_once('static-pages/menulateral.php');
					} ?>
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
