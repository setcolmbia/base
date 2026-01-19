<?php
//$file = "/folder/filename.ext";
$file = $_GET['file'];
$file = "../../../../../".$file;
function force_download($file){
	$ext = explode(".", $file);
	switch($ext[sizeof($ext)-1]){
		case "wav": $mime = "audios/wav"; 
			header('Content-Description: File Transfer');
			header('Content-Type: '.$mime);
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file);
		break;
		case "WAV": $mime = "audios/wav";
			header('Content-Description: File Transfer');
			header('Content-Type: '.$mime);
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			ob_clean();
			flush();
			readfile($file); 
		break;
		    
		default:
			exit; 
		break;
	}
    
}

force_download($file);