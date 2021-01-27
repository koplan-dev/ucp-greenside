<?php
@session_start();
include_once('modules/settings.php');
$usuario = $_SESSION['usuario'];
require_once('static-pages/head.php');
?>

    <body>

        <?php   $inicio = 1;
  require_once('static-pages/menusuperior.php'); ?>

        <div class="content well well-small col-md-12 col-xs-12" style="">
            <div class="row-fluid" style="margin: 0 auto;">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="" data-slide-to="0" class="active"></li>
                        <li data-target="" data-slide-to="1"></li>
                        <li data-target="" data-slide-to="2"></li>
                        <li data-target="" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="assets/images/slides/slide.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="assets/images/slides/slide1.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="assets/images/slides/slide2.jpg" alt="" class="img-responsive">
                        </div>
                        <div class="item">
                            <img src="assets/images/slides/slide3.jpg" alt="" class="img-responsive">
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
       
                </div>
            </div>
            <br />
            <br />
            <?php require_once('static-pages/avisolateral.php'); ?>
            <div class="row-fluid" style="padding-top: 40px;">
                <div class="col-md-12">
                    <div class="col-md-9">

                        <?php 	 
                       
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $page2 =  $page;
        $page = ($page - 1) * 3;


        $querypost = mysqli_query($connect, "SELECT * FROM `ucp_posts` ORDER BY `ID` DESC LIMIT $page, 3");
        $contar = mysqli_num_rows($querypost);

        while ($linha = mysqli_fetch_assoc($querypost)){
          $titulo = $linha['titulo'];
          $mensagem = $linha['mensagem'];
          $imagem = $linha['imagem'];
          $por = $linha['por'];
          $data = $linha['data'];
          echo '   <div class="well well-small article">
          <h2><b>'.$titulo.'</b></h2>
          <hr style="border: 0;  border-top: 1px solid #FFF;">  
          <p><center><img alt="" src="'.$imagem.'" class="img-responsive"></center><br /><br />  
          '.$mensagem.'<br />
          <br />
          </p>
          <hr style="background: white;">
          <span class="pull-right">Escrito por <b>'.$por.' </b>, em <b>'.$data.'</b></span>
          <br>
          </div>';
        } 
        echo '<center><form method="GET"><div class="btn-group" role="toolbar" aria-label="...">';
        $querypost = mysqli_query($connect, "SELECT * FROM `ucp_posts` ORDER BY `ID` DESC");
        $contar = mysqli_num_rows($querypost);
        $i = $contar / 3;
        for ($x = 0; $x < $i; $x++){
          $x1 = $x + 1;
          if ($x1 == $page2){
            echo '
            <button type="submit" name="p" value="'.$x1.'" class="btn btn-default active">'.$x1.'</button>';
          }
          else{
           echo '
           <button type="submit" name="p" value="'.$x1.'" class="btn btn-default">'.$x1.'</button>';
         }
       }
       echo '</div></form></center>';

       ?>
                    </div>
                    <div class="col-md-3"> <br />
                        
			<a href="https://discord.gg/fkUpzna"><img src="https://cfs.redcountyrp.com/img/icons/discord.png" alt="Discord" style="height: 48px; width: 48px;"></a>
			<a href="#"><img src="https://cfs.redcountyrp.com/img/icons/fb.png" alt="Facebook" style="height: 48px; width: 48px;"></a>
			<a href="#"><img src="https://cfs.redcountyrp.com/img/icons/steam.png" alt="Steam" style="height: 48px; width: 48px;"></a>
			<a href="#"><img src="https://cfs.redcountyrp.com/img/icons/email.png" alt="Email us" style="height: 48px; width: 48px;"></a>
 <br />
 <br />
                        <?php 
      $u = $_SESSION['usuario'];  if($u == NULL){ 
       
       echo '<h2> Entrar </h2>
       <form method="POST" action="login.php">
       <div class="input-group input-group-sm" style="margin-bottom: 20px;">
       <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
       <input type="text" class="form-control" name="usuario" placeholder="Usuário" aria-describedby="sizing-addon3">
       </div>
       <div class="input-group input-group-sm" style="margin-bottom: 20px;">
       <span class="input-group-addon" id="sizing-addon4"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span></span>
       <input type="password" class="form-control" placeholder="Senha" name="senha" aria-describedby="sizing-addon4">
       <input type="hidden" name="redirecionado" value="1" /> 
       </div>
       <div class="btn-group col-md-12">
	   <!-- <div class="g-recaptcha" data-sitekey="6LfjpmYUAAAAAALdkmSzwqiO5Zu1xLFuz0euQQo2"></div> --!>
       <button class="btn btn-primary btn-block " name="entrar" type="submit" style="background: #0062CC; color: #FFF; transition: background-position .1s linear; box-shadow: inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);">Entrar</button>
       <a href="registro" class="btn btn-block" style="background: #eee; color: black;    box-shadow: inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05); margin-bottom: 15px;">Registrar</a>
       <center><a href="recuperar" style="color: #777; text-decoration: none!important; margin-top: 10px;" >Esqueceu sua senha?</a></center>
       </div> 
       </form>';
       
     }  else{ require_once('static-pages/menulateral.php');}

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
