<?php
@session_start();
include_once('modules/settings.php');
if (!isset($_SESSION['usuario']) || !isset($_GET['idvar'])){ 
    exit();
}
$idvar = $_GET['idvar'];
$usuario = $_SESSION['usuario'];
$sq = "SELECT * FROM `masters` WHERE `Username` = '$usuario' AND `AdminLevel` >= 1";
$veradm = mysqli_query($connect, $sq);

if( mysqli_num_rows($veradm) == 0){
    exit();
}else{
    while($dadosdoadmin = mysqli_fetch_assoc($veradm)){
        $leveldoadmin = $dadosdoadmin['nivel'];
    }
}require_once('static-pages/head.php');
?>

    <body ondragstart='return false' oncontextmenu='return false' style="background-image: linear-gradient(to top, #ffffff, #f2f2f2);">
        <?php  $av = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `ID` = '$idvar'");
    if(mysqli_num_rows($av) >= 1){
        while( $avalia = mysqli_fetch_assoc($av)){
            $charname = $avalia['Name'];      
            $charname = str_replace(" ", "*", $charname);    
            $nascimento = $avalia['Birthdate'];    
            $historia = $avalia['History'];    
            $us = $avalia['Username'];  
            $origem = $avalia['Origin'];   
            $sexo = $avalia['Gender'];  
            if($sexo == 1){
                $sexo1 = "Masculino";
            }else{      
                $sexo1 = "Feminino"; 
            }     
            $vezesavaliado = $avalia['VezesAvaliado'];
            $vezesavaliado = $vezesavaliado + 1;   
        } 
    } else{ 
        exit();
        
    }if ($us != $usuario || $leveldoadmin == 5 || $usuario == "Revolts" || $usuario == "Well"){
        
        echo '<div class="col-md-10 col-md-push-1">  <form id="" class="form form-vertical" method="post">  <div class="row-fluid" >  <div class="col-md-12" >  <div class="alert alert-warning" style="margin-top: 20px;"><center>No caso de aparecer no campo de nome do Personagem *, Cada * significa um espaço que o player utilizou.<br /><b>Neste caso recomenda-se Negar a aplicação.</b></div>  <div class="col-md-12"><div class="col-md-1"><b>Usuário:</b></div><div class="col-md-5"><input style="width:100%; margin-bottom: 10px;" id="nnn"  placeholder="Usuário" readonly value="'.$us.'" class="form-control" type="text" autocomplete="off" name="usuario" required=""></div></div>  <div class="col-md-6">  <input style="width:100%;" id="nnn"  placeholder="Nome personagem (Nome_Sobrenome)" readonly value="'.$charname.'" class="form-control" type="text" autocomplete="off" name="nome" required="">  </div>  <div class="col-md-6">  <input style="width:100%;" value="'.$nascimento.'" placeholder="Data de nascimento (DD/MM/AA)" readonly class="form-control" type="text" autocomplete="off" name="nascimento" required="">  </div>  </div>  </div>  <div class="row-fluid">  <div class="col-md-12">  <div class="col-md-6" style="margin-top: 15px;">  <input style="width:100%;" value="'.$origem.'" placeholder="Local de origem" class="form-control" type="text" readonly  autocomplete="off" name="origem" required="">  </div>  <div class="col-md-6" style="margin-top: 15px;">  <input style="width:100%;" value="'.$sexo1.'" placeholder="Sexo" readonly class="form-control" type="text" autocomplete="off" name="Sexo" required="">  </div>  </div>  </div>  <br /><br />  <div class="control-group" style="margin-top: 210px;">  <label>Escreva uma pequena história sobre seu personagem (pelo menos 2 parágrafos)</label>  <div class="controls" style="">  <textarea id="icolavel" ondrop="return false" onKeyDown="Verificar()" readonly name="historia" class="form-control" style="margin-top: 10px; margin-bottom: 0px; height: 200px; width: 100%!important; resize: none;" placeholder="Digite sua resposta aqui, detalhadamente. (Limite: 2000 caracteres)" maxlength="5000" required="">'.$historia.'</textarea>  </div>  </div>  <br>  <div class="control-group">  <label></label>  <div align="center" class="controls"> <form method="POST">  <button type="submit" name="pronto" class="btn btn-success">Pronto</button> </div>  </div>  </form></div>'; 
        
                    if(isset($_POST['pronto'])){
                echo "<script>  window.opener.location.reload();  window.close();</script>"; 
            } 
        
            }
    ?>



        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

    </html>
