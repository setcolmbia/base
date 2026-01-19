<?php
session_start();

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpagi-asmanager.php');
if(isset($_SESSION['user']->agent)) {$agente = $_SESSION['user']->agent;}
if(isset($_SESSION['exten'])) {$extension = $_SESSION['exten'];}

$numero = '*1' . $agente;
$contexto = "cola-login";

$fecha = date("Ymd_His");
if ($numero == "") {
	echo "Error, Verifique el Número Destino.";
} else {
	echo "Generando Login...";

	$asm = new AGI_AsteriskManager();
	if ($asm -> connect()) {
		$call = $asm -> send_request('Originate',
		//array('Channel'=>"SIP/".$agente, //Si toma exten de la BD de Usuarios
		array('Channel' => "SIP/" . $extension, //Si pide exten en Login
		'Context' => $contexto, 
		'Exten' => $numero, 
		'Timeout' => '30000', 
		'Async' => '1', 
		'MaxRetries' => '1', 
		'RetryTime' => '2', 
		'Priority' => 1, 
		'Callerid' => 'Login'));
		$asm -> disconnect();
	}
}
?>
