<?php

class telephonyController extends Telephony{
    /**
     * Función que se ejecuta siempre que se crea un objeto.
     * Se puede usar para la seguridad de un controlador.
     */
    public function __construct()
    {
        Security::verifyUser();
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
        $method = isset($_GET['method']) ? $_GET['method'] : 'index';
        $allowed=Security::verifyRole($controller,$method);
        if(!$allowed){
            require_once 'views/errors/403.html';
            exit();
        }
    }

    //Mostrar toda la informacion
    public function index(){                
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/telephony/index.php';
        require_once 'views/layouts/footer.php';
    }
    
    //Mostrar toda la informacion
    public function trunkStatus(){                
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/telephony/trunkStatus.php';
        require_once 'views/layouts/footer.php';
    }
    
    //Estado de marcación
    public function dialStatus(){ 
        $campaigns = Campaigns::allActive();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/telephony/dialStatus.php';
        require_once 'views/layouts/footer.php';
    }

    //Recarga de configuración
    public function reload(){
        $command = "reload";
        if(parent::command($command)){
            header('location: ?controller=telephony&method=index');
        }else{
            die('Error al actualizar');
        }
    }
    
    //Verifica estado de un peer SIP
    public function statusSip($peer){
        $parameters['Peer'] = $peer;
        $response = parent::send_request('SIPshowpeer',$parameters);
//        echo "<pre>";
//        print_r($response);
//        echo "</pre>";
        if($response['Response']==='Success'){
//            echo $response['Channeltype']."<br/>";
//            echo $response['Address-IP']."<br/>";
//            echo $response['Status']."<br/>";
            return $response;
        }else{
            die('Error al Consultar Peer');
        }
    }
    
    //Generación archivo sip_troncales.conf
    public function generateSiptrunk(){
        $fileContainer = "/etc/asterisk/config/sip_troncales.conf";
        $fileContainerReg = "/etc/asterisk/config/sip_registros.conf";
        $filePointer = fopen($fileContainer, "w");
        $filePointerReg = fopen($fileContainerReg, "w");
        
        $date = date('Y-m-d H:i:s', time());
        
        $header = "; SETCOLOMBIA SAS\n"
        . "; Editado: ".$date."\n"
        . ";\n"
        . ";============TRONCALES SIP===============\n";
        
        $body = "";
        $bodyReg = "";
        
        foreach(Siptrunk::allActive() as $siptrunk){
            $body .= ";TRUNK: ".$siptrunk->fullname."\n";
            $body .= "[".$siptrunk->name."]\n";
            $body .= "host=".$siptrunk->host."\n";
            $body .= "type=".$siptrunk->type."\n";
            $body .= "nat=".$siptrunk->nat."\n";
            $body .= "call-limit=".$siptrunk->call_limit."\n";
            $body .= "context=".$siptrunk->context."\n";
            $body .= "insecure=".$siptrunk->insecure."\n";
            $body .= "qualify=".$siptrunk->qualify."\n";
            $body .= "dtmfmode=".$siptrunk->dtmfmode."\n";
            $body .= "canreinvite=".$siptrunk->canreinvite."\n";
            $disallow=explode(";",$siptrunk->disallow);
            $allow=explode(";",$siptrunk->allow);
            foreach($disallow as $key){
                $body .= "disallow=".$key."\n";
            }
            foreach($allow as $key){
                $body .= "allow=".$key."\n";
            }
            $body .= $siptrunk->fromuser==="" ? "":"fromuser=".$siptrunk->fromuser."\n";
            $body .= $siptrunk->fromdomain==="" ? "":"fromdomain=".$siptrunk->fromdomain."\n";
            $body .= $siptrunk->auth==="0" ? "":"username=".$siptrunk->username."\n";
            $body .= $siptrunk->auth==="0" ? "":"defaultuser=".$siptrunk->username."\n";
            $body .= $siptrunk->auth==="0" ? "":"secret=".$siptrunk->secret."\n";
            $body .= "\n";
            
            if($siptrunk->auth==="0"){
                $bodyReg .= "";
            }elseif($siptrunk->host==='dynamic'){
                $bodyReg .= "";
            }else{
                $bodyReg .= "register=>".$siptrunk->username.":".$siptrunk->secret."@".$siptrunk->host;
                $bodyReg .= $siptrunk->cid_number==="" ? "":"/".$siptrunk->cid_number;
                $bodyReg .= "\n";
            }
        }
        $file = $header.$body;
        $fileReg = $header.$bodyReg;
        
        if(fputs($filePointer, $file)){
            fclose($filePointer);
            if(fputs($filePointerReg, $fileReg)){
                fclose($filePointerReg);
                return true;
            }else{
                die('Error al escribir Registros');
            }
        }else{
            die('Error al escribir Troncales');
        }
    }

    //Generación archivo sip_extensiones.conf
    public function generateSip(){
        $fileContainer = "/etc/asterisk/config/sip_extensiones.conf";
        $fileContainerIax = "/etc/asterisk/config/iax_extensiones.conf";
        $fileContainerExten = "/etc/asterisk/config/extensions_sip.conf";
        $filePointer = fopen($fileContainer, "w");
        $filePointerIax = fopen($fileContainerIax, "w");
        $filePointerExten = fopen($fileContainerExten, "w");
        
        $date = date('Y-m-d H:i:s', time());
        
        $header = "; SETCOLOMBIA SAS\n"
        . "; Editado: ".$date."\n"
        . ";\n"
        . ";============EXTENSIONES SIP/IAX2===============\n";
        
        $body = "";
        $bodyIax = "";
        $bodyExten = "";
        $bodyExten .= "[extensiones]\n";
        
        foreach(Sip::allActive() as $sip){
            $body .= ";EXTENSION: ".$sip->fullname."\n";
            $body .= "[".$sip->name."]\n";
            $body .= "host=".$sip->host."\n";
            $body .= "type=".$sip->type."\n";
            $body .= "accountcode=".$sip->accountcode."\n";
            $body .= "nat=".$sip->nat."\n";
            $body .= "call-limit=".$sip->call_limit."\n";
            $body .= "context=".$sip->context."\n";
            $body .= "insecure=".$sip->insecure."\n";
            $body .= "qualify=".$sip->qualify."\n";
            $body .= "dtmfmode=".$sip->dtmfmode."\n";
            $body .= "canreinvite=".$sip->canreinvite."\n";
            $disallow=explode(";",$sip->disallow);
            $allow=explode(";",$sip->allow);
            foreach($disallow as $key){
                $body .= "disallow=".$key."\n";
            }
            foreach($allow as $key){
                $body .= "allow=".$key."\n";
            }
            $body .= "fullname=".$sip->fullname."\n";
            $body .= "cid_number=".$sip->cid_number."\n";
            $body .= "mailbox=".$sip->mailbox."\n";
            $body .= $sip->fromuser==="" ? "":"fromuser=".$sip->fromuser."\n";
            $body .= $sip->fromdomain==="" ? "":"fromdomain=".$sip->fromdomain."\n";
            $body .= "username=".$sip->username."\n";
            $body .= "defaultuser=".$sip->username."\n";
            $body .= "secret=".$sip->secret."\n";
            $body .= "\n";
            
            $bodyIax .= ";EXTENSION: ".$sip->fullname."\n";
            $bodyIax .= "[".$sip->name."]\n";
            $bodyIax .= "host=".$sip->host."\n";
            $bodyIax .= "type=".$sip->type."\n";
            $bodyIax .= "accountcode=".$sip->accountcode."\n";
            $bodyIax .= "callerid=\"".$sip->fullname."\" <".$sip->cid_number.">\n";
            $bodyIax .= "requirecalltoken=no\n";
            $bodyIax .= "context=".$sip->context."\n";
            $bodyIax .= "insecure=".$sip->insecure."\n";
            $bodyIax .= "qualify=".$sip->qualify."\n";
            $bodyIax .= "canreinvite=".$sip->canreinvite."\n";
            $disallow=explode(";",$sip->disallow);
            $allow=explode(";",$sip->allow);
            foreach($disallow as $key){
                $bodyIax .= "disallow=".$key."\n";
            }
            foreach($allow as $key){
                $bodyIax .= "allow=".$key."\n";
            }
            $bodyIax .= "fullname=".$sip->fullname."\n";
            $bodyIax .= "cid_number=".$sip->cid_number."\n";
            $bodyIax .= "mailbox=".$sip->mailbox."\n";
            $bodyIax .= "username=".$sip->username."\n";
            $bodyIax .= "defaultuser=".$sip->username."\n";
            $bodyIax .= "user=".$sip->username."\n";
            $bodyIax .= "secret=".$sip->secret."\n";
            $bodyIax .= "\n";
            
            
            $bodyExten .= ";Llamadas a Extension: ".$sip->name."\n";
            $bodyExten .= "exten => ".$sip->name.",1,Goto(stdextenSinVM,".$sip->name.",1)\n";
        }
        $file = $header.$body;
        $fileIax = $header.$bodyIax;
        $fileExten = $header.$bodyExten;
        
        if(fputs($filePointer, $file)){
            fclose($filePointer);
            if(fputs($filePointerIax, $fileIax)){
                fclose($filePointerIax);
                    if(fputs($filePointerExten, $fileExten)){
                    fclose($filePointerExten);
                    return true;
                }else{
                    die('Error al escribir Dialplan Extensiones SIP');
                }
            }else{
                die('Error al escribir Extensiones IAX2');
            }
        }else{
            die('Error al escribir Extensiones SIP');
        }
    }

    //Generación archivo agents_agentes.conf
    public function generateAgents(){
        $fileContainer = "/etc/asterisk/config/agents_agentes.conf";
        $filePointer = fopen($fileContainer, "w");
        
        $date = date('Y-m-d H:i:s', time());
        
        $header = "; SETCOLOMBIA SAS\n"
        . "; Editado: ".$date."\n"
        . ";\n"
        . ";============AGENTES TELEFÓNICOS===============\n";
        
        $body = "";
        
        foreach(Agent::allActive() as $agent){
            $body .= ";AGENTE: ".$agent->name."\n";
            $body .= "[".$agent->number."]\n";
            $body .= "fullname=".$agent->name."\n";
            $body .= "\n";
            
        }
        $file = $header.$body;
        
        if(fputs($filePointer, $file)){
            fclose($filePointer);
            return true;
        }else{
            die('Error al escribir Agentes Telefónicos');
        }
    }
    
    //Generación archivo extensions_outbound.conf
    public function generateOutboundroutes(){
        $fileContainer = "/etc/asterisk/config/extensions_outbound.conf";
        $fileContainerRobo = "/etc/asterisk/config/extensions_outbound_robodialer.conf";
        $filePointer = fopen($fileContainer, "w");
        $filePointerRobo = fopen($fileContainerRobo, "w");
        
        $date = date('Y-m-d H:i:s', time());
        
        $header = "; SETCOLOMBIA SAS\n"
        . "; Editado: ".$date."\n"
        . ";\n"
        . ";============RUTAS DE SALIDA===============\n";
        
        $body = "";
        
        foreach(Outboundroute::all() as $outboundroute){
            $body .= ";RUTA: ".$outboundroute->name."\n";
            $body .= "[".$outboundroute->context."]\n";
            
            foreach(Outboundroute::allPatterns($outboundroute->id) as $outboundroutePattern){
                $prefixLen = strlen($outboundroutePattern->prefix);
                $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",1,NoOp(Llamada de Salida ruta: ".$outboundroute->name.")\n";
                $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Mixmonitor(/var/grabaciones/salida/hoy/\${UNIQUEID}.WAV,b)\n";
                $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CDR(userfield)=\${EXTEN})\n";
                $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CDR(campaign)=\${CAMPAIGN})\n";
                $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CUENTA=1111)\n";
                foreach(Outboundroute::allTrunkDetails($outboundroute->id) as $outboundrouteTrunk){
                    $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Dial(SIP/".$outboundrouteTrunk->name."/".$outboundroutePattern->prepend."\${EXTEN:".$prefixLen."},,rtT)\n";
                }
                $body .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Hangup()\n";
                $body .= "\n";
            }
        }
        $file = $header.$body;
        
        //Creo dialplan para Robodialer
        $bodyRobo = "";
        
        $bodyRobo = "[dialer-hangup]
exten => s,1,NoOp()
same => n,Set(HANGUPCAUSE_STRING=\${HANGUPCAUSE_KEYS()})
same => n,Verbose(0, Llamada terminada con causa ISDN \${HANGUPCAUSE} )
same => n,Verbose(0, Canal Terminado: \${HANGUPCAUSE_STRING})
same => n,Verbose(0, DialStatus \${DIALSTATUS})
;same => n,Verbose(0, Prueba 2 \${HASH(SIP_CAUSE,\${CDR(dstchannel)})})
same => n,Verbose(0, Respuesta SIP \${HANGUPCAUSE(\${HANGUPCAUSE_STRING},tech)})
same => n,Verbose(0, Respuesta AST \${HANGUPCAUSE(\${HANGUPCAUSE_STRING},ast)})
same => n,Set(CDR(sipcause)=\${HANGUPCAUSE(\${HANGUPCAUSE_STRING},tech)})
same => n,Set(CDR(isdncause)=\${HANGUPCAUSE})
same => n,Set(CDR(astcause)=\${HANGUPCAUSE(\${HANGUPCAUSE_STRING},ast)})

same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"CHANUNAVAIL\"]?CHANUNAVAIL)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"CONGESTION\"]?CONGESTION)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"NOANSWER\"]?NOANSWER)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"BUSY\"]?BUSY)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"ANSWER\"]?ANSWER)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"CANCEL\"]?CANCEL)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"DONTCALL\"]?DONTCALL)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"TORTURE\"]?TORTURE)
same => n,GotoIf(\$[\"\${DIALSTATUS}\" = \"INVALIDARGS\"]?INVALIDARGS:DESCONOCIDO)

same => n(CHANUNAVAIL),Set(__DISPO=-9)
same => n,Goto(SETDISPO)
same => n(CONGESTION),Set(__DISPO=-5)
same => n,Goto(SETDISPO)
same => n(NOANSWER),Set(__DISPO=-2)
same => n,Goto(SETDISPO)
same => n(BUSY),Set(__DISPO=-4)
same => n,Goto(SETDISPO)
same => n(ANSWER),Set(__DISPO=12)
same => n,Goto(SETDISPO)
same => n(CANCEL),Set(__DISPO=-6)
same => n,Goto(SETDISPO)
same => n(DONTCALL),Set(__DISPO=-7)
same => n,Goto(SETDISPO)
same => n(TORTURE),Set(__DISPO=-11)
same => n,Goto(SETDISPO)
same => n(INVALIDARGS),Set(__DISPO=-8)
same => n,Goto(SETDISPO)

same => n(SETDISPO),Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},\${DISPO},\${UNIQUEID},\"\${HANGUPCAUSE(\${HANGUPCAUSE_STRING},tech)}\",\"\${HANGUPCAUSE}\",\"\${HANGUPCAUSE(\${HANGUPCAUSE_STRING},ast)}\")
same => n,Return()";
        $bodyRobo .= "\n";
        foreach(Outboundroute::all() as $outboundroute){
            $bodyRobo .= ";RUTA: ".$outboundroute->name."\n";
            $bodyRobo .= "[".$outboundroute->context."_ROBODIALER]\n";
            
            foreach(Outboundroute::allPatterns($outboundroute->id) as $outboundroutePattern){
                $prefixLen = strlen($outboundroutePattern->prefix);
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",1,NoOp(Llamada de Salida ruta: ".$outboundroute->name.")\n";
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,NoOp(Campana: \${CAMPAIGN}, ID: \${IDLEAD}, Tipo: \${TIPO})\n";
                //$bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Mixmonitor(/var/grabaciones/salida/hoy/\${UNIQUEID}.WAV,b)\n";
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CDR(userfield)=\${EXTEN})\n";
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CDR(campaign)=\${CAMPAIGN})\n";
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CHANNEL(hangup_handler_push)=dialer-hangup,s,1)\n";
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CUENTA=1111)\n";
                foreach(Outboundroute::allTrunkDetails($outboundroute->id) as $outboundrouteTrunk){
                    $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Set(CDR(trunk)=".$outboundrouteTrunk->name.")\n";
                    $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Dial(SIP/".$outboundrouteTrunk->name."/".$outboundroutePattern->prepend."\${EXTEN:".$prefixLen."},,rtT)\n";
                }
                //$bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Goto(s-\${DIALSTATUS},1)\n";
                $bodyRobo .= "exten => _".$outboundroutePattern->prefix.$outboundroutePattern->pattern.",n,Hangup()\n";
                $bodyRobo .= "\n";
            }
//            $bodyRobo .= "exten => s-ANSWER,1,NoOp(CONTESTADA)
//exten => s-ANSWER,2,Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},12,\${UNIQUEID})
//exten => s-ANSWER,3,Hangup()
//exten => s-NOANSWER,1,NoOp(NO CONTESTA)
//exten => s-NOANSWER,2,Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},-2,\${UNIQUEID})
//exten => s-NOANSWER,3,Hangup()
//exten => s-CHANUNAVAIL,1,NoOp(CANAL NO DISPONIBLE)
//exten => s-CHANUNAVAIL,2,Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},-9,\${UNIQUEID})
//exten => s-CHANUNAVAIL,3,Hangup()
//exten => s-BUSY,1,NoOp(OCUPADO)
//exten => s-BUSY,2,Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},-4,\${UNIQUEID})
//exten => s-BUSY,3,Hangup()
//exten => s-CONGESTION,1,NoOp(CONGESTION)
//exten => s-CONGESTION,2,Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},-5,\${UNIQUEID})
//";
            $bodyRobo .= "\n";
        }
        $fileRobo = $header.$bodyRobo;
        
        if(fputs($filePointer, $file)){
            fclose($filePointer);
            
            if(fputs($filePointerRobo, $fileRobo)){
                fclose($filePointerRobo);
                return true;
            }else{
                die('Error al escribir Rutas de Salida Robodialer');
            }
            
        }else{
            die('Error al escribir Rutas de Salida');
        }
    }
    
    //Generación archivo extensions_robodialer.conf
    public function generateRoboCampaigns(){
        $fileContainer = "/etc/asterisk/config/extensions_robodialer.conf";
        $filePointer = fopen($fileContainer, "w");
        
        $date = date('Y-m-d H:i:s', time());
        
        $header = "; SETCOLOMBIA SAS\n"
        . "; Editado: ".$date."\n"
        . ";\n"
        . ";============DIALPLAN CAMPAÑAS ROBODIALER===============\n";
        
        $body = "[robodialer]\n";
        foreach(Campaigns::all() as $campaign){
            $body .= ";Campaña: ".$campaign->name."\n";
            $body .= "exten => ".$campaign->name.",1,NoOp(Campana Dialer: ".$campaign->name.")\n";
            $body .= "exten => ".$campaign->name.",n,Answer()\n";
            $body .= "exten => ".$campaign->name.",n,Set(__CAMPAIGN=".$campaign->name.")\n";
            //$body .= "exten => ".$campaign->name.",n,Set(AUDIOHOOK_INHERIT(MixMonitor)=yes)\n";
            $body .= "exten => ".$campaign->name.",n,Set(CDR(userfield)=\${CALLERID(num)}-ROBODIALER-\${UNIQUEID})\n";
            //Busco audio y hago Plaback
            $recording = Recordings::find($campaign->recording);
            $body .= "exten => ".$campaign->name.",n,Playback(".substr($recording->route,0,-4).")\n";
            $body .= "exten => ".$campaign->name.",n,NoOp(CONTESTADA)\n";
            //$body .= "exten => ".$campaign->name.",n,Agi(dispoDialer.php,\${IDLEAD},\${CAMPAIGN},12,\${UNIQUEID})\n";
            $body .= "exten => ".$campaign->name.",n,Hangup()\n";
            $body .= "\n";
            //OJO PROBAR SI NECESITA LA EXTENSION h
        }
        $file = $header.$body;
        
        if(fputs($filePointer, $file)){
            fclose($filePointer);
            return true;
        }else{
            die('Error al escribir Dialplan');
        }
    }
}