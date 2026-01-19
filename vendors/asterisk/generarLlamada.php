<?php
session_start();

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpagi-asmanager.php');
if(isset($_SESSION['user']->agent)) {$agente = $_SESSION['user']->agent;}
if(isset($_SESSION['exten'])) {$extension = $_SESSION['exten'];}
					
if (isset($_POST['numero'])) { $numero=$_POST['numero']; }
$numero = preg_replace('/\s+/', '', $numero);
if (isset($_POST['campana'])) { $campana=$_POST['campana']; }
$contexto="OUTBOUND";

if ($numero == "") {
    echo "Error, Verifique el Número Destino.";
} else {
    echo "Generando Llamada...";

    $asm = new AGI_AsteriskManager();
    if ($asm->connect()) {
        $call = $asm->send_request('Originate',
                array('Channel' => "Local/" . $agente ."@agents",
                    'Context' => $contexto,
                    'Exten' => $numero,
                    'Timeout' => '30000',
                    'Async' => '1',
                    'MaxRetries' => '1',
                    'RetryTime' => '2',
                    'Priority' => 1,
                    'Variable' => 'CAMPAIGN=OUT_MANUAL,NUMBER='.$numero,
                    'Callerid' => $agente));
        $asm->disconnect();
    }
}
?>
					