<?php
//Herencia
class Form extends Database{

    // Traigo todos los formularios
    public function all(){
        try{
            $query = "SELECT * FROM ".PREFIX."_forms";
            $result = parent::connect()->prepare($query);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    // Traigo todos los formularios Activos
    public function allActive(){
        try{
            $query = "SELECT * FROM ".PREFIX."_forms WHERE active = 1";
            $result = parent::connect()->prepare($query);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    // Traigo todos los formularios
    public function allForms(){
        try{
            $query = "SELECT table_name FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='setcrm5' AND (table_name like 'FORM_%' OR table_name like 'HIST_%');";
            $result = parent::connect()->prepare($query);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    // Traigo todos los campos
    public function allFieldTypes(){
        try{
            $query = "SELECT * FROM ".PREFIX."_formFieldTypes";
            $result = parent::connect()->prepare($query);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function countAll(){
        try{
            $query = "SELECT count(id) as cantidad FROM ".PREFIX."_forms";
            $result = parent::connect()->prepare($query);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function countByDate($start,$end){
        try{
            $query = "SELECT count(*) as cantidad FROM ".PREFIX."_forms WHERE date BETWEEN ? AND ? order by id desc";
            $result = parent::connect()->prepare($query);
            $result->bindParam(1, $start, PDO::PARAM_STR);
            $result->bindParam(2, $end, PDO::PARAM_STR);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function find($id){
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_forms WHERE id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function findLead($form,$id){
        try{
            $result = parent::connect()->prepare("SELECT * FROM FORM_".$form." WHERE id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function save($data){
        $dispositions = json_encode($data['disposition']);
        $speech = htmlentities($data['speech']);
        try{
            $result = parent::connect()->prepare("INSERT INTO ".PREFIX."_forms (name, description, dispositions, active, speech, userCreate, dateCreate) VALUES (?,?,?,?,?,?,NOW())");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['description'], PDO::PARAM_STR);
            $result->bindParam(3, $dispositions, PDO::PARAM_STR);
            $result->bindParam(4, $data['active'], PDO::PARAM_STR);
            $result->bindParam(5, $speech, PDO::PARAM_STR);
            $result->bindParam(6, $_SESSION['user']->email, PDO::PARAM_STR);
            $_SESSION['flash']['message'] = 'created';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorCreate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
            //die("Error User->register() " . $e->getMessage());
        }
    }
    
    public function saveDynamic($data,$form){
        $sql1 = "INSERT INTO FORM_".$form." (";
        $sql2 = " VALUES (";
        if($data['callBack']==='callBack'){
            $cb_datetime = $data['cb_datetime']." ".$data['hora_cb'].":".$data['min_cb'].":00";
            $sql1 .= "cb_datetime";
            $sql2 .= "'".$cb_datetime."'";
            $sql1 .= ", ";
            $sql2 .= ", ";
        }
        foreach ($data as $key => $value) {
//            echo "Llave: ".$key."<br/>";
//            echo "Valor: ".$value."<br/>";
            if($key==cb_datetime||$key==hora_cb||$key==min_cb){
                
            }else{
                $sql1 .= $key;
                $sql2 .= "'".$value."'";            
            }
            
            if($key=='disposition'|$key==cb_datetime||$key==hora_cb||$key==min_cb){
                
            }else{
                $sql1 .= ", ";
                $sql2 .= ", ";
            }
            
        }
        $sql1 .= ") ";
        $sql2 .= ") ";
        echo $sql1." ".$sql2;
        
        try{
            $result = parent::connect()->prepare($sql1." ".$sql2);
            $_SESSION['flash']['message'] = 'created';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorCreate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
            //die("Error User->register() " . $e->getMessage());
        }
    }
    
    public function deleteR($data){
        $form = self::find($data['id']);
        try{
            $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_forms WHERE id = ?");
            $result->bindParam(1, $data['id'], PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'deleted';
            $result->execute();
            $deleteForm = self::deleteRForm($form->name);
            return $deleteForm;
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorDelete';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }
    
    public function deleteRForm($data){
        try{
            $bd = parent::connect();
            $sql = "DROP TABLE IF EXISTS `FORM_" . $data . "` , `HIST_" . $data . "`";
            $result = $bd->prepare($sql);
            $_SESSION['flash']['message'] = 'deleted';
            $fileContainer = dirname(__FILE__)."/../views/forms/FORM_".$data.".php";
            unlink($fileContainer);
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorDelete';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }
    
    public function updateR($data){
        $dispositions = json_encode($data['disposition']);
        $speech = htmlentities($data['speech']);
        try{
            $result = parent::connect()->prepare("UPDATE ".PREFIX."_forms SET name=?, description=?, dispositions=?, active=?, speech=?, userUpdate=?, dateUpdate=NOW() WHERE id = ?");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['description'], PDO::PARAM_STR);
            $result->bindParam(3, $dispositions, PDO::PARAM_STR);
            $result->bindParam(4, $data['active'], PDO::PARAM_STR);
            $result->bindParam(5, $speech, PDO::PARAM_STR);
            $result->bindParam(6, $_SESSION['user']->email, PDO::PARAM_STR);
            $result->bindParam(7, $data['id'], PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'updated';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
            //die("Error User->register() " . $e->getMessage());
        }
    }
    
    public function createForm($data){
        $bd = parent::connect();
            
        try {
            //Tabla principal
            $sql = "CREATE TABLE `FORM_" . $data['form_name'] . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `idCamp` int(11) NOT NULL DEFAULT " . $data['form_id'] . ",
                `idExtra` varchar(255) NOT NULL DEFAULT '',
                `idContact` varchar(255) NOT NULL DEFAULT '',
                `phone1` BIGINT NOT NULL DEFAULT '0',
                `phone2` BIGINT NOT NULL DEFAULT '0',
                `phone3` BIGINT NOT NULL DEFAULT '0',
                `phone4` BIGINT NOT NULL DEFAULT '0',
                `uniqueid` varchar(255) NOT NULL DEFAULT '',
                `linkedid` varchar(255) NOT NULL DEFAULT '',
                `attempts` int(11) NOT NULL DEFAULT '0',
                `disposition` varchar(255) NOT NULL DEFAULT '',
                `agent` varchar(255) NOT NULL DEFAULT '',
                `lastupdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
                `callBack` varchar(50) NOT NULL DEFAULT '',
                `cb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                `inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                ";
            
            //Tabla historico
            $sqlHist = "CREATE TABLE `HIST_" . $data['form_name'] . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `idCamp` int(11) NOT NULL DEFAULT " . $data['form_id'] . ",
                `idExtra` varchar(255) NOT NULL DEFAULT '',
                `idContact` varchar(255) NOT NULL DEFAULT '',
                `idLead` int(11) NOT NULL,
                `phone1` BIGINT NOT NULL DEFAULT '0',
                `phone2` BIGINT NOT NULL DEFAULT '0',
                `phone3` BIGINT NOT NULL DEFAULT '0',
                `phone4` BIGINT NOT NULL DEFAULT '0',
                `uniqueid` varchar(255) NOT NULL DEFAULT '',
                `linkedid` varchar(255) NOT NULL DEFAULT '',
                `attempts` int(11) NOT NULL DEFAULT '0',
                `disposition` varchar(255) NOT NULL DEFAULT '',
                `agent` varchar(255) NOT NULL DEFAULT '',
                `lastupdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
                `callBack` varchar(50) NOT NULL DEFAULT '',
                `cb_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                `inserted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                ";
            
            //Trigger partes 1 y 2
            $sqlTrig1 = "";
            $sqlTrig2 = "";
            
            //Bucle para generar campos dinámicos
            foreach ($data['frmb'] as $key => $value) {
                switch ($value['cssClass']) {
                    case "input_text":
                        $fieldName = str_replace(' ', '_', $value['values']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        switch ($value['type']) {
                            case "text":
                                $sql .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                                $sqlHist .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                                $sqlTrig1 .= ", " . $fieldName;
                                $sqlTrig2 .= ", NEW." . $fieldName;
                                break;
                            case "email":
                                $sql .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                                $sqlHist .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                                $sqlTrig1 .= ", " . $fieldName;
                                $sqlTrig2 .= ", NEW." . $fieldName;
                                break;
                            case "number":
                                $sql .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                                $sqlHist .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                                $sqlTrig1 .= ", " . $fieldName;
                                $sqlTrig2 .= ", NEW." . $fieldName;
                                break;
                            case "date":
                                $sql .= "`" . $fieldName . "` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',";
                                $sqlHist .= "`" . $fieldName . "` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',";
                                $sqlTrig1 .= ", " . $fieldName;
                                $sqlTrig2 .= ", NEW." . $fieldName;
                                break;
                            default:
                                break;
                        }
                        break;
                    case "textarea":
                        $fieldName = str_replace(' ', '_', $value['values']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $sql .= "`" . $fieldName . "` TEXT NOT NULL DEFAULT '',";
                        $sqlHist .= "`" . $fieldName . "` TEXT NOT NULL DEFAULT '',";
                        $sqlTrig1 .= ", " . $fieldName;
                        $sqlTrig2 .= ", NEW." . $fieldName;
                        break;
                    case "checkbox":
                        $fieldName = str_replace(' ', '_', $value['title']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        foreach ($value['values'] as $keySub => $valueSub) {
                            $fieldNameSub = str_replace(' ', '_', $valueSub['value']); // Replaces all spaces with hyphens.
                            $fieldNameSub = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldNameSub); // Removes special chars.
                            $fieldNameSub = preg_replace('/-+/', '-', $fieldNameSub); // Replaces multiple hyphens with single one.
                            $sql .= "`" . $fieldNameSub . "` varchar(255) NOT NULL DEFAULT '',";
                            $sqlHist .= "`" . $fieldNameSub . "` varchar(255) NOT NULL DEFAULT '',";
                            $sqlTrig1 .= ", " . $fieldNameSub;
                            $sqlTrig2 .= ", NEW." . $fieldNameSub;
                        }
                        break;
                    case "radio":
                        $fieldName = str_replace(' ', '_', $value['title']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $sql .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                        $sqlHist .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                        $sqlTrig1 .= ", " . $fieldName;
                        $sqlTrig2 .= ", NEW." . $fieldName;
                        break;
                    case "select":
                        $fieldName = str_replace(' ', '_', $value['title']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $sql .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                        $sqlHist .= "`" . $fieldName . "` varchar(255) NOT NULL DEFAULT '',";
                        $sqlTrig1 .= ", " . $fieldName;
                        $sqlTrig2 .= ", NEW." . $fieldName;
                        break;
                    default:
                        break;
                }
            }

            $sql .= "PRIMARY KEY (`id`),
                KEY `attempts` (`attempts`),
                KEY `disposition` (`disposition`),
                KEY `phone1` (`phone1`),
                KEY `phone2` (`phone2`),
                KEY `phone3` (`phone3`),
                KEY `phone4` (`phone4`),
                KEY `idExtra` (`idExtra`),
                KEY `idContact` (`idContact`),
                KEY `lastupdated` (`lastupdated`)
              ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
            
            $sqlHist .= "PRIMARY KEY (`id`),
                KEY `disposition` (`disposition`),
                KEY `idExtra` (`idExtra`),
                KEY `idContact` (`idContact`),
                KEY `idLead` (`idLead`)
              ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
            
            //Trigger para historial
            $sqlTrig = "CREATE DEFINER = 'root'@'localhost' TRIGGER `HIST_" . $data['form_name'] . "` AFTER UPDATE ON `FORM_" . $data['form_name'] . "`
                FOR EACH ROW
                BEGIN 
                INSERT INTO `HIST_" . $data['form_name'] . "`"
                . "(idCamp,idLead,idExtra,idContact,uniqueid,linkedid,attempts,disposition,agent,lastupdated,cb_datetime,callBack";
            //Bucle
            $sqlTrig .= $sqlTrig1;
            $sqlTrig .= ") ";
            $sqlTrig .= "VALUES('" . $data['form_id'] . "', NEW.id, NEW.idExtra, NEW.idContact, NEW.uniqueid, NEW.linkedid, NEW.attempts, NEW.disposition, NEW.agent, NEW.lastupdated, NEW.cb_datetime, NEW.callBack";
            //Bucle
            $sqlTrig .= $sqlTrig2;
            $sqlTrig .= ");";
            $sqlTrig .= "END";
            
            //echo "<br/> CONSULTA 1: " . $sql . "<br/> CONSULTA 2: " . $sqlHist . "<br/> CONSULTA 3: " . $sqlTrig;
            
            $bd->beginTransaction();
            
            $result = $bd->prepare($sql);
            $resultadoQuery = $result->execute();
            
            $resultHist = $bd->prepare($sqlHist);
            $resultadoQueryHist = $resultHist->execute();
            
            $resultTrig = $bd->prepare($sqlTrig);
            $resultadoQueryHTrig = $resultTrig->execute();
            
            $bd->commit();
            
//            echo '<br/>';
//            echo 'Resultado1: ';
//            echo '<br/>';
//            print_r($resultadoQuery);
//            echo '<br/>';
//            echo 'Resultado 2: ';
//            echo '<br/>';
//            print_r($resultadoQueryHist);
//            echo '<br/>';
//            echo 'Resultado 3: ';
//            echo '<br/>';
//            print_r($resultadoQueryHTrig);
//            echo '<br/>';
//            return $resultadoQuery;
            //Creo el archivo de formulario.
            
            if($resultadoQuery==1&&$resultadoQueryHist==1&&$resultadoQueryHTrig==1){
                //echo dirname(__FILE__);

                $fileContainer = dirname(__FILE__)."/../views/forms/FORM_".$data['form_name'].".php";
                $filePointer = fopen($fileContainer, "w+");
                
                $date = date('Y-m-d H:i:s', time());

                $header = '<div class="card">
                                    <div class="card-header">
                                        <h3>' . $data['form_name'] . '</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=form&method=storeDynamic&id='.$data['form_id'].'" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <div>
                                                        <?= html_entity_decode($form->speech) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            ';

                $body = '';
                $footer = '<div class="form-row">
                                                <div class="col-md-6 mb-3 form-check">
                                                    <label>Re-Agendar Llamada</label>
                                                    <br/>
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" id="callBack" name="callBack" value="callBack" >
                                                        <span class="form-check-sign">Agendar</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6 mb-1 cb_datetime form-group" style="display: none;">
                                                    <label for="cb_datetime">Fecha Llamada</label>
                                                    <br/>
                                                    <input type="text" class="datepicker form-control" autocomplete="off"  style="display: inline; width: 150px;"  id="cb_datetime" name="cb_datetime" value="<?= date("Y-m-d", strtotime(date("Y-m-d") . " +1 day")) ?>" required>
                                                    <select id="hora_cb" name="hora_cb" style="width: 80px;" class="custom-select" >
                                                        <option value="00">00</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>								  	
                                                    </select> - <select id="min_cb" name="min_cb" style="width: 80px;" class="custom-select" >
                                                        <option value="00">00</option>
                                                        <option value="05">05</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                        <option value="25">25</option>
                                                        <option value="30">30</option>
                                                        <option value="35">35</option>
                                                        <option value="40">40</option>
                                                        <option value="45">45</option>
                                                        <option value="50">50</option>
                                                        <option value="55">55</option>								  	
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3 form-group">
                                                    <label for="disposition">Resultado de Llamada</label>
                                                    <select type="select" id="disposition" name="disposition" class="custom-select" required>
                                                    <option value="">Seleccione</option>
                                                    <?php
                                                    foreach ($disposForm as $keyForm => $dispositionForm) {
                                                        foreach ($dispositions as $key => $disposition) {
                                                            if($disposition->id == $dispositionForm){
                                                                echo "<option value=\"".$disposition->name."\">".$disposition->name."</option>";
                                                            }   
                                                        }
                                                    }
                                                    ?>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                            <div style="display: none;" id="invalid-form-alert" class="col-md-6 mbg-3 alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close btn-xs" data-dismiss="alert">
                                                        <i class="ace-icon fa fa-times"></i>
                                                </button>
                                                Error de Validación. Verifique todos los campos y pulse nuevamente el botón!
                                            </div>
                                        </form>
                                        ';
                $script = "<script>
                                        // Example starter JavaScript for disabling form submissions if there are invalid fields
                                        (function() {
                                            'use strict';
                                            window.addEventListener('load', function() {
                                                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                var forms = document.getElementsByClassName('needs-validation');
                                                var alertInvalid = document.getElementById('invalid-form-alert');
                                                // Loop over them and prevent submission
                                                var validation = Array.prototype.filter.call(forms, function(form) {
                                                    form.addEventListener('submit', function(event) {
                                                        if (form.checkValidity() === false) {
                                                            event.preventDefault();
                                                            event.stopPropagation();
                                                            alertInvalid.style.display = \"block\";
                                                        }
                                                        form.classList.add('was-validated');
                                                    }, false);
                                                });
                                            }, false);
                                        })();
                                    </script>
                                    <script>
                                        $('#callBack').click(function () {
                                            if( $(this).is(':checked') ){
                                                $('.cb_datetime').show();
                                            }
                                            else{
                                                $('.cb_datetime').hide();
                                            }
                                        });
                                    </script>
                                </div>
                            </div>";
            
            //Bucle para generar campos dinámicos
            foreach ($data['frmb'] as $key => $value) {
                //Ajusto si el campo es obligatorio
                $fieldRequired = $value['required'];
                if($fieldRequired=="true"){
                    $fieldRequired="required";
                }else{
                    $fieldRequired="";
                }
                
                //Ajusto si el campo es solo lectura
                $fieldReadonly = $value['readonly'];
                if($fieldReadonly=="true"){
                    $fieldReadonly="readonly";
                }else{
                    $fieldReadonly="";
                }
                
                switch ($value['cssClass']) {
                    case "input_text":
                        $fieldName = str_replace(' ', '_', $value['values']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        switch ($value['type']) {
                            case "text":
                                $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="'.$fieldName.'">'.$value['values'].'</label>
                                                    <input type="text" class="form-control" id="'.$fieldName.'" name="'.$fieldName.'" value="<?= isset($_GET[\'idLead\']) ? $lead->'.$fieldName.':\'\' ?>" '.$fieldRequired.' '.$fieldReadonly.'>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            ';
                                break;
                            case "email":
                                $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="'.$fieldName.'">'.$value['values'].'</label>
                                                    <input type="email" class="form-control" id="'.$fieldName.'" name="'.$fieldName.'" value="<?= isset($_GET[\'idLead\']) ? $lead->'.$fieldName.':\'\' ?>" '.$fieldRequired.' '.$fieldReadonly.'>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un email válido</div>
                                                </div>
                                            </div>
                                            ';
                                break;
                            case "number":
                                $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="'.$fieldName.'">'.$value['values'].'</label>
                                                    <input type="number" class="form-control" id="'.$fieldName.'" name="'.$fieldName.'" value="<?= isset($_GET[\'idLead\']) ? $lead->'.$fieldName.':\'\' ?>" '.$fieldRequired.' '.$fieldReadonly.'>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un número válido</div>
                                                </div>
                                            </div>
                                            ';
                                break;
                            case "date":
                                $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="'.$fieldName.'">'.$value['values'].'</label>
                                                    <input type="text" class="datepicker form-control" autocomplete="off" id="'.$fieldName.'" name="'.$fieldName.'" value="<?= isset($_GET[\'idLead\']) ? $lead->'.$fieldName.':\'\' ?>" '.$fieldRequired.' '.$fieldReadonly.'>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba una fecha válida</div>
                                                </div>
                                            </div>
                                            ';
                                break;
                            default:
                                break;
                        }
                        break;
                    case "textarea":
                        $fieldName = str_replace(' ', '_', $value['values']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="'.$fieldName.'">'.$value['values'].'</label>
                                                    <textarea id="'.$fieldName.'" name="'.$fieldName.'" class="form-control" '.$fieldRequired.' '.$fieldReadonly.'><?= isset($_GET[\'idLead\']) ? $lead->'.$fieldName.':\'\' ?></textarea>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            ';
                        break;
                    case "checkbox":
                        $fieldName = str_replace(' ', '_', $value['title']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-3 form-check">
                                                    <label>'.$value['title'].'</label>
                                                    <br/>
                                                    ';
                        foreach ($value['values'] as $keySub => $valueSub) {
                            $fieldNameSub = str_replace(' ', '_', $valueSub['value']); // Replaces all spaces with hyphens.
                            $fieldNameSub = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldNameSub); // Removes special chars.
                            $fieldNameSub = preg_replace('/-+/', '-', $fieldNameSub); // Replaces multiple hyphens with single one.
                            //Ajusto si el campo esta seleccionado
                            $fieldChecked = $valueSub['baseline'];
                            if($fieldChecked=="true"){
                                $fieldChecked="checked";
                            }else{
                                $fieldChecked="";
                            }
                            $body .= '<label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" id="'.$fieldNameSub.'" name="'.$fieldNameSub.'" value="'.$valueSub['value'].'" '.$fieldChecked.'>
                                                        <span class="form-check-sign">'.$valueSub['value'].'</span>
                                                    </label>
                                                    ';
                        }
                        $body .= '<div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            ';
                        break;
                    case "radio":
                        $fieldName = str_replace(' ', '_', $value['title']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-3 form-check">
                                                    <label>'.$value['title'].'</label>
                                                    <br/>
                                                    ';
                        foreach ($value['values'] as $keySub => $valueSub) {
                            $fieldNameSub = str_replace(' ', '_', $valueSub['value']); // Replaces all spaces with hyphens.
                            $fieldNameSub = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldNameSub); // Removes special chars.
                            $fieldNameSub = preg_replace('/-+/', '-', $fieldNameSub); // Replaces multiple hyphens with single one.
                            //Ajusto si el campo esta seleccionado
                            $fieldChecked = $valueSub['baseline'];
                            if($fieldChecked=="true"){
                                $fieldChecked="checked";
                            }else{
                                $fieldChecked="";
                            }
                            $body .= '<label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" id="'.$fieldNameSub.'" name="'.$fieldName.'" value="'.$valueSub['value'].'" '.$fieldChecked.'>
                                                        <span class="form-radio-sign">'.$valueSub['value'].'</span>
                                                    </label>
                                                    ';
                        }
                        $body .= '<div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            ';
                        break;
                    case "select":
                        $fieldName = str_replace(' ', '_', $value['title']); // Replaces all spaces with hyphens.
                        $fieldName = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldName); // Removes special chars.
                        $fieldName = preg_replace('/-+/', '-', $fieldName); // Replaces multiple hyphens with single one.
                        $body .= '<div class="form-row">
                                                <div class="col-md-12 mb-3 form-group">
                                                    <label for="'.$fieldName.'">'.$value['title'].'</label>
                                                    <select type="select" id="'.$fieldName.'" name="'.$fieldName.'" class="custom-select" '.$fieldRequired.'>
                                                    <option value="">Seleccione</option>
                                                    ';
                        foreach ($value['values'] as $keySub => $valueSub) {
                            $fieldNameSub = str_replace(' ', '_', $valueSub['value']); // Replaces all spaces with hyphens.
                            $fieldNameSub = preg_replace('/[^A-Za-z0-9\_]/', '', $fieldNameSub); // Removes special chars.
                            $fieldNameSub = preg_replace('/-+/', '-', $fieldNameSub); // Replaces multiple hyphens with single one.
                            //Ajusto si el campo esta seleccionado
                            $fieldChecked = $valueSub['baseline'];
                            if($fieldChecked=="true"){
                                $fieldChecked="selected";
                            }else{
                                $fieldChecked="";
                            }
                            $body .= '<option value="'.$valueSub['value'].'" '.$fieldChecked.'>'.$valueSub['value'].'</option>
                                        ';
                        }
                        $body .= '</select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            ';
                        break;
                    default:
                        break;
                }
                
            }
                
                $file = $header.$body.$footer.$script;
                
                if(fputs($filePointer, $file)){
                    fclose($filePointer);
                    $_SESSION['ajax']['message'] = 'created';
                    return "OK";
                }else{
                    $_SESSION['ajax']['message'] = 'errorCreate';
                    $sqlRollback = "DROP TABLE `FORM_" . $data['form_name'] . "`";
                    $resultRollback = $bd->prepare($sqlRollback);
                    $resultRollback->execute();
                    $sqlRollback = "DROP TABLE `HIST_" . $data['form_name'] . "`";
                    $resultRollback = $bd->prepare($sqlRollback);
                    $resultRollback->execute();
                    return "FAIL ARCHIVO";
                }
            }else{
                $_SESSION['ajax']['message'] = 'errorCreate';
                $sqlRollback = "DROP TABLE `FORM_" . $data['form_name'] . "`";
                $resultRollback = $bd->prepare($sqlRollback);
                $resultRollback->execute();
                $sqlRollback = "DROP TABLE `HIST_" . $data['form_name'] . "`";
                $resultRollback = $bd->prepare($sqlRollback);
                $resultRollback->execute();
                return "FAIL QUERY"; 
            }
            
        } catch (Exception $e) {
            $bd->rollBack();
            $_SESSION['ajax']['message'] = 'errorCreate';
            $sqlRollback = "DROP TABLE `FORM_" . $data['form_name'] . "`";
            $resultRollback = $bd->prepare($sqlRollback);
            $resultRollback->execute();
            $sqlRollback = "DROP TABLE `HIST_" . $data['form_name'] . "`";
            $resultRollback = $bd->prepare($sqlRollback);
            $resultRollback->execute();
            return $e->getMessage();
        }
    }
}