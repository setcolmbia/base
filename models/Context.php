<?php
//Herencia
class Context extends Database{

    public function all(){
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_contexts");
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function save($data){
        try{
            $result = parent::connect()->prepare("INSERT INTO ".PREFIX."_contexts (context, userCreate, dateCreate) VALUES (?,?,NOW())");
            $result->bindParam(1, $data['context'], PDO::PARAM_STR);
            $result->bindParam(2, $_SESSION['user']->email, PDO::PARAM_STR);
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
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_contexts WHERE id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function updateR($data){
        try{
            $result = parent::connect()->prepare("UPDATE ".PREFIX."_contexts SET context = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
            $result->bindParam(1, $data['context'], PDO::PARAM_STR);
            $result->bindParam(2, $_SESSION['user']->email, PDO::PARAM_STR);
            $result->bindParam(3, $data['id'], PDO::PARAM_INT);
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
            $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_contexts WHERE id = ?");
            $result->bindParam(1, $data['id'], PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'deleted';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorDelete';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }
}