<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
$qcalls = 0;
//$agente = "999";
if(isset($_GET['agente'])) {$agente = $_GET['agente'];}
//echo $agente;

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'phpagi-asmanager.php');

$asm = new AGI_AsteriskManager();

if ($asm -> connect()) {
	$result = $asm -> Command("queue show DUMMYSET");
}
$asm -> disconnect();

//Debug
//echo "<pre>";
//print_r($result);
//echo "</pre>";

if (!strpos($result['data'], ':'))
	echo $canalAgente['data'];
else {
	$data = array();
	foreach (explode("\n", $result['data']) as $line) {
		if (preg_match("/Local\/$agente\b/", $line)) {
			if (preg_match("/Not in use/", $line)) {
				if (preg_match("/paused/", $line)) {
					echo "<div class='alert alert-block alert-warning'>
							<i class='ace-icon fa fa-pause yellow'></i>
							Agente <strong class='yellow'>en Pausa</strong>
						</div>";
					$conLlamada = FALSE;
				} else {
					echo "<div class='alert alert-block alert-success'>
							<i class='ace-icon fa fa-check green'></i>
							Agente <strong class='green'>Disponible</strong>
						</div>";
					$conLlamada = FALSE;
				}
			} elseif (preg_match("/Unknown\b/", $line)) {
				echo "<div class='alert alert-block alert-danger'>
							<i class='ace-icon fa fa-exclamation-triangle red'></i>
							Agente <strong class='red'>No Disponible</strong>
						</div>";
				$conLlamada = FALSE;
			} elseif (preg_match("/In use\b/", $line)) {
				
				$conLlamada = TRUE;
			} elseif (preg_match("/Busy\b/", $line)) {
				
				$conLlamada = TRUE;
			} elseif (preg_match("/Invalid\b/", $line)) {
				echo "<div class='alert alert-block alert-danger'>
							<i class='ace-icon fa fa-exclamation-triangle red'></i>
							Agente <strong class='red'>No Creado</strong>
						</div>";
				$conLlamada = FALSE;
			} elseif (preg_match("/Ring/", $line)) {
				echo "<div class='alert alert-block alert-warning'>
							<i class='ace-icon fa fa-phone yellow'></i>
							Agente <strong class='yellow'>en RingBack</strong>
						</div>";
				$conLlamada = FALSE;
			} elseif (preg_match("/On Hold\b/", $line)) {
				echo "<div class='alert alert-block alert-warning'>
							<i class='ace-icon fa fa-pause yellow'></i>
							Agente <strong class='yellow'>en Espera</strong>
						</div>";
				$conLlamada = FALSE;
			} elseif (preg_match("/Unavailable\b/", $line)) {
				echo "<div class='alert alert-block alert-danger'>
							<i class='fa fa-exclamation-triangle red'></i>
							 Agente <strong class='red'>Desconectado</strong> &nbsp;-&nbsp; <a href='#' class='btn btn-white btn-info btn-sm login'><i class='fa fa-headphones'></i> Login Telefónico</a>
						</div>";
				$conLlamada = FALSE;
			} else {
				echo "<div class='alert alert-block alert-danger'>
							<i class='ace-icon fa fa-exclamation-triangle red'></i>
							Agente <strong class='red'>No Disponible</strong>
						</div>";
				$conLlamada = FALSE;
			}
		}
	}
}

if ($conLlamada) {
	if ($asm -> connect()) {
		$canalAgente = $asm -> command("agent show $agente");
		$cadena = $canalAgente['data'];
		//Debug
		// echo "<pre>";
		// echo $cadena;
		// echo "</pre>";
		 

		$linea = explode("\n", $cadena);
		foreach ($linea as $value) {
			if (strpos($value, 'TalkingWith') !== false) {
				$value = explode(":", $value);
				$puente = $value[1];
				$puente = trim($puente);
				$puenteSalida = substr_replace($puente ,"1",-1);
	            //Debug
//                     echo "<pre>";
//	             echo $puente;
//	             echo "</pre>";
//	             echo "<pre>";
//	             echo $puenteSalida;
//	             echo "</pre>";
			}
		}


		//SACA lA INFORMACION DEL CANAL PUENTE DE SALIDA, PARA OBTENER UNIQUEID
		$peer = $asm->command("core show channel $puenteSalida"); //OJO VALIDAR POR QUE USO $puenteSalida
		$cadena = $peer['data'];
		$linea = explode("\n", $cadena);
		foreach ($linea as $value) {
                //Debug
                //  echo "<pre>";
                //  echo $value;
                //  echo "</pre>";
			if (strpos($value, 'UniqueID') !== false) {
				$value = explode(":", $value);
				$uniqueidOrig = $value[1];
				$uniqueidOrig = trim($uniqueidOrig);
			}
		}
			
		//SACA lA INFORMACION DEL CANAL PUENTE
		$peer = $asm->command("core show channel $puente");
		$cadena = $peer['data'];
		$linea = explode("\n", $cadena);
		foreach ($linea as $value) {
                //Debug
                //  echo "<pre>";
                //  echo $value;
                //  echo "</pre>";
			if (strpos($value, 'CAMPAIGN') !== false) {
				$value = explode("=", $value);
				$campana = $value[1];
				$campana = trim($campana);
				$tipoLlamada = explode("_", $campana);
				$tipoLlamada = $tipoLlamada[0];
			}elseif (strpos($value, 'NUMBER') !== false) {
				$value = explode("=", $value);
				$telefono = $value[1];
			}elseif (strpos($value, 'CEDULA') !== false) {
				$value = explode("=", $value);
				$cedula = $value[1];
				$cedula = trim($cedula);
			}elseif (strpos($value, 'TIPODOC') !== false) {
				$value = explode("=", $value);
				$tipodoc = $value[1];
				$tipodoc = trim($tipodoc);
			}elseif (strpos($value, 'NOMBRE') !== false) {
				$value = explode("=", $value);
				$nombre = $value[1];
				$nombre = trim($nombre);
			}elseif (strpos($value, 'UniqueID') !== false) {
				$value = explode(":", $value);
				$uniqueid = $value[1];
				$uniqueid = trim($uniqueid);
			}elseif (strpos($value, 'Elapsed Time') !== false) {
				$value = explode(":", $value);
				$tiempoLlamada = $value[1];
				$tiempoLlamada = trim($tiempoLlamada);
			}elseif (strpos($value, 'Application') !== false) {
				$value = explode(":", $value);
				$aplicacion = $value[1];
				$aplicacion = trim($aplicacion);
			}
		}
	}
		$asm->disconnect();
		//echo $tipoLlamada;
		//echo $aplicacion;
		$linkedid=$uniqueidOrig;

	
	
	//OJO
	if ($uniqueid=='') {
		echo "<div align='center' style='color:GREEN; font-weight: bold;'>Usted no tiene llamada</div>";
	} else {
		if ($tipoLlamada == 'AUT') {
			echo "<div class='alert alert-block alert-info'>
                                        <div class='row'>
						<div class='col-sm-4'><i class='ace-icon fa fa-phone blue'></i> Agente <strong class='blue'>$agente</strong> en Llamada</div>
						<div class='col-sm-4'><strong class='blue'>Llamada Saliente Automática</strong> al: <strong class='blue'>$telefono</strong></div>
						<div class='col-sm-4'>Campaña: <strong class='blue'>$campana</strong></div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>Tiempo de Llamada: <strong class='blue'>$tiempoLlamada</strong></div>
						<div class='col-sm-4'>Cliente: <strong class='blue'>$cedula</strong></div>
						<div class='col-sm-4'>Id de Llamada: <strong class='blue'>$linkedid</strong></div>
					</div>
				<br/>
			";
			echo "<a class='btn btn-sm btn-primary btn-mini' style='font-size: 16px;' href='?controller=form&method=list&idLead=$idLead&uniqueid=$uniqueid&linkedid=$linkedid&campana=$campana&agente=$agente' target='tipificarFrame'>Tipificar</a>"
                                . " <a class='btn btn-sm btn-danger btn-mini colgar' style='font-size: 16px;' href='#' target='inferior'>Colgar</a>"
                                . " <a class='btn btn-sm btn-white btn-mini' style='font-size: 16px;' href=\"#\" onclick=\"javascript:void window.open('transferExt.php?canal=$canalPuente','Transfer','width=300,height=100,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">Transferir</a>"
                                . "</div>";
		} elseif ($tipoLlamada == 'OUT') {
			echo "<div class='alert alert-block alert-info'>
                                        <div class='row'>
						<div class='col-sm-4'><i class='ace-icon fa fa-phone blue'></i> Agente <strong class='blue'>$agente</strong> en Llamada</div>
						<div class='col-sm-4'><strong class='blue'>Llamada Manual Saliente</strong> al: <strong class='blue'>$telefono</strong></div>
						<div class='col-sm-4'>Campaña: <strong class='blue'>$campana</strong></div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>Tiempo de Llamada: <strong class='blue'>$tiempoLlamada</strong></div>
						<div class='col-sm-4'>Cliente: <strong class='blue'>$cedula</strong></div>
						<div class='col-sm-4'>Id de Llamada: <strong class='blue'>$linkedid</strong></div>
					</div>
				<br/>
			";
			echo "<a class='btn btn-sm btn-primary btn-mini' style='font-size: 16px;' href='?controller=form&method=list&idLead=$idLead&uniqueid=$uniqueid&linkedid=$linkedid&campana=$campana&agente=$agente' target='tipificarFrame'>Tipificar</a>"
                                . " <a class='btn btn-sm btn-danger btn-mini colgar' style='font-size: 16px;' href='#' target='inferior'>Colgar</a>"
                                . " <a class='btn btn-sm btn-white btn-mini' style='font-size: 16px;' href=\"#\" onclick=\"javascript:void window.open('transferExt.php?canal=$canalPuente','Transfer','width=300,height=100,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">Transferir</a>"
                                . "</div>";
		} elseif ($tipoLlamada == 'PRE') {
			echo "<div class='alert alert-block alert-info'>
                                        <div class='row'>
						<div class='col-sm-4'><i class='ace-icon fa fa-phone blue'></i> Agente <strong class='blue'>$agente</strong> en Llamada</div>
						<div class='col-sm-4'><strong class='blue'>Llamada Saliente Preview</strong> al: <strong class='blue'>$telefono</strong></div>
						<div class='col-sm-4'>Campaña: <strong class='blue'>$campana</strong></div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>Tiempo de Llamada: <strong class='blue'>$tiempoLlamada</strong></div>
						<div class='col-sm-4'>Cliente: <strong class='blue'>$cedula</strong></div>
						<div class='col-sm-4'>Id de Llamada: <strong class='blue'>$linkedid</strong></div>
					</div>
				<br/>
			";
			echo "<a class='btn btn-sm btn-primary btn-mini' style='font-size: 16px;' href='?controller=form&method=list&idLead=$idLead&uniqueid=$uniqueid&linkedid=$linkedid&campana=$campana&agente=$agente' target='tipificarFrame'>Tipificar</a>"
                                . " <a class='btn btn-sm btn-danger btn-mini colgar' style='font-size: 16px;' href='#' target='inferior'>Colgar</a>"
                                . " <a class='btn btn-sm btn-white btn-mini' style='font-size: 16px;' href=\"#\" onclick=\"javascript:void window.open('transferExt.php?canal=$canalPuente','Transfer','width=300,height=100,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">Transferir</a>"
                                . "</div>";
		}elseif($aplicacion=='Queue'){
			echo "<div class='alert alert-block alert-info'>
                                        <div class='row'>
						<div class='col-sm-4'><i class='ace-icon fa fa-phone blue'></i> Agente <strong class='blue'>$agente</strong> en Llamada</div>
						<div class='col-sm-4'><strong class='blue'>Llamada Entrante</strong> desde: <strong class='blue'>$telefono</strong></div>
						<div class='col-sm-4'>Campaña: <strong class='blue'>$campana</strong></div>
					</div>
					<div class='row'>
						<div class='col-sm-4'>Tiempo de Llamada: <strong class='blue'>$tiempoLlamada</strong></div>
						<div class='col-sm-4'>Cliente: <strong class='blue'>$cedula</strong></div>
						<div class='col-sm-4'>Id de Llamada: <strong class='blue' id='idLlamada' onclick='CopyToClipboard(this.id);'>$linkedid</strong></div>
					</div>
				<br/>
			";
			echo "<a class='btn btn-sm btn-primary btn-mini' style='font-size: 16px;' href='?controller=form&method=list&idLead=$idLead&uniqueid=$uniqueid&linkedid=$linkedid&campana=$campana&agente=$agente' target='tipificarFrame'>Tipificar</a>"
                                . " <a class='btn btn-sm btn-danger btn-mini colgar' style='font-size: 16px;' href='#' target='inferior'>Colgar</a>"
                                . " <a class='btn btn-sm btn-white btn-mini' style='font-size: 16px;' href=\"#\" onclick=\"javascript:void window.open('transferExt.php?canal=$canalPuente','Transfer','width=300,height=100,toolbar=0,menubar=0,location=0,status=1,scrollbars=0,resizable=1,left=0,top=0');return false;\">Transferir</a>"
                                . "</div>";
		}
		
	}
}else{
}
?>
<script>
$('.login').click(function () {
    $.ajax({
            type: 'post',
            url: 'vendors/asterisk/llamadaLogin.php',

            success: function (response) {
                console.log(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Atención, no se pudo ejecutar el Login por mensaje de " + textStatus + ". Descripción: " + errorThrown); 
            } 
    });
});
	
$('.colgar').click(function () {
        $.ajax({
                type: 'post',
                url: 'vendors/asterisk/colgar.php',

                success: function (response) {
                    console.log(response);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Atención, no se pudo colgar por causa: " + textStatus + ". Descripción: " + errorThrown); 
                } 
        });
});	    
		 
</script>
