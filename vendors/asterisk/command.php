<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
//$agente = "999";
//echo $agente;
/*
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpagi-asmanager.php');

$asm = new AGI_AsteriskManager();

if ($asm -> connect()) {
	$result = $asm -> Command("queue show");
        //$result = $asm -> Agents();
}
$asm -> disconnect();

print_r($result);

 */
$result = system("asterisk -rx 'queue show'");
print_r($result);

exec('sudo /usr/sbin/asterisk -rx "queue show"', $salida, $retorno);
echo "<pre>";
print_r($salida);
echo "</pre>";
echo "<pre>";
print_r($retorno);
echo "</pre>";
