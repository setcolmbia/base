<?php 
          
    class Timerules extends Database{ 
         
         
        public function all(){
            try {
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_timerules ORDER BY id');
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }        

        public function save($data){
            $name = $data['name'];
            $description = $data['description'];

            $startMonFri1 = $data['startMonFri1'];
            $startMonFri2 = $data['startMonFri2'];

            $startMonFri = $startMonFri1.':'.$startMonFri2;

            $endMonFri1 = $data['endMonFri1'];
            $endMonFri2 = $data['endMonFri2'];

            $endMonFri = $endMonFri1.':'.$endMonFri2;

            $startSat1 = $data['startSat1'];
            $startSat2 = $data['startSat2'];

            $startSat = $startSat1.':'.$startSat2;

            $endSat1 = $data['endSat1'];
            $endSat2 = $data['endSat2'];

            $endSat = $endSat1.':'.$endSat2;

            $startSun1 = $data['startSun1'];
            $startSun2 = $data['startSun2'];

            $startSun = $startSun1.':'.$startSun2;

            $endSun1 = $data['endSun1'];
            $endSun2 = $data['endSun2'];

            $endSun = $endSun1.':'.$endSun2;

            $dest = $data['dest'];        
            $destNO = $data['destNO'];        
            
            $idDest = $data['idDest'];
            $idDestNO = $data['idDestNO'];
            
            try {
                $bd = parent::connect();
                $result = $bd->prepare('INSERT INTO '.PREFIX .'_timerules (name,description,startMonFri,endMonFri,startSat,endSat,startSun,endSun,dest,idDest,destNO,idDestNO,userCreate,dateCreate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())');
                $result->bindParam(1, $name , PDO::PARAM_STR);
                $result->bindParam(2, $description , PDO::PARAM_STR);
                $result->bindParam(3, $startMonFri , PDO::PARAM_STR);
                $result->bindParam(4, $endMonFri , PDO::PARAM_STR);
                $result->bindParam(5, $startSat , PDO::PARAM_STR);
                $result->bindParam(6, $endSat , PDO::PARAM_STR);
                $result->bindParam(7, $startSun , PDO::PARAM_STR);
                $result->bindParam(8, $endSun , PDO::PARAM_STR);
                $result->bindParam(9, $dest , PDO::PARAM_STR);
                $result->bindParam(10, $idDest , PDO::PARAM_STR);
                $result->bindParam(11, $destNO , PDO::PARAM_STR);
                $result->bindParam(12, $idDestNO , PDO::PARAM_STR);
                $result->bindParam(13, $_SESSION['user']->email, PDO::PARAM_STR);
                $resultInsert = $result->execute();
                //$ivrId = $bd->lastInsertId();
                $_SESSION['flash']['message'] = 'created';
            	return $resultInsert;
            } catch (Exception  $e) { 
                $_SESSION['flash']['message'] = 'errorCreate';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return  $e->getMessage();
            }
        }

        public function delete_register($data){
            $id = $data['id'];            
            try{
                $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_timerules WHERE id = ?");
                $result->bindParam(1, $data['id'], PDO::PARAM_INT);
                $_SESSION['flash']['message'] = 'deleted';                
                return $result->execute();
            }catch (Exception $e){
                $_SESSION['flash']['message'] = 'errorDelete';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return $e->getMessage();
            }
        }

        public function find($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_timerules WHERE id = ?");
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

            $startMonFri1 = $data['startMonFri1'];
            $startMonFri2 = $data['startMonFri2'];

            $startMonFri = $startMonFri1.':'.$startMonFri2;

            $endMonFri1 = $data['endMonFri1'];
            $endMonFri2 = $data['endMonFri2'];

            $endMonFri = $endMonFri1.':'.$endMonFri2;

            $startSat1 = $data['startSat1'];
            $startSat2 = $data['startSat2'];

            $startSat = $startSat1.':'.$startSat2;

            $endSat1 = $data['endSat1'];
            $endSat2 = $data['endSat2'];

            $endSat = $endSat1.':'.$endSat2;

            $startSun1 = $data['startSun1'];
            $startSun2 = $data['startSun2'];

            $startSun = $startSun1.':'.$startSun2;

            $endSun1 = $data['endSun1'];
            $endSun2 = $data['endSun2'];

            $endSun = $endSun1.':'.$endSun2;

            $dest = $data['dest'];        
            $destNO = $data['destNO'];        
            
            $idDest = $data['idDest'];
            $idDestNO = $data['idDestNO'];
            try{
                $bd = parent::connect();    
                $result = parent::connect()->prepare("UPDATE ".PREFIX."_timerules SET name = ?, description = ?, startMonFri = ?, endMonFri = ?, startSat = ?, endSat = ?, startSun = ?, endSun = ?, dest = ?, idDest = ?, destNO = ?, idDestNO = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->bindParam(2, $description, PDO::PARAM_STR);
                $result->bindParam(3, $startMonFri, PDO::PARAM_STR);
                $result->bindParam(4, $endMonFri, PDO::PARAM_STR);
                $result->bindParam(5, $startSat, PDO::PARAM_STR);
                $result->bindParam(6, $endSat, PDO::PARAM_STR);
                $result->bindParam(7, $startSun, PDO::PARAM_STR);
                $result->bindParam(8, $endSun, PDO::PARAM_STR);
                $result->bindParam(9, $dest, PDO::PARAM_STR);
                $result->bindParam(10, $idDest, PDO::PARAM_STR);
                $result->bindParam(11, $destNO, PDO::PARAM_STR);
                $result->bindParam(12, $idDestNO, PDO::PARAM_STR);
                $result->bindParam(13, $_SESSION['user']->email, PDO::PARAM_STR);
                $result->bindParam(14, $id, PDO::PARAM_INT);
                
                $_SESSION['flash']['message'] = 'updated';
                return $result->execute();
            }catch (Exception $e){
                $_SESSION['flash']['message'] = 'errorUpdate';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return $e->getMessage();
            }
        }

        public function findByOptions($option,$id){        
            try{
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_'.$option.' WHERE id = ?');
                //$result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_'.$option.' ORDER BY id');
                $result->bindParam(1, $id, PDO::PARAM_INT);
                $result->execute();
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function findByAny($name){        
            $name = "%".$name."%";
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_timerules WHERE name like ? ");            
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function findByAnyDelete($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_timerules WHERE id = ? ");            
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }      
                
    }
?>
       