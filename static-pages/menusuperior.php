<div class="container" style="margin-top: 40px!important;">
</div>
<div class="container" style="margin-top: 1px!important;">
    <nav class="navbar navbar-default" style="background-image: linear-gradient(to bottom, #ffffff, #f2f2f2);">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
                <a class="navbar-brand" href="index" style="">
         <img alt="AMRP Logo" src="assets/images/logo.png" style="max-width: 100%;  height: auto; vertical-align: middle; border: 0; position: relative; margin-top:-55px;">
       </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li <?php if ($inicio==1 ){echo 'class="active"';} ?>><a href="index">Home <span class="sr-only">(current)</span></a></li>
                    <li><a target="_blank" href="https://forum.greensiderp.com.br">Fórum</a></li>
                    <li <?php if($staff==1 ){echo 'class="active"';}?>><a href="staff">Staff</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Changelog<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a target="_blank" href="#">Server</a></li>
                            <li><a target="_blank" href="#"> User Control Panel</a></li>
                        </ul>
                    </li>
                    <li><a href="samp://">Jogar</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php  $u = $_SESSION['usuario'];  if($u == NULL){ echo " login "; }  else{ echo "logout ";} ?>">
                            <?php  $u = $_SESSION['usuario'];  if($u == NULL){ echo "Login"; }  else{ echo "Logout";} ?> </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
