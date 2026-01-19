<?php

class Recordings extends Database {

    public function all() {
        try {
            $result = parent::connect()->prepare('SELECT name,route,webroute,id FROM ' . PREFIX . '_recordings');
            $result->execute();
            return $result->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function register($data) {

        $name = $data['name'];
        $ruta = "/var/audios/" . $name . ".wav";
        $rutaWeb = "audios/" . $name . ".wav";
        if ($_FILES['file']['error'] == 0 && ($_FILES['file']['type'] == 'audio/x-gsm' || $_FILES['file']['type'] == 'audio/x-wav' || $_FILES['file']['type'] == 'audio/wav')) {
            $error = 0;
        } else {
            $error = 1;
        }
        try {
            if ($error == 0) {
                $result = parent::connect()->prepare('INSERT INTO ' . PREFIX . '_recordings (name,route,webroute,userCreate,dateCreate) VALUES(?,?,?,?,NOW()) ');
                $result->bindParam(1, $data['name'], PDO::PARAM_STR);
                $result->bindParam(2, $ruta, PDO::PARAM_STR);
                $result->bindParam(3, $rutaWeb, PDO::PARAM_STR);
                $result->bindParam(4, $_SESSION['user']->email, PDO::PARAM_STR);
                move_uploaded_file($_FILES['file']['tmp_name'], $ruta);
                $permisos = "chmod 777 " . $ruta;
                system($permisos);
                $_SESSION['flash']['message'] = 'created';
                return $result->execute();
            }
        } catch (Exception $e) {
            if ($error == 1) {
                return $e->getMessage() . ' - ' . $msgerror;
                $_SESSION['flash']['message'] = 'errorCreate';
                $_SESSION['flash']['detail'] = $e->getMessage();
            }
            $_SESSION['flash']['message'] = 'errorCreate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }

    public function delete_register($data) {
        $id = $data['id'];
        $dato = $this->findByAnyDelete($id);
        try {
            if ($dato) {
                if (file_exists("/var/audios/" . $dato->name . ".wav")) {
                    unlink("/var/audios/" . $dato->name . ".wav");
                }
            }
            $result = parent::connect()->prepare("DELETE FROM " . PREFIX . "_recordings WHERE id = ?");
            $result->bindParam(1, $data['id'], PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'deleted';
            return $result->execute();
        } catch (Exception $e) {
            $_SESSION['flash']['message'] = 'errorDelete';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }

    public function find($id) {
        try {
            $result = parent::connect()->prepare("SELECT * FROM " . PREFIX . "_recordings WHERE id = ?");
            $result->bindParam(1, $id, PDO::PARAM_INT);
            $result->execute();
            return $result->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function update_register($data) {
        $id = $data['id'];
        $name = $data['name'];
        $ruta = "/var/audios/" . $name . ".wav";
        $rutaWeb = "audios/" . $name . ".wav";
        try {
            $result = parent::connect()->prepare("UPDATE " . PREFIX . "_recordings SET name = ?, route = ?, webroute = ?, userUpdate = ?, dateUpdate = NOW() WHERE id = ?");
            $result->bindParam(1, $name, PDO::PARAM_STR);
            $result->bindParam(2, $ruta, PDO::PARAM_STR);
            $result->bindParam(3, $rutaWeb, PDO::PARAM_STR);
            $result->bindParam(4, $_SESSION['user']->email, PDO::PARAM_STR);
            $result->bindParam(5, $id, PDO::PARAM_INT);
            $_SESSION['flash']['message'] = 'updated';
            return $result->execute();
        } catch (Exception $e) {
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = $e->getMessage();
            return $e->getMessage();
        }
    }

    public function findByAny($name) {
        $name = "%" . $name . "%";
        try {
            $result = parent::connect()->prepare("SELECT * FROM " . PREFIX . "_recordings WHERE name like ? ");
            $result->bindParam(1, $name, PDO::PARAM_STR);
            $result->execute();

            return $result->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function findByAnyDelete($id) {
        try {
            $result = parent::connect()->prepare("SELECT * FROM " . PREFIX . "_recordings WHERE id = ? ");
            $result->bindParam(1, $id, PDO::PARAM_STR);
            $result->execute();

            return $result->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

?>