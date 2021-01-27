<?php
 /*

require_once('rcon.php');
$r = new rcon("179.35.67.194",25575,"senha123"); //create rcon object for server on the rcon port with a specific password
if($r->Auth()){ //Connect and attempt to authenticate
  $r->rconCommand("say Saving in 10 seconds!"); //send a command
  sleep(10);
  $r->rconCommand("save-all"); //send a command
  $r->rconCommand("say Save complete!");//send a command
  echo $r->rconCommand("list");//send a command, echo returned value
} mcrcon.exe -t -H ec2-52-67-80-13.sa-east-1.compute.amazonaws.com -P 25575 -p senha123
*/

 require_once('labelsender.php');
$rconhost = "ec2-52-67-80-13.sa-east-1.compute.amazonaws.com";
$rconPort = 25575;               
$rconPassword = "senha123"; 
$rcontimeout = 3;   
 
 $rcon = new Rcon($rconhost, $rconPort, $rconPassword, $rcontimeout);
 
 if ($rcon->connect()){
	$rcon->send_command("say teste");
    echo $rcon->get_response();
}

?>