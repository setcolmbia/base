<?php 
          
         class recordings extends Database{  
         
         
        public function all(){
            try {
                $result = parent::connect()->prepare('select name,route,webroute,id   from '.PREFIX .'_recordings');
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
           } 
        public function register($data,$files){
           

             $dir = $_SERVER["DOCUMENT_ROOT"].'/var/audio/';
              

             $split_name_file = explode('.', basename($files['file']['name']));
            
             $extention = end($split_name_file);
             $name = $data['name'].'.'. $extention;
             $file_dir = $dir . $name; 
            
     
             $temp_file = $files['file']['tmp_name'];
     
             $resultupload = move_uploaded_file($temp_file, $file_dir);
           
            try {
                $webroute="/var/audio/".$name;
                $route="/var/audio/".$split_name_file[0];
                $result = parent::connect()->prepare('insert into '.PREFIX .'_recordings (name,route,webroute) values(?,?,?) '  );
                $result->bindParam(1,$data['name'] , PDO::PARAM_STR);
                $result->bindParam(2, $route , PDO::PARAM_STR);
                $result->bindParam(3,$webroute , PDO::PARAM_STR);
                return $result->execute();
              
            } catch (Exception  $e) {
                return  $e->getMessage();
            }
           }
           public function delete($data){
            try {
                $result = parent::connect()->prepare('delete from '.PREFIX .'_recordings  where id=?' );
                $result->bindParam(1,$data['id'] , PDO::PARAM_STR);
                return $result->execute();
              
            } catch (Exception $e) {
                return $e->getMessage();
            }
           } 
           public function showedit($data){
            try {
                $result = parent::connect()->prepare('select name,route,webroute,id from '.PREFIX .' _recordings  where id=? ');
                $result->bindParam(1,$data['id'] , PDO::PARAM_STR);
                $result->execute();
                return $result->fetch();
            } catch (Exception $e) {
                return $e->getMessage();
            }
           } 

          public  function update($data){
            try {
                $result = parent::connect()->prepare('update '.PREFIX .' _recordings set route=?,webroute=?  where id=? ');
                $result->bindParam(1,$data['route'] , PDO::PARAM_STR);
                $result->bindParam(2,$data['webroute'] , PDO::PARAM_STR);
                $result->bindParam(3,$data['id'] , PDO::PARAM_STR);
                
                return $result->execute();
                
            } catch (Exception $e) {
                return $e->getMessage();
            }

          } 

  
       }
       ?>
       