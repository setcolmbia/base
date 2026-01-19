<?php
//Herencia
class Iax extends Database{

    public function all(){
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_iax");
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function save($data){
        $mailbox = $data['name'] . '@default';
        try{
            $result = parent::connect()->prepare("INSERT INTO ".PREFIX."_iax (name, accountcode, call_limit, cid_number, context, fullname, mailbox, secret, username, allow, active, userCreate, dateCreate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['context'], PDO::PARAM_STR);
            $result->bindParam(3, $data['call_limit'], PDO::PARAM_STR);
            $result->bindParam(4, $data['name'], PDO::PARAM_STR);
            $result->bindParam(5, $data['context'], PDO::PARAM_STR);
            $result->bindParam(6, $data['fullname'], PDO::PARAM_STR);
            $result->bindParam(7, $mailbox, PDO::PARAM_STR);
            $result->bindParam(8, $data['secret'], PDO::PARAM_STR);
            $result->bindParam(9, $data['name'], PDO::PARAM_STR);
            $result->bindParam(10, $data['allow'], PDO::PARAM_STR);
            $result->bindParam(11, $data['active'], PDO::PARAM_STR);
            $result->bindParam(12, $_SESSION['user']->email, PDO::PARAM_STR);
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
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_iax WHERE id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function updateR($data){
        $mailbox = $data['name'] . '@default';
        //error_log($_SESSION['user']->email);
        try{
            $result = parent::connect()->prepare("UPDATE ".PREFIX."_iax SET name=?, accountcode=?, call_limit=?, cid_number=?, context=?, fullname=?, mailbox=?, secret=?, username=?, allow=?, active=?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['context'], PDO::PARAM_STR);
            $result->bindParam(3, $data['call_limit'], PDO::PARAM_STR);
            $result->bindParam(4, $data['name'], PDO::PARAM_STR);
            $result->bindParam(5, $data['context'], PDO::PARAM_STR);
            $result->bindParam(6, $data['fullname'], PDO::PARAM_STR);
            $result->bindParam(7, $mailbox, PDO::PARAM_STR);
            $result->bindParam(8, $data['secret'], PDO::PARAM_STR);
            $result->bindParam(9, $data['name'], PDO::PARAM_STR);
            $result->bindParam(10, $data['allow'], PDO::PARAM_STR);
            $result->bindParam(11, $data['active'], PDO::PARAM_STR);
            $result->bindParam(12, $_SESSION['user']->email, PDO::PARAM_STR);
            $result->bindParam(13, $data['id'], PDO::PARAM_INT);
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
            $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_iax WHERE id = ?");
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