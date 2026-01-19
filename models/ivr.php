<?php
class ivr extends Database
{

    public function all()
    {
        try {
            $result = parent::connect()->prepare(' select id, name, description, number, directDial, timeout, recording  from ' . PREFIX . '_ivrs');
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function recording()
    {

        try {

            $result = parent::connect()->prepare('select route  from ' . PREFIX . '_recordings');
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function register($data)
    {

        $name = $data['nombre'];
        $descripccion = $data['descripcion'];
        $number = $data['numero'];

        if (isset($data['directDial']) && $data['directDial'] == "SI") {
            $direcDial = "SI";
        } else {
            $direcDial = "NO";
        }

        $timeout = $data['timeout'];
        $recording = $data['recording'];
/*datos para  la tabla  crm_ivrmenus  */
        $dest = $data['dest'];
        $idDest = $data['idDest'];
        $opciones = $data['opciones'];

/* crm_ivrmenus*/
        try {
            $bd = parent::connect();
            $result = $bd->prepare('insert into ' . PREFIX . '_ivrs (name, description, number, directDial, timeout, recording) values(?,?,?,?,?,?)');
            $result->bindParam(1, $name, PDO::PARAM_STR);
            $result->bindParam(2, $descripccion, PDO::PARAM_STR);
            $result->bindParam(3, $number, PDO::PARAM_STR);
            $result->bindParam(4, $direcDial, PDO::PARAM_STR);
            $result->bindParam(5, $timeout, PDO::PARAM_STR);
            $result->bindParam(6, $recording, PDO::PARAM_STR);
            $result->execute();
            $ivrid = $bd->lastInsertId();
            $this->resgisterivrmenus($ivrid, $dest, $idDest, $opciones);
            return 1;
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function resgisterivrmenus($idivr, $dest, $idDest, $opciones)
    {

        for ($i = 0; $i < count($dest); $i++) {
            if (!empty($dest[$i])) {

                try {
                    $bd = parent::connect();
                    $result = $bd->prepare('insert into ' . PREFIX . '_ivrmenus (idIvr,dest,idDest,option) values(?,?,?,?)');
                    $result->bindParam(1, $idivr, PDO::PARAM_STR);
                    $result->bindParam(2, $dest[$i], PDO::PARAM_STR);
                    $result->bindParam(3, $idDest[$i], PDO::PARAM_STR);
                    $result->bindParam(4, $opciones[$i], PDO::PARAM_STR);
                    $result->execute();

                } catch (Exception $e) {
                    return $e->getMessage();
                }

            }
        }

    }

    public function showedit($id)
    {
        try {
            $result = parent::connect()->prepare(' select id, name, description, number, directDial, timeout, recording  from ' . PREFIX . '_ivrs  where  id=?');
            $result->bindParam(1, $id, PDO::PARAM_STR);
            $result->execute();
            return $result->fetch();
        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

    public function deleteivr($id)
    {
        try {
            $this->deleteivrmenus($id);
            $result = parent::connect()->prepare(' delete   from ' . PREFIX . '_ivrs  where  id=?');
            $result->bindParam(1, $id, PDO::PARAM_STR);
            $result->execute();
            return 1;
        } catch (Exception $e) {
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
    public function update($data)
    {
        $sql = 'update ' . PREFIX . '_ivrs  set name=?,description=?, number=?,directDial=?,timeout=? ,recording=?  where id=? ';

        $name = $data['nombre'];
        $descripccion = $data['descripcion'];
        $number = $data['numero'];
        $id = $data['id'];
        if (isset($data['directDial']) && $data['directDial'] == "SI") {
            $direcDial = "SI";
        } else {
            $direcDial = "NO";
        }

        $timeout = $data['timeout'];
        $recording = $data['recording'];

        /*datos para  la tabla  crm_ivrmenus  */
        $dest = $data['dest'];
        $idDest = $data['idDest'];
        $opciones = $data['opciones'];

        if (!empty($dest)) {

            if ($this->deleteivrmenus($id)) {

                $this->resgisterivrmenus($id, $dest, $idDest, $opciones);
            }

        }
        try {
            $result = parent::connect()->prepare($sql);
            $result->bindParam(1, $name, PDO::PARAM_STR);
            $result->bindParam(2, $descripccion, PDO::PARAM_STR);
            $result->bindParam(3, $number, PDO::PARAM_STR);
            $result->bindParam(4, $direcDial, PDO::PARAM_STR);
            $result->bindParam(5, $timeout, PDO::PARAM_STR);
            $result->bindParam(6, $recording, PDO::PARAM_STR);
            $result->bindParam(7, $id, PDO::PARAM_STR);

            return $result->execute();

        } catch (Exception $e) {
            return $e->getMessage();
        }

    }

}
