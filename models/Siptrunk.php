<?php
//Herencia
class Siptrunk extends Database{

    public function all(){
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_siptrunks");
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function allActive(){
        $active = 1;
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_siptrunks WHERE active = ?");
            $result->bindParam(1, $active, PDO::PARAM_INT);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function save($data){
        try{
            $result = parent::connect()->prepare("INSERT INTO ".PREFIX."_siptrunks (name, accountcode, call_limit, cid_number, context, fullname, auth, secret, username, allow, active, host, port, insecure, fromuser, fromdomain, dtmfmode, nat, userCreate, dateCreate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['name'], PDO::PARAM_STR);
            $result->bindParam(3, $data['call_limit'], PDO::PARAM_STR);
            $result->bindParam(4, $data['cid_number'], PDO::PARAM_STR);
            $result->bindParam(5, $data['context'], PDO::PARAM_STR);
            $result->bindParam(6, $data['fullname'], PDO::PARAM_STR);
            $result->bindParam(7, $data['auth'], PDO::PARAM_STR);
            $result->bindParam(8, $data['secret'], PDO::PARAM_STR);
            $result->bindParam(9, $data['name'], PDO::PARAM_STR);
            $result->bindParam(10, $data['allow'], PDO::PARAM_STR);
            $result->bindParam(11, $data['active'], PDO::PARAM_STR);
            $result->bindParam(12, $data['host'], PDO::PARAM_STR);
            $result->bindParam(13, $data['port'], PDO::PARAM_STR);
            $result->bindParam(14, $data['insecure'], PDO::PARAM_STR);
            $result->bindParam(15, $data['fromuser'], PDO::PARAM_STR);
            $result->bindParam(16, $data['fromdomain'], PDO::PARAM_STR);
            $result->bindParam(17, $data['dtmfmode'], PDO::PARAM_STR);
            $result->bindParam(18, $data['nat'], PDO::PARAM_STR);
            $result->bindParam(19, $_SESSION['user']->email, PDO::PARAM_STR);
            $_SESSION['flash']['message'] = 'created';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorCreate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
            //die("Error User->register() " . $e->getMessage());
        }
    }

    public function find($id){
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_siptrunks WHERE id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function updateR($data){
        //error_log($_SESSION['user']->email);
        try{
            $result = parent::connect()->prepare("UPDATE ".PREFIX."_siptrunks SET name=?, accountcode=?, call_limit=?, cid_number=?, context=?, fullname=?, auth=?, secret=?, username=?, allow=?, active=?, host=?, port=?, insecure=?, fromuser=?, fromdomain=?, dtmfmode=?, nat=?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['name'], PDO::PARAM_STR);
            $result->bindParam(3, $data['call_limit'], PDO::PARAM_STR);
            $result->bindParam(4, $data['cid_number'], PDO::PARAM_STR);
            $result->bindParam(5, $data['context'], PDO::PARAM_STR);
            $result->bindParam(6, $data['fullname'], PDO::PARAM_STR);
            $result->bindParam(7, $data['auth'], PDO::PARAM_STR);
            $result->bindParam(8, $data['secret'], PDO::PARAM_STR);
            $result->bindParam(9, $data['name'], PDO::PARAM_STR);
            $result->bindParam(10, $data['allow'], PDO::PARAM_STR);
            $result->bindParam(11, $data['active'], PDO::PARAM_STR);
            $result->bindParam(12, $data['host'], PDO::PARAM_STR);
            $result->bindParam(13, $data['port'], PDO::PARAM_STR);
            $result->bindParam(14, $data['insecure'], PDO::PARAM_STR);
            $result->bindParam(15, $data['fromuser'], PDO::PARAM_STR);
            $result->bindParam(16, $data['fromdomain'], PDO::PARAM_STR);
            $result->bindParam(17, $data['dtmfmode'], PDO::PARAM_STR);
            $result->bindParam(18, $data['nat'], PDO::PARAM_STR);
            $result->bindParam(19, $_SESSION['user']->email, PDO::PARAM_STR);
            $result->bindParam(20, $data['id'], PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'updated';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }

    public function deleteR($data){
        try{
            $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_siptrunks WHERE id = ?");
            $result->bindParam(1, $data['id'], PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'deleted';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorDelete';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }
    
    public function generatePassword($length = 16) {
        $chars = "023456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!$%&?";

        $i = 0;
        $str = "";
        while ($i <= $length) {
            $str .= $chars[mt_rand(0, strlen($chars))];
            $i++;
        }
        return $str;
    }
}