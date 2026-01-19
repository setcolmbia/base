<?php

class queues extends Database
{

    public function all()
    {
        try {
            $result = parent::connect()->prepare('select name,number,weight,twait,timeout,wrapuptime,announce,client_announce,ivr,strategy,members,id   from ' . PREFIX . '_queues');
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function register($data)
    {  
        try {
            $result = parent::connect()->prepare('insert into ' . PREFIX . '_queues (name,number,weight,twait,timeout,wrapuptime,announce,client_announce,ivr,strategy,members) values(?,?,?,?,?,?,?,?,?,?,?) ');
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['number'], PDO::PARAM_STR);
            $result->bindParam(3, $data['weight'], PDO::PARAM_STR);
            $result->bindParam(4, $data['twait'], PDO::PARAM_STR);
            $result->bindParam(5, $data['timeout'], PDO::PARAM_STR);
            $result->bindParam(6, $data['wrapuptime'], PDO::PARAM_STR);
            $result->bindParam(7, $data['announce'], PDO::PARAM_STR);
            $result->bindParam(8, $data['client_announce'], PDO::PARAM_STR);
            $result->bindParam(9, $data['ivr'], PDO::PARAM_STR);
            $result->bindParam(10, $data['strategy'], PDO::PARAM_STR);
            $result->bindParam(11, $data['members'], PDO::PARAM_STR);
            return $result->execute();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function delete($data)
    {
        try {
            $result = parent::connect()->prepare('delete from ' . PREFIX . '_queues  where id=?');
            $result->bindParam(1, $data['id'], PDO::PARAM_STR);
            return $result->execute();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function showedit($id)
    {
        try {
            $result = parent::connect()->prepare('select name,number,weight,twait,timeout,wrapuptime,announce,client_announce,ivr,strategy,members,id from ' . PREFIX . '_queues  where id=? ');
            $result->bindParam(1, $id, PDO::PARAM_STR);
            $result->execute();
            return $result->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($data)
    {
        try {
            $result = parent::connect()->prepare('update ' . PREFIX . '_queues set name=?, number=?,weight=?,twait=?,timeout=?,wrapuptime=?,announce=?,client_announce=?,ivr=?,strategy=?,members=?  where id=? ');
            $result->bindParam(1, $data['name'], PDO::PARAM_STR);
            $result->bindParam(2, $data['number'], PDO::PARAM_STR);
            $result->bindParam(3, $data['weight'], PDO::PARAM_STR);
            $result->bindParam(4, $data['twait'], PDO::PARAM_STR);
            $result->bindParam(5, $data['timeout'], PDO::PARAM_STR);
            $result->bindParam(6, $data['wrapuptime'], PDO::PARAM_STR);
            $result->bindParam(7, $data['announce'], PDO::PARAM_STR);
            $result->bindParam(8, $data['client_announce'], PDO::PARAM_STR);
            $result->bindParam(9, $data['ivr'], PDO::PARAM_STR);
            $result->bindParam(10, $data['strategy'], PDO::PARAM_STR);
            $result->bindParam(11, $data['members'], PDO::PARAM_STR);
            $result->bindParam(12, $data['id'], PDO::PARAM_STR);

            return $result->execute();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }


    public   function   announce(){

        try {
            $result = parent::connect()->prepare('select  route name   from ' . PREFIX . '_recordings');
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }
    public  function client_announce(){

        try {
            $result = parent::connect()->prepare('select route,name   from ' . PREFIX . '_recordings');
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
   public  function   ivr(){

    try {
        $result = parent::connect()->prepare('select name  from ' . PREFIX . '_ivrs');
        $result->execute();
        return $result->fetchAll();
    } catch (Exception $e) {
        return $e->getMessage();
    }
   }

}
