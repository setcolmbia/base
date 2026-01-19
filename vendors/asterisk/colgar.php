<?php 
session_start();

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpagi-asmanager.php');

if (isset($_POST['canal'])) { $canal=$_POST['canal']; }

if ($canal == "") {
    echo "Error, Verifique que tenga una llamada activa.";
} else {
    echo "Colgando Llamada...";

    $asm = new AGI_AsteriskManager();
    if ($asm->connect()) {
        $call = $asm->send_request('Hangup',
                array('Channel' => $canal,
                    'Cause' => '16'));
        $asm->disconnect();
    }
}
?>