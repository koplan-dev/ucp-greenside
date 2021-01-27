<?php 
 echo '
<div class="well wellmenu col-md-12">
    <nobr>
        <ul class="nav nav-list">
            <li class="nav-header" style="display: block;
    padding: 3px 1px;
    font-size: 12px;
    font-weight: bold;
    line-height: 20px;
    color: #999;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    text-transform: uppercase;">Menu</li>
            <li><a class="text" href="meuspersonagens"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Meus Personagens</a></li>
            <li><a class="text" href="donate"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Donate</a></li>
            <li><a class="text" href="criarpersonagem"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Criar novo personagem </a></li>
            <li><a class="text" href="minhaconta"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Minha Conta</a></li>
';
 /*
<li><a class="text" href=""><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Notificações (0) </a></li>
<li role="separator" class="divider" style="background: white;"></li> */

echo '
<li><a class="text" href="logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Sair</a>
</li>
</ul>
</nobr>
</div>
';

$veradm = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username` = '$usuario' AND `AdminLevel` >= 1");
if(mysqli_num_rows($veradm) >= 1){
    
$contarapp = mysqli_query($connect, "SELECT * FROM `avaliacoes` WHERE `Status` = '0'");
$contado = mysqli_num_rows($contarapp);
echo '
<div class="well wellmenu col-md-12">
    <nobr>
        <ul class="nav nav-list">
            <li class="nav-header" style="display: block;
    padding: 3px 1px;
    font-size: 12px;
    font-weight: bold;
    line-height: 20px;
    color: #999;
    text-shadow: 0 1px 0 rgba(255,255,255,.5);
    text-transform: uppercase;">Administrativo</li>
            <li><a class="text" href="acp"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Aplicações ('.$contado.') </a></li>
            <li><a class="text" href="acp?ath=1"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Postagem</a></li>
            </li>
';
echo '<li><a class="text" href="acp?ath=2"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> Estatística</a></li></li>';
echo'<li><a class="text" href="acp?ath=3"><span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Avalicações</a></li></li>';
//echo'<li><a class="text" href="addn"><span class="glyphicon glyphicon-usd" aria-hidden="true"></span> Donates</a></li></li>';
echo '</ul></nobr></div></div>';
}
?>