<?php 
          
    class Inboundroutes extends Database{ 
         
         
        public function all(){
            try {
                $result = parent::connect()->prepare('SELECT * FROM '.PREFIX .'_inboundroutes ORDER BY id');
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }        

        public function save($data){
            $name = $data['name'];
            $did = $data['did'];
            $dest = $data['dest'];
            $idDest = $data['idDest'];
            
            try {
                $bd = parent::connect();
                $result = $bd->prepare('INSERT INTO '.PREFIX .'_inboundroutes (name,dest,idDest,did,userCreate,dateCreate) VALUES(?,?,?,?,?,NOW())');
                $result->bindParam(1, $name , PDO::PARAM_STR);
                $result->bindParam(2, $dest , PDO::PARAM_STR);
                $result->bindParam(3, $idDest , PDO::PARAM_STR);
                $result->bindParam(4, $did , PDO::PARAM_STR);
                $result->bindParam(5, $_SESSION['user']->email, PDO::PARAM_STR);
                $resultInsert = $result->execute();                
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
                $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_inboundroutes WHERE id = ?");
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
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_inboundroutes WHERE id = ?");
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
            $did = $data['did'];
            $dest = $data['dest'];
            $idDest = $data['idDest'];
            try{
                $bd = parent::connect();    
                $result = parent::connect()->prepare("UPDATE ".PREFIX."_inboundroutes SET name = ?, dest = ?, idDest = ?, did = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->bindParam(2, $dest, PDO::PARAM_STR);
                $result->bindParam(3, $idDest, PDO::PARAM_STR);
                $result->bindParam(4, $did, PDO::PARAM_STR);
                $result->bindParam(5, $_SESSION['user']->email, PDO::PARAM_STR);
                $result->bindParam(6, $id, PDO::PARAM_INT);
                
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
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_inboundroutes WHERE name like ? ");            
                $result->bindParam(1, $name, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetchAll();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function findByAnyDelete($id){        
            try{
                $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_inboundroutes WHERE id = ? ");            
                $result->bindParam(1, $id, PDO::PARAM_STR);
                $result->execute();
                
                return $result->fetch();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }      
                
    }
?>
       