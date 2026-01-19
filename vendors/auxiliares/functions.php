<?php

/* 
 * Funciones auxiliares
 */

function logEvent($message,$identificador) {
    if ($message != '') {
        // Add a timestamp to the start of the $message
        $message = date("Y/m/d H:i:s").': '.$message;
        $fp = fopen('/var/log/registro_'.$identificador.'.log', 'a');
        fwrite($fp, $message."\n");
        fclose($fp);
    }
}

function dateIsBetween($dbfrom,$dbto,$user_time) {
    //if( (strtotime($user_time) >= strtotime($dbfrom)) and (strtotime($user_time) <= strtotime($dbto)) ) {
    if( (strtotime($user_time) > strtotime($dbfrom)) and (strtotime($user_time) < strtotime($dbto)) ) {
        return true;
    } else {
        return false;
    }
}