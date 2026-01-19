<?php 
          
    class Ivrs extends Database{ 
         
         
        public function all(){
            try {
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_ivrs ORDER BY id');
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
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX.'_ivrs WHERE type = ? AND active = ?');
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
                $query = "SELECT count(id) as cantidad FROM ".PREFIX."_ivrs WHERE type = ?";
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
                $query = "SELECT count(id) as cantidad FROM ".PREFIX."_ivrs WHERE type = ? AND active = ?";
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
            $description = $data['description'];
            $number = $data['number'];
            $directDial = $data['directDial'];
            $timeout = $data['timeout'];
            $recording = $data['recording'];        
            $option1 = $data['option1'];        
            $option2 = $data['option2'];        
            $option3 = $data['option3'];        
            $option4 = $data['option4'];            
            $option5 = $data['option5'];        
            $option6 = $data['option6'];        
            $option7 = $data['option7'];        
            $option8 = $data['option8'];    
            $option9 = $data['option9'];        
            $option10 = $data['option10'];        
            $option11 = $data['option11'];        
            $option12 = $data['option12'];
            $destination1 = $data['destination1'];
            $destination2 = $data['destination2'];
            $destination3 = $data['destination3'];
            $destination4 = $data['destination4'];
            $destination5 = $data['destination5'];
            $destination6 = $data['destination6'];
            $destination7 = $data['destination7'];
            $destination8 = $data['destination8'];
            $destination9 = $data['destination9'];
            $destination10 = $data['destination10'];
            $destination11 = $data['destination11'];
            $destination12 = $data['destination12'];
            try {
                $bd = parent::connect();
                $result = $bd->prepare('INSERT INTO '.PREFIX .'_ivrs (name,description,number,directDial,timeout,recording,userCreate,dateCreate) VALUES(?,?,?,?,?,?,?,NOW())');
                $result->bindParam(1, $name , PDO::PARAM_STR);
                $result->bindParam(2, $description , PDO::PARAM_STR);
                $result->bindParam(3, $number , PDO::PARAM_STR);
                $result->bindParam(4, $directDial , PDO::PARAM_STR);
                $result->bindParam(5, $timeout , PDO::PARAM_STR);
                $result->bindParam(6, $recording , PDO::PARAM_STR);
                $result->bindParam(7, $_SESSION['user']->email, PDO::PARAM_STR);
                $resultInsert = $result->execute();
                $ivrId = $bd->lastInsertId();
                $_SESSION['flash']['message'] = 'created';
                try {
                    //Llenar tabla ivrmenus con la opciones del ivrs
                        $band = 1;
                        $reginsert = 12;
                        $options = 0;
                        $destinations = '';
                        while ($band <= $reginsert) {
                            if ($band == 1){
                                $options = $option1;
                                $destinations = $destination1;
                            }
                            if ($band == 2){
                                $options = $option2;
                                $destinations = $destination2;
                            }
                            if ($band == 3){
                                $options = $option3;
                                $destinations = $destination3;
                            }
                            if ($band == 4){
                                $options = $option4;
                                $destinations = $destination4;
                            }
                            if ($band == 5){
                                $options = $option5;
                                $destinations = $destination5;
                            }
                            if ($band == 6){
                                $options = $option6;
                                $destinations = $destination6;
                            }
                            if ($band == 7){
                                $options = $option7;
                                $destinations = $destination7;
                            }
                            if ($band == 8){
                                $options = $option8;
                                $destinations = $destination8;
                            }
                            if ($band == 9){
                                $options = $option9;
                                $destinations = $destination9;
                            }
                            if ($band == 10){
                                $options = $option10;
                                $destinations = $destination10;
                            }
                            if ($band == 11){
                                $options = $option11;
                                $destinations = $destination11;
                            }
                            if ($band == 12){
                                $options = $option12;
                                $destinations = $destination12;
                            }
                            $optionsmenu = $bd->prepare('INSERT INTO '.PREFIX .'_ivrmenus (idIvr,dest,idDest,option,userCreate,dateCreate) VALUES(?,?,?,?,?,NOW())');
                            $optionsmenu->bindParam(1, $ivrId , PDO::PARAM_STR);
                            $optionsmenu->bindParam(2, $options , PDO::PARAM_STR);
                            $optionsmenu->bindParam(3, $destinations , PDO::PARAM_STR);
                            $optionsmenu->bindParam(4, $band , PDO::PARAM_STR);
                            $optionsmenu->bindParam(5, $_SESSION['user']->email, PDO::PARAM_STR); 
                            $optionsmenu->execute();
                            $band++;
                        }
                        
                    }catch (Exception  $optionsmenu){
                        return  $optionsmenu->getMessage();
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
            try{
		        $this->deleteivrmenus($id);
                $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_ivrs WHERE id = ?");
                $result->bindParam(1, $data['id'], PDO::PARAM_INT);
                $_SESSION['flash']['message'] = 'deleted';                
                return $result->execute();
            }catch (Exception $e){
                $_SESSION['flash']['message'] = 'errorDelete';
                $_SESSION['flash']['detail'] = $e->getMessage();
                return $e->getMessage();
            }
        }

	    public function deleteivrmenus($idivr)
    	{
        	try {
            		$result = parent::connect()->prepare(' delete   from ' . PREFIX . '_ivrmenus  where  idIvr=?');
            		$result->bindParam(1, $idivr, PDO::PARAM_STR);
            		return $result->execute();

        	} catch (Exception $e) {
            		return $e->getMessage();
        	}

    	}

        public function find($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_ivrs WHERE id = ?");
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
            $directDial = $data['directDial'];
            $timeout = $data['timeout'];
            $recording = $data['recording'];
            $option1 = $data['option1'];        
            $option2 = $data['option2'];        
            $option3 = $data['option3'];        
            $option4 = $data['option4'];            
            $option5 = $data['option5'];        
            $option6 = $data['option6'];        
            $option7 = $data['option7'];        
            $option8 = $data['option8'];    
            $option9 = $data['option9'];        
            $option10 = $data['option10'];        
            $option11 = $data['option11'];        
            $option12 = $data['option12'];
            $destination1 = $data['destination1'];
            $destination2 = $data['destination2'];
            $destination3 = $data['destination3'];
            $destination4 = $data['destination4'];
            $destination5 = $data['destination5'];
            $destination6 = $data['destination6'];
            $destination7 = $data['destination7'];
            $destination8 = $data['destination8'];
            $destination9 = $data['destination9'];
            $destination10 = $data['destination10'];
            $destination11 = $data['destination11'];
            $destination12 = $data['destination12'];
            try{
                $bd = parent::connect();    
                $result = parent::connect()->prepare("UPDATE ".PREFIX."_ivrs SET name = ?, description = ?, number = ?, directDial = ?, timeout = ?, recording = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->bindParam(2, $description, PDO::PARAM_STR);
                $result->bindParam(3, $number, PDO::PARAM_STR);
                $result->bindParam(4, $directDial, PDO::PARAM_STR);
                $result->bindParam(5, $timeout, PDO::PARAM_STR);
                $result->bindParam(6, $recording, PDO::PARAM_STR);
                $result->bindParam(7, $_SESSION['user']->email, PDO::PARAM_STR);
                $result->bindParam(8, $id, PDO::PARAM_INT);
                try {
                //modificar tabla ivrmenus con la opciones del ivrs
                    $band = 1;
                    $regupdate = 12;
                    $options = 0;
                    $destinations = '';
                    while ($band <= $regupdate) {
                        if ($band == 1){
                            $options = $option1;
                            $destinations = $destination1;
                        }
                        if ($band == 2){
                            $options = $option2;
                            $destinations = $destination2;
                        }
                        if ($band == 3){
                            $options = $option3;
                            $destinations = $destination3;
                        }
                        if ($band == 4){
                            $options = $option4;
                            $destinations = $destination4;
                        }
                        if ($band == 5){
                            $options = $option5;
                            $destinations = $destination5;
                        }
                        if ($band == 6){
                            $options = $option6;
                            $destinations = $destination6;
                        }
                        if ($band == 7){
                            $options = $option7;
                            $destinations = $destination7;
                        }
                        if ($band == 8){
                            $options = $option8;
                            $destinations = $destination8;
                        }
                        if ($band == 9){
                            $options = $option9;
                            $destinations = $destination9;
                        }
                        if ($band == 10){
                            $options = $option10;
                            $destinations = $destination10;
                        }
                        if ($band == 11){
                            $options = $option11;
                            $destinations = $destination11;
                        }
                        if ($band == 12){
                            $options = $option12;
                            $destinations = $destination12;
                        }

                        $optionsmenu = $bd->prepare('UPDATE '.PREFIX .'_ivrmenus SET dest = ?, idDest = ?, userUpdate = ?, dateUpdate = NOW() WHERE option = ? and idIvr = ?');
                        $optionsmenu->bindParam(1, $options , PDO::PARAM_STR);
                        $optionsmenu->bindParam(2, $destinations , PDO::PARAM_STR);
                        $optionsmenu->bindParam(3, $_SESSION['user']->email, PDO::PARAM_STR); 
                        $optionsmenu->bindParam(4, $band , PDO::PARAM_STR);
                        $optionsmenu->bindParam(5, $id , PDO::PARAM_STR);
                        $optionsmenu->execute();
                        $band++;
                    }
                }catch (Exception  $optionsmenu){
                    return  $optionsmenu->getMessage();
                }
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
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_ivrs WHERE name like ? ");            
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function findByAnyDelete($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_ivrs WHERE id = ? ");            
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function findByAnyMenu($id){                
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_ivrmenus WHERE idIvr = ? ");
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                return $result->fetchAll();
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
                
    }
?>
       