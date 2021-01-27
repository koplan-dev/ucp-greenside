<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="robots" content="all" />
    <meta name="keywords" content="UCP, GTA San Andreas, SAMP, rcrp, Red County, Roleplay, RP, Greenside, Greenside Roleplay, LSRP, Advansed Roleplay, ADRP" />
    <meta name="description" content="Greenside Roleplay, é um servidor de SA-MP de modo roleplay voltado para o estilo de vida rural Americano nos condados de San Andreas." />
    <meta name="Author" content="GR-RP" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="revisit-after" content="2" />

    <meta name="doc-class" content="Living Document" />

    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta http-equiv="imagetoolbar" content="no" />

    <meta charset="utf-8">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <!--  -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/gif" sizes="16x16">
	
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<script type="text/javascript" language="javascript" src="assets/js/jquery-3.3.1.min.js"></script>
   <!-- <link href="assets/fonts/HelveticaNeue.ttf" rel="stylesheet" type="text/css"> -->
    <title>Greenside Roleplay</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         background: url(assets/images/fundo.png);
    <![endif]-->
    <style>
        h2 {
            font-family: 'Open Sans Condensed', sans-serif !important;
            font-weight: 400;
            font-size: 40px;
        }
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;

            background: url(assets/images/bg.png);
            no-repeat center center fixed;
            background-size: cover;
            cursor: url(assets/images/cursor.cur), default;
        }
        .text {
            font-size: 9pt;
            line-height: 6px;
            color: #999;
            text-shadow: 0 1px 0 rgba(255, 255, 255, .5);
        }

        h2 {
            font-family: 'Open Sans Condensed', sans-serif !important;
            font-weight: 400;
            font-size: 40px;
        }

        div.divs:hover {
            background: #FFF;
        }

        div.sec:hover {
            background-color: #eee;
        }
        .but {
            margin-top: 10px;
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, .25);
            background-color: #0062CC;
            background-image: -moz-linear-gradient(top, #169eab, #0062CC);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#169eab), to(#0062CC));
            background-image: -webkit-linear-gradient(top, #169eab, #0062CC);
            background-image: -o-linear-gradient(top, #169eab, #0062CC);
            background-image: linear-gradient(to bottom, #169eab, #0062CC);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff169EAB', endColorstr='#ff0062CC', GradientType=0);
            border-color: #0062CC #0062CC #0062CC;
            border-color: rgba(0, 0, 0, .1);
        }

        div.select:hover {
            background: white;
        }
        a.but {
            margin-top: 10px;
            color: #fff;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, .25);
            background-color: #0062CC;
            background-image: -moz-linear-gradient(top, #169eab, #0062CC);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#169eab), to(#0062CC));
            background-image: -webkit-linear-gradient(top, #169eab, #0062CC);
            background-image: -o-linear-gradient(top, #169eab, #0062CC);
            background-image: linear-gradient(to bottom, #169eab, #0062CC);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff169EAB', endColorstr='#ff0062CC', GradientType=0);
            border-color: #0062CC #0062CC #0062CC;
            border-color: rgba(0, 0, 0, .1);
    </style>
</head>
<body>
<?php
$usuario = $_SESSION['usuario']; 
$validarEmail = mysqli_query($connect, "SELECT * FROM `masters` WHERE `Username` = '$usuario' AND `EMail` = ''");
if (mysqli_num_rows($validarEmail) == 1){
}
else{?>


    </center>


  <?php 
  if (isset($_POST['salvar_email'])){
      $email = $_POST['email'];
      $verificar_email = mysqli_query($connect, "SELECT * FROM `masters` WHERE `EMail` = '$email'");
      if(mysqli_num_rows($verificar_email) == 0){
          mysqli_query($connect, "UPDATE `masters` SET `EMail` = '$email' WHERE `Username` = '$usuario'");
          header('location: meuspersonagens');
      }
  }
  ?>
  <br />

  
   </div>
</div></div>
</center>
<?php
}

?>

</body>

</html>
