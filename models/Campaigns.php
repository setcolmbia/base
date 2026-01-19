<?php 
          
    class Campaigns extends Database{ 
         
         
        public function all(){
            try {
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_campaigns ORDER BY id');
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        public function allActive(){
        $type = 'ROBOT';
        $active = 'SI';
            try {
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX.'_campaigns WHERE type = ? AND active = ?');
                $result->bindParam(1, $type, PDO::PARAM_STR);
                $result->bindParam(2, $active, PDO::PARAM_STR);
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        
        public function countAll(){
            $type = 'ROBOT';
            try{
                $query = "SELECT count(id) as cantidad FROM ".PREFIX."_campaigns WHERE type = ?";
                $result = parent::connect()->prepare($query);
                $result->bindParam(1, $type, PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        
        public function countAllActive(){
            $type = 'ROBOT';
            $active = 'SI';
            try{
                $query = "SELECT count(id) as cantidad FROM ".PREFIX."_campaigns WHERE type = ? AND active = ?";
                $result = parent::connect()->prepare($query);
                $result->bindParam(1, $type, PDO::PARAM_STR);
                $result->bindParam(2, $active, PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function save($data){
            $name = $data['name'];
            $startMF = $data['startMF1'].':'.$data['startMF2'];
            $endMF = $data['endMF1'].':'.$data['endMF2'];
            $startSat = $data['startSat1'].':'.$data['startSat2'];
            $endSat = $data['endSat1'].':'.$data['endSat2'];
            $startSun = $data['startSun1'].':'.$data['startSun2'];
            $endSun = $data['endSun1'].':'.$data['endSun2'];
            $start = $data['start'];
            $end = $data['end'];
            try {
                $bd = parent::connect();
                $result = $bd->prepare('INSERT INTO '.PREFIX .'_campaigns (name,description,duration,number,recording,startMF,endMF,startSat,endSat,startSun,endSun,start,end,active,route,ratio,userCreate,dateCreate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())');
                $result->bindParam(1, $name , PDO::PARAM_STR);
                $result->bindParam(2, $data['description'] , PDO::PARAM_STR);
                $result->bindParam(3, $data['duration'] , PDO::PARAM_STR);
                $result->bindParam(4, $data['number'] , PDO::PARAM_STR);
                $result->bindParam(5, $data['recording'] , PDO::PARAM_STR);
                $result->bindParam(6, $startMF , PDO::PARAM_STR);
                $result->bindParam(7, $endMF , PDO::PARAM_STR);
                $result->bindParam(8, $startSat , PDO::PARAM_STR);
                $result->bindParam(9, $endSat, PDO::PARAM_STR);
                $result->bindParam(10, $startSun , PDO::PARAM_STR);
                $result->bindParam(11, $endSun , PDO::PARAM_STR);
                $result->bindParam(12, $start , PDO::PARAM_STR);
                $result->bindParam(13, $end , PDO::PARAM_STR);
                $result->bindParam(14, $data['active'] , PDO::PARAM_STR);
                $result->bindParam(15, $data['outboundroute'] , PDO::PARAM_STR);
                $result->bindParam(16, $data['ratio'] , PDO::PARAM_STR);
                $result->bindParam(17, $_SESSION['user']->email, PDO::PARAM_STR);
                $resultInsert = $result->execute();
                $campaignId = $bd->lastInsertId();
                $_SESSION['flash']['message'] = 'created';
                
                try {
                    //Crear tabla AUT+CAMPAÑA
                    $createaut = parent::connect()->prepare('CREATE TABLE '.PREFIX .'_AUT_'.$name.' (
                                                            id int(11) NOT NULL AUTO_INCREMENT,
                                                            idExtra int(11) DEFAULT NULL,
                                                            campaignId int(11) NOT NULL DEFAULT '.$campaignId.',
                                                            name varchar(100) DEFAULT NULL,
                                                            phone varchar(100) DEFAULT NULL,                                                          
                                                            phone2 varchar(100) DEFAULT NULL,
                                                            phone3 varchar(100) DEFAULT NULL,
                                                            phone4 varchar(100) DEFAULT NULL,
                                                            recording varchar(250) DEFAULT NULL,
                                                            uniqueid varchar(250) DEFAULT NULL,
                                                            linkedid varchar(250) DEFAULT NULL,
                                                            attempts int(11) DEFAULT 0,
                                                            disposition varchar(50) DEFAULT 1,
                                                            agent varchar(200) DEFAULT NULL,
                                                            field1 varchar(250) DEFAULT NULL,
                                                            field2 varchar(250) DEFAULT NULL,
                                                            field3 varchar(250) DEFAULT NULL,
                                                            field4 varchar(250) DEFAULT NULL,
                                                            field5 varchar(250) DEFAULT NULL,
                                                            field6 varchar(250) DEFAULT NULL,
                                                            field7 varchar(250) DEFAULT NULL,
                                                            field8 varchar(250) DEFAULT NULL,
                                                            field9 varchar(250) DEFAULT NULL,
                                                            field10 varchar(250) DEFAULT NULL,
                                                            field11 varchar(250) DEFAULT NULL,
                                                            field12 varchar(250) DEFAULT NULL,
                                                            field13 varchar(250) DEFAULT NULL,
                                                            field14 varchar(250) DEFAULT NULL,
                                                            field15 varchar(250) DEFAULT NULL,
                                                            lastUpdated datetime DEFAULT NULL,
                                                            cbDatetime datetime DEFAULT NULL,
                                                            firstCall varchar(50) DEFAULT NULL,
                                                            sipcause varchar(250) DEFAULT NULL,
                                                            isdncause varchar(250) DEFAULT NULL,
                                                            astcause varchar(250) DEFAULT NULL,
                                                            PRIMARY KEY (id)
                                                            )');
                    $createaut->execute();
                    try {
                        //Crear tabla HIST_AUT_+Campaña
                        $createhistaut = parent::connect()->prepare('CREATE TABLE '.PREFIX .'_HIST_AUT_'.$name.' (
                                                                    id int(11) NOT NULL AUTO_INCREMENT,
                                                                    idExtra int(11) DEFAULT NULL,
                                                                    idLead int(11) NOT NULL,
                                                                    campaignId int(11) NOT NULL DEFAULT '.$campaignId.',
                                                                    name varchar(100) DEFAULT NULL,
                                                                    phone varchar(100) DEFAULT NULL,                                                          
                                                                    phone2 varchar(100) DEFAULT NULL,
                                                                    phone3 varchar(100) DEFAULT NULL,
                                                                    phone4 varchar(100) DEFAULT NULL,
                                                                    recording varchar(250) DEFAULT NULL,
                                                                    uniqueid varchar(250) DEFAULT NULL,
                                                                    linkedid varchar(250) DEFAULT NULL,
                                                                    attempts int(11) DEFAULT 0,
                                                                    disposition varchar(50) DEFAULT 1,
                                                                    agent varchar(200) DEFAULT NULL,
                                                                    field1 varchar(250) DEFAULT NULL,
                                                                    field2 varchar(250) DEFAULT NULL,
                                                                    field3 varchar(250) DEFAULT NULL,
                                                                    field4 varchar(250) DEFAULT NULL,
                                                                    field5 varchar(250) DEFAULT NULL,
                                                                    field6 varchar(250) DEFAULT NULL,
                                                                    field7 varchar(250) DEFAULT NULL,
                                                                    field8 varchar(250) DEFAULT NULL,
                                                                    field9 varchar(250) DEFAULT NULL,
                                                                    field10 varchar(250) DEFAULT NULL,
                                                                    field11 varchar(250) DEFAULT NULL,
                                                                    field12 varchar(250) DEFAULT NULL,
                                                                    field13 varchar(250) DEFAULT NULL,
                                                                    field14 varchar(250) DEFAULT NULL,
                                                                    field15 varchar(250) DEFAULT NULL,
                                                                    lastUpdated datetime DEFAULT NULL,
                                                                    cbDatetime datetime DEFAULT NULL,
                                                                    firstCall varchar(50) DEFAULT NULL,
                                                                    sipcause varchar(250) DEFAULT NULL,
                                                                    isdncause varchar(250) DEFAULT NULL,
                                                                    astcause varchar(250) DEFAULT NULL,
                                                                  PRIMARY KEY (id)
                                                                )');
                        $createhistaut->execute();
                        try{
                            //Creo Trigger
                            $sqlTrig="CREATE DEFINER = 'root'@'localhost' TRIGGER ".PREFIX ."_HIST_AUT_".$name." AFTER UPDATE ON ".PREFIX ."_AUT_".$name."
					FOR EACH ROW
					BEGIN 
					INSERT INTO ".PREFIX ."_HIST_AUT_".$name."(idExtra, idLead, name, phone, phone2, phone3, phone4, recording, uniqueid, linkedid, attempts, disposition, agent, field1, field2, field3, field4, field5, field6, field7, field8, field9, field10, field11, field12, field13, field14, field15, lastUpdated, cbDatetime, firstCall, sipcause, isdncause, astcause)
                                        VALUES(NEW.idExtra, NEW.id, NEW.name, NEW.phone, NEW.phone2, NEW.phone3, NEW.phone4, NEW.recording, NEW.uniqueid, NEW.linkedid, NEW.attempts, NEW.disposition, NEW.agent, NEW.field1, NEW.field2, NEW.field3, NEW.field4, NEW.field5, NEW.field6, NEW.field7, NEW.field8, NEW.field9, NEW.field10, NEW.field11, NEW.field12, NEW.field13, NEW.field14, NEW.field15, NEW.lastUpdated, NEW.cbDatetime, NEW.firstCall, NEW.sipcause, NEW.isdncause, NEW.astcause);
					END";
                            $createtrigger = parent::connect()->prepare("$sqlTrig");
                            $createtrigger->bindParam(1, $data['id'], PDO::PARAM_INT);
                            $createtrigger->execute();
                        }catch(Exception $ctrig){
                            return $ctrig->getMessage();
                        }
                    }catch (Exception  $chistaut){
                        return  $chistaut->getMessage();
                    }
                }catch (Exception  $caut){
                    return  $caut->getMessage();
                }
                return $resultInsert;
            } catch (Exception  $e) { 
                $_SESSION['flash']['message'] = 'errorCreate';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return  $e->getMessage();
            }
        }

        public function delete_register($data){
            $id = $data['id'];
            $campaign = $this->find($id);
            $name = $campaign->name;
            try{
                $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_campaigns WHERE id = ?");
                $result->bindParam(1, $data['id'], PDO::PARAM_INT);
                $_SESSION['flash']['message'] = 'deleted';
                try{
                    //Borrar tabla tabla AUT+CAMPAÑA
                    $dropauto = parent::connect()->prepare("DROP TABLE ".PREFIX ."_AUT_".$name." ");
                    $dropauto->execute();
                    try{
                        //Borrar tabla HIST_AUT_+Campaña
                        $drophistaut = parent::connect()->prepare("DROP TABLE ".PREFIX ."_HIST_AUT_".$name." ");
                        $drophistaut->execute();
                        try{
                            //Borrar registros en la tabl Events de la campaña creada
                            $elimregevent = parent::connect()->prepare("DELETE FROM ".PREFIX."_events WHERE campaignId = ?");
                            $elimregevent->bindParam(1, $data['id'], PDO::PARAM_INT);
                            $elimregevent->execute();
                        }catch(Exception $erev){
                            return $erev->getMessage();
                        }
                    }catch(Exception $ehistaut){
                        return $ehistaut->getMessage();
                    }
                }catch(Exception $eaut){
                    return $eaut->getMessage();
                }
                return $result->execute();
            }catch (Exception $e){
                $_SESSION['flash']['message'] = 'errorDelete';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return $e->getMessage();
            }
        }

        public function find($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_campaigns WHERE id = ?");
                $result->bindParam(1, $id, PDO::PARAM_INT);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function updateR($data){
            $id = $data['id'];
            $name = $data['name'];
            $description = $data['description'];
            $number = $data['number'];
            $duration = $data['duration'];
            $recording = $data['recording'];
            $active = $data['active'];
            $startMF = $data['startMF1'].':'.$data['startMF2'];
            $endMF = $data['endMF1'].':'.$data['endMF2'];
            $startSat = $data['startSat1'].':'.$data['startSat2'];
            $endSat = $data['endSat1'].':'.$data['endSat2'];
            $startSun = $data['startSun1'].':'.$data['startSun2'];
            $endSun = $data['endSun1'].':'.$data['endSun2'];
            $start = $data['start'];
            $end = $data['end'];
            try{
                $result = parent::connect()->prepare("UPDATE ".PREFIX."_campaigns SET name = ?, description = ?, number = ?, duration = ?, recording = ?, active = ?, startMF = ?, endMF = ?, startSat = ?, endSat = ?, startSun = ?, endSun = ?, start = ?, end = ?, route = ?, ratio = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->bindParam(2, $description, PDO::PARAM_STR);
                $result->bindParam(3, $number, PDO::PARAM_STR);
                $result->bindParam(4, $duration, PDO::PARAM_STR);
                $result->bindParam(5, $recording, PDO::PARAM_STR);
                $result->bindParam(6, $active, PDO::PARAM_STR);
                $result->bindParam(7, $startMF, PDO::PARAM_STR);
                $result->bindParam(8, $endMF, PDO::PARAM_STR);
                $result->bindParam(9, $startSat, PDO::PARAM_STR);
                $result->bindParam(10, $endSat, PDO::PARAM_STR);
                $result->bindParam(11, $startSun, PDO::PARAM_STR);
                $result->bindParam(12, $endSun, PDO::PARAM_STR);
                $result->bindParam(13, $start, PDO::PARAM_STR);
                $result->bindParam(14, $end, PDO::PARAM_STR);
                $result->bindParam(15, $data['outboundroute'] , PDO::PARAM_STR);
                $result->bindParam(16, $data['ratio'] , PDO::PARAM_STR);
                $result->bindParam(17, $_SESSION['user']->email, PDO::PARAM_STR);
                $result->bindParam(18, $id, PDO::PARAM_INT);
                $_SESSION['flash']['message'] = 'updated';
                return $result->execute();
            }catch (Exception $e){
                $_SESSION['flash']['message'] = 'errorUpdate';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return $e->getMessage();
            }
        }

        public function findByAny($name){        
            $name = "%".$name."%";
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_campaigns WHERE name like ? ");            
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function findByAnyDelete($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_campaigns WHERE id = ? ");            
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function recording($id){
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_recordings WHERE id = ?");
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function recordings(){
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_recordings order by name asc");
                $result->execute();
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function import_file($data){
            $id = $data['id'];
            $name = $data['name'];
            print_r($_FILES);
            if($_FILES['file']['error']== 0 && $_FILES['file']['type']=='text/csv'){
                $error = 0;
            }else{
                $error = 1;
            }
            try {
                if ($error == 0){
                    $row = 0;
                    $archivo = fopen($_FILES['file']['tmp_name'],"r");
                    if (($handle = $archivo) !== FALSE) {
                        while (($datas = fgetcsv($handle, 1024, ";")) !== FALSE) {
                            if ($row >= 1){
                                $campaignId = $id;
                                $nameaut = $datas[0];
                                $phone = $datas[1];
                                $phone2 = $datas[2];
                                $phone3 = $datas[3];
                                $phone4 = $datas[4];
                                $field1 = $datas[5];
                                $field2 = $datas[6];
                                $field3 = $datas[7];
                                $field4 = $datas[8];
                                $field5 = $datas[9];
                                $field6 = $datas[10];
                                $field7 = $datas[11];
                                $field8 = $datas[12];
                                $field9 = $datas[13];
                                $field10 = $datas[14];
                                $field11 = $datas[15];
                                $field12 = $datas[16];
                                $field13 = $datas[17];
                                $field14 = $datas[18];
                                $field15 = $datas[19];
                                $result = parent::connect()->prepare('INSERT INTO '.PREFIX .'_AUT_'.$name.' (campaignId,name,phone,phone2,phone3,phone4,field1,field2,field3,field4,field5,field6,field7,field8,field9,field10,field11,field12,field13,field14,field15) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
                                $result->bindParam(1, $campaignId , PDO::PARAM_STR);
                                $result->bindParam(2, $nameaut , PDO::PARAM_STR);
                                $result->bindParam(3, $phone , PDO::PARAM_STR);
                                $result->bindParam(4, $phone2 , PDO::PARAM_STR);
                                $result->bindParam(5, $phone3 , PDO::PARAM_STR);
                                $result->bindParam(6, $phone4 , PDO::PARAM_STR);
                                $result->bindParam(7, $field1 , PDO::PARAM_STR);
                                $result->bindParam(8, $field2 , PDO::PARAM_STR);
                                $result->bindParam(9, $field3 , PDO::PARAM_STR);
                                $result->bindParam(10, $field4 , PDO::PARAM_STR);
                                $result->bindParam(11, $field5 , PDO::PARAM_STR);
                                $result->bindParam(12, $field6 , PDO::PARAM_STR);
                                $result->bindParam(13, $field7 , PDO::PARAM_STR);
                                $result->bindParam(14, $field8 , PDO::PARAM_STR);
                                $result->bindParam(15, $field9 , PDO::PARAM_STR);
                                $result->bindParam(16, $field10 , PDO::PARAM_STR);
                                $result->bindParam(17, $field11 , PDO::PARAM_STR);
                                $result->bindParam(18, $field12 , PDO::PARAM_STR);
                                $result->bindParam(19, $field13 , PDO::PARAM_STR);
                                $result->bindParam(20, $field14 , PDO::PARAM_STR);
                                $result->bindParam(21, $field15 , PDO::PARAM_STR);
                                $result->execute();
                            }
                            $row++;
                        }
                        fclose($handle);
                    }
                    $_SESSION['flash']['message'] = 'imported';
                    return true;
                }
            } catch (Exception  $e) {
                if ($error == 1){
                    return  $e->getMessage().' - '.$msgerror;
                    $_SESSION['flash']['message'] = 'errorImport';
                    $_SESSION['flash']['detail'] = $e->getMessage();
                }
                $_SESSION['flash']['message'] = 'errorImport';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return  $e->getMessage();
            }
        }

        public function import_range($data){
            $id = $data['id'];
            $name = $data['name'];
            $range_from = $data['range_from'];
            $range_up = $data['range_up'];
            $status = 'Pendiente';
            $date_event = date('Y-m-d H:i:s');
            $amount = ($range_up - $range_from) + 1;
            try {
                $result = parent::connect()->prepare('INSERT INTO '.PREFIX .'_events (date_event,campaignId,range_from,range_up,status,amount,userCreate,dateCreate) values(?,?,?,?,?,?,?,NOW())');
                $result->bindParam(1, $date_event , PDO::PARAM_STR);
                $result->bindParam(2, $id , PDO::PARAM_STR);
                $result->bindParam(3, $range_from , PDO::PARAM_STR);
                $result->bindParam(4, $range_up , PDO::PARAM_STR);
                $result->bindParam(5, $status , PDO::PARAM_STR);
                $result->bindParam(6, $amount , PDO::PARAM_STR);
                $result->bindParam(7, $_SESSION['user']->email, PDO::PARAM_STR);
                $_SESSION['flash']['message'] = 'createrange';
                return $result->execute();
            } catch (Exception  $e) { 
                $_SESSION['flash']['message'] = 'errorCreate';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return  $e->getMessage();
            }
        }

        public function hour($id){
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_hours WHERE id = ?");
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function hours(){
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_hours order by id asc");
                $result->execute();
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function minute($id){
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_minutes WHERE id = ?");
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function minutes(){
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_minutes order by id asc");
                $result->execute();
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        
        public function dialStatus($campaign){
            $response['dialing']=0;
            $response['waiting']=0;
            $response['called']=0;
            try{
                $result = parent::connect()->prepare("SELECT disposition, count(disposition) AS count FROM ".PREFIX."_AUT_".$campaign." WHERE disposition <> '' GROUP BY disposition");
                $result->execute();
                $records = $result->fetchAll();
                //print_r($records);
                foreach ($records as $record) {
                    switch ($record->disposition) {
                        case "-13":
                            $response['dialing'] += $record->count;
                            break;
                        case "1":
                            $response['waiting'] += $record->count;
                            break;
                        default:
                            $response['called'] += $record->count;
                            break;
                    }
                }
                return $response;    
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function export_file($campaign){
            
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_AUT_".$campaign." order by id asc");
                $result->execute();
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
    }
?>
       