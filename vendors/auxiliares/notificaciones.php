<?php
session_start();
$output = '<li class="dropdown-header">
				<i class="ace-icon fa fa-exclamation-triangle"></i>
				Aviso!
			</li>';

$output .= '<li>
				<a href="formularios.php?uniqueid=$uniqueid&telefono=$telefono&campana=$campana&agente=$numAgente&cliente=$cedula" target="tipificarFrame">
					<div class="clearfix">
						<span class="pull-left">
							<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
							Registro para Llamar
						</span>
						<span class="pull-right badge badge-info">+15</span>
					</div>
				</a>
			</li>';
$count = 15;
$data = array(
	'notification'   => $output,
	'unseen_notification' => $count
);
echo json_encode($data)
?>
