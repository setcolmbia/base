<?php 
          
         class shortcodes extends Database{  
         
         
        public function all(){
            try {
                $result = parent::connect()->prepare('select name,code,dest,id   from '.PREFIX .'_shortcodes');
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
           } 
        public function register($data){
            try {
                $result = parent::connect()->prepare('insert into '.PREFIX .'_shortcodes (name,code,dest) values(?,?,?) '  );
                $result->bindParam(1,$data['name'] , PDO::PARAM_STR);
                $result->bindParam(2,$data['code'] , PDO::PARAM_STR);
                $result->bindParam(3,$data['dest'] , PDO::PARAM_STR);
                return $result->execute();
              
            } catch (Exception  $e) {
                return  $e->getMessage();
            }
           }
           public function delete($data){
            try {
                
                $result = parent::connect()->prepare('delete from '.PREFIX .'_shortcodes  where id=?' );
                $result->bindParam(1,$data['id'] , PDO::PARAM_STR);
                return $result->execute();
              
            } catch (Exception $e) {
                return $e->getMessage();
            }
           } 
           public function showedit($data){
            try {
                $result = parent::connect()->prepare('select name,code,dest,id from '.PREFIX .'_shortcodes  where id=? ');
                $result->bindParam(1,$data['id'] , PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            } catch (Exception $e) {
                return $e->getMessage();
            }
           } 

          public  function update($data){
            try {
                //print_r($data);
                $result = parent::connect()->prepare('update '.PREFIX .'_shortcodes set name=?, code=?,dest=?  where id=? ');
                $result->bindParam(1,$data['name'] , PDO::PARAM_STR);
                $result->bindParam(2,$data['code'] , PDO::PARAM_STR);
                $result->bindParam(3,$data['dest'] , PDO::PARAM_STR);
                $result->bindParam(4,$data['id'] , PDO::PARAM_STR);
                
                return $result->execute();
                
            } catch (Exception $e) {
                return $e->getMessage();
            }

          } 


       }
       ?>
       