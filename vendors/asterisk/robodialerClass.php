<?php

/* 
 * Clases para el Robodialer
 */

class Robodialer extends Database{ 

    public function all(){
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
    
    public function findLeads($campaign, $limit, $filtroD, $filtroA){
        $dispo = 1;
            try {
                $result = parent::connect()->prepare('SELECT id,idExtra,name,phone FROM '.PREFIX.'_AUT_'.$campaign.' WHERE ((disposition = ?) OR (disposition IN (?) AND attempts <= ?)) ORDER BY disposition = ? desc, id asc LIMIT 0,'.$limit);
                $result->bindParam(1, $dispo, PDO::PARAM_INT);
                $result->bindParam(2, $filtroD, PDO::PARAM_STR);
                $result->bindParam(3, $filtroA, PDO::PARAM_STR);
                $result->bindParam(4, $dispo, PDO::PARAM_INT);
                $result->execute();
                return  $result->fetchAll();
            } catch (Exception $e) {
                return $e->getMessage();
            }
    }
    
    public function updateDispo($campaign, $dispo, $id){
        try{
            $result = parent::connect()->prepare('UPDATE '.PREFIX.'_AUT_'.$campaign.' SET attempts = attempts + 1, disposition = ? WHERE id = ?');
            $result->bindParam(1, $dispo, PDO::PARAM_STR);
            $result->bindParam(2, $id, PDO::PARAM_INT);
            return $result->execute();
        }catch (Exception $e){
            echo 'ERROR: '.$e->getMessage().'\n';
            return $e->getMessage();                
        }
    }
    
    public function updateLastCall($campaign, $time){
        try{
            $result = parent::connect()->prepare('UPDATE '.PREFIX.'_campaigns SET lastCall = ? WHERE name = ?');
            $result->bindParam(1, $time, PDO::PARAM_STR);
            $result->bindParam(2, $campaign, PDO::PARAM_STR);
            return $result->execute();
        }catch (Exception $e){
            echo 'ERROR: '.$e->getMessage().'\n';
            return $e->getMessage();                
        }
    }
    
    public function getRoute($id){
        $active = '1';
        try {
            $result = parent::connect()->prepare('SELECT * FROM ' . PREFIX . '_outboundroutes WHERE active = ? and id = ?');
            $result->bindParam(1, $active, PDO::PARAM_STR);
            $result->bindParam(2, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}