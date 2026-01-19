<?php
error_reporting(E_ALL);

/* 
 * Marcador automático V2.0
 * Script para generación de llamadas automáticas.
 * Recorre la BD para generar llamadas.
 */
require (__DIR__ . '/../../config.php');
require (__DIR__ . '/../../models/Database.php');
require (__DIR__ . '/phpagi-asmanager.php');
require (__DIR__ . '/robodialerClass.php');
require (__DIR__ . '/../auxiliares/functions.php');

// Frecuencia de ejecución de la búsqueda:
$seconds = 3;
// Conversión a microsegundos para 'usleep' function.
$micro = $seconds * 1000000;
//// Tasa de marcación
//$ratio=10;
//$limit=intval($ratio);
// Fecha actual
$hoy = date("Y-m-d H:i:s");

$dialerObject = new Robodialer();

$asm = new AGI_AsteriskManager();
if ($asm->connect()) {
    logEvent('Conexión EXITOSA al AMI','RoboDialer');
    while(true){
        //logEvent('Tick.','RoboDialer');
        $contador=0;
        $countLeads=0;
        $nombre="";
        $filtroD="";
        $filtroA="";
        $tipoCampana='3';

        $campaigns = $dialerObject->all();
        $countCamp = count($campaigns);
        logEvent('Campañas Activas: '.$countCamp,'RoboDialer');
        foreach ($campaigns as $campaign) {
            $nombreCola = $campaign->name;
            $filtroD = $campaign->dispoFilter;
            $filtroA = $campaign->attempsFilter;
            $ultimoL = $campaign->lastCall;
            $duraC = $campaign->duration;
            $grabA = $campaign->recording;
            $start = $campaign->start;
            $end = $campaign->end;
            $route = $campaign->route;
            $ratio = $campaign->ratio;
            $limit=intval($ratio);
            $horaActual = date("H:i:s");
            $diaActual = date("N");
            $fechaActual = date("Y-m-d");
            //Valido día de la semana
            if($diaActual==6){
                    $inicioA = $campaign->startSat;
                    $finA = $campaign->endSat;
            }elseif($diaActual==7){
                    $inicioA = $campaign->startSun;
                    $finA = $campaign->endSun;
            }else{
                    $inicioA = $campaign->startMF;
                    $finA = $campaign->endMF;
            }
            
            //Busco la ruta de salida
            $outboundroute = $dialerObject->getRoute($route);
            $callerid = $outboundroute->callerid;
            $outboundroute = $outboundroute->context."_ROBODIALER";
            logEvent('Ruta de Salida: '.$outboundroute,'RoboDialer');

            logEvent('Campaña: '.$nombreCola,'RoboDialer');
            logEvent('Inicio Campana: '.$inicioA.' - Fin Campana: '.$finA,'RoboDialer');
            
            //Reviso rango de horario
            if(dateIsBetween($inicioA, $finA, $horaActual)&&(($fechaActual >= $start) && ($fechaActual <= $end))){
                logEvent('Dia Ejecucion: '.$diaActual.' Fecha Ejecucion: '.$fechaActual.' Hora Ejecucion: '.$horaActual.' Dentro del rango Horario.','RoboDialer');
                //Reviso timestamp de ultimo llamado
                $horaYa=time();
                $horaLimite=$ultimoL+$duraC;

                if ($horaLimite<$horaYa) {
                    $leads = $dialerObject->findLeads($nombreCola, $limit, $filtroD, $filtroA);
                    //print_r($leads);
                    //echo "Intentos: ".$filtroA." Filtro Dispo: ".$filtroD."\n";
                    
                    //Reviso si hay Leads para marcar
                    $countLeads = count($leads);
                    
                    //echo "Contador: ".$countLeads."\n";
                    if($countLeads > 0){
                        logEvent('SI hay registros.','RoboDialer');
                        foreach ($leads as $lead) {
                            $nombreCliente = $lead->name;
                            $idRegistro = $lead->id;
                            $idAdicional = $lead->idExtra;
                            $phone = $lead->phone;
                            
                            logEvent('Llamando a: '.$phone.' ID: '.$idRegistro,'RoboDialer');
                            // Cambio dispo a -13 - Llamada en curso.
                            $dialerObject->updateDispo($nombreCola, '-13', $idRegistro);
                            // Genero llamada via AMI
                            $call = $asm->send_request('Originate',
                                array('Channel' => 'Local/' . $phone . '@'.$outboundroute,
                                    'Context' => 'robodialer',
                                    'Exten' => $nombreCola,
                                    'Timeout' => '30000',
                                    'Async' => 'true',
                                    'MaxRetries' => '1',
                                    'Callerid' => '"'.$phone.'" <'.$callerid.'>',
                                    'RetryTime' => '2',
                                    'Priority' => 1,
                                    'Variable' => '__CAMPAIGN=' . $nombreCola . ',__IDLEAD=' . $idRegistro . ',__NOMBRE=' . $nombreCliente . ',__DESTINO=' . $phone . ',__TIPO=' . $tipoCampana . ',__IDADICIONAL=' . $idAdicional));
                        }
                        // Actualizo ultimo llamado con $horaYa en la tabla de campañas
                        $dialerObject->updateLastCall($nombreCola, $horaYa);
                    }else{
                        logEvent('NO hay registros.','RoboDialer');
                    }
                }else{
                    logEvent('Esperando completar llamadas.','RoboDialer');
                }
            }else{
                logEvent('Dia Ejecucion: '.$diaActual.' Fecha Ejecucion: '.$fechaActual.' Hora Ejecucion: '.$horaActual.' Fuera de Rango Horario.','RoboDialer');
            }

        }
        
        usleep($micro);
    }
    logEvent('ROBODIALER Detenido.','RoboDialer');
    $asm->disconnect();
}else{
    logEvent('Conexión FALLIDA al AMI','RoboDialer');
}