<?php
//Herencia
class Contact extends Database{

    public function all(){
        try{
            $result = parent::connect()->prepare("SELECT * FROM ".PREFIX."_contacts");
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function countAll(){
        try{
            $query = "SELECT count(id) as cantidad FROM ".PREFIX."_contacts";
            $result = parent::connect()->prepare($query);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function save($data){
        try{
            $result = parent::connect()->prepare("INSERT INTO ".PREFIX."_contacts (firstName, lastName, fullName, identificationNumber, checkDigit, identificationType, country, state, city, address, address2, email, phone, phone2, observations, userCreate, dateCreate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())");
            $result->bindParam(1, $data['firstName'], PDO::PARAM_STR);
            $result->bindParam(2, $data['lastName'], PDO::PARAM_STR);
            $result->bindParam(3, $data['fullName'], PDO::PARAM_STR);
            $result->bindParam(4, $data['identificationNumber'], PDO::PARAM_STR);
            $result->bindParam(5, $data['checkDigit'], PDO::PARAM_STR);
            $result->bindParam(6, $data['identificationType'], PDO::PARAM_STR);
            $result->bindParam(7, $data['country'], PDO::PARAM_STR);
            $result->bindParam(8, $data['state'], PDO::PARAM_STR);
            $result->bindParam(9, $data['city'], PDO::PARAM_STR);
            $result->bindParam(10, $data['address'], PDO::PARAM_STR);
            $result->bindParam(11, $data['address2'], PDO::PARAM_STR);
            $result->bindParam(12, $data['email'], PDO::PARAM_STR);
            $result->bindParam(13, $data['phone'], PDO::PARAM_STR);
            $result->bindParam(14, $data['phone2'], PDO::PARAM_STR);
            $result->bindParam(15, $data['observations'], PDO::PARAM_STR);
            $result->bindParam(16, $_SESSION['user']->email, PDO::PARAM_STR);
            $_SESSION['flash']['message'] = 'created';
            return $result->execute();
        }catch (Exception $e){
            $_SESSION['flash']['message'] = 'errorCreate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
            //die("Error Client->register() " . $e->getMessage());
        }
    }

    public function find($id){
        try{
            $result = parent::connect()->prepare("SELECT CLI.*, CIU.countryCode, CIU.cityCode, CIU.stateCode, CIU.cityName, CIU.stateName FROM ".PREFIX."_contacts CLI JOIN ".PREFIX."_cities CIU ON CLI.city=CIU.cityCode WHERE CLI.id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function findByCC($identification){
        try{
            $result = parent::connect()->prepare("SELECT CLI.*, CIU.countryCode, CIU.cityCode, CIU.stateCode, CIU.cityName, CIU.stateName FROM ".PREFIX."_contacts CLI JOIN ".PREFIX."_cities CIU ON CLI.city=CIU.cityCode WHERE CLI.identificationNumber = ?");
            $result->bindParam(1, $identification, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    
    public function findByName($name){
        $names = array_map('trim', explode(" ", $name, 2));
        $firstName = "%".$names[0]."%";
        $lastName = "%".$names[1]."%";
        $fullName = "%".$names[0]."%";
        $query = "SELECT CLI.*, CIU.countryCode, CIU.cityCode, CIU.stateCode, CIU.cityName, CIU.stateName FROM ".PREFIX."_contacts CLI JOIN ".PREFIX."_cities CIU ON CLI.city=CIU.cityCode WHERE ((CLI.firstName like ? AND CLI.lastName like ?) OR CLI.fullName like ?) AND CLI.country=CIU.countryCode";
        //echo $query;
        try{
            $result = parent::connect()->prepare($query);
            $result->bindParam(1, $firstName, PDO::PARAM_STR);
            $result->bindParam(2, $lastName, PDO::PARAM_STR);
            $result->bindParam(3, $fullName, PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function findStateByCountry($pais){
        try{
            $result = parent::connect()->prepare("SELECT stateCode,stateName FROM ".PREFIX."_cities WHERE countryCode = ? group by stateCode order by stateName ASC");
            $result->bindParam(1, $pais, PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function findCityByState($departamento,$pais){
        try{
            $result = parent::connect()->prepare("SELECT cityCode,cityName FROM ".PREFIX."_cities WHERE stateCode = ? AND countryCode = ? order by cityName ASC");
            $result->bindParam(1, $departamento, PDO::PARAM_STR);
            $result->bindParam(2, $pais, PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function updateR($data){
        try{
            $result = parent::connect()->prepare("UPDATE ".PREFIX."_contacts SET firstName = ?, lastName = ?, fullName = ?, identificationNumber = ?, checkDigit = ?, identificationType = ?, country = ?, state = ?, city = ?, address = ?, address2 = ?, email = ?, phone = ?, phone2 = ?, observations = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
            $result->bindParam(1, $data['firstName'], PDO::PARAM_STR);
            $result->bindParam(2, $data['lastName'], PDO::PARAM_STR);
            $result->bindParam(3, $data['fullName'], PDO::PARAM_STR);
            $result->bindParam(4, $data['identificationNumber'], PDO::PARAM_STR);
            $result->bindParam(5, $data['checkDigit'], PDO::PARAM_STR);
            $result->bindParam(6, $data['identificationType'], PDO::PARAM_STR);
            $result->bindParam(7, $data['country'], PDO::PARAM_STR);
            $result->bindParam(8, $data['state'], PDO::PARAM_STR);
            $result->bindParam(9, $data['city'], PDO::PARAM_STR);
            $result->bindParam(10, $data['address'], PDO::PARAM_STR);
            $result->bindParam(11, $data['address2'], PDO::PARAM_STR);
            $result->bindParam(12, $data['email'], PDO::PARAM_STR);
            $result->bindParam(13, $data['phone'], PDO::PARAM_STR);
            $result->bindParam(14, $data['phone2'], PDO::PARAM_STR);
            $result->bindParam(15, $data['observations'], PDO::PARAM_STR);
            $result->bindParam(16, $_SESSION['user']->email, PDO::PARAM_STR);
            $result->bindParam(17, $data['id'], PDO::PARAM_INT);
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
            $result = parent::connect()->prepare("DELETE FROM ".PREFIX."_contacts WHERE id = ?");
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
