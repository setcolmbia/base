<?php

class securityController extends Security {

    public function login(){
        $user = parent::validateLogin($_POST['email']);

        if(!is_object($user)) {
            $_SESSION['flash']['message'] = 'Correo o usuario incorrecto.';
            return header('location:?method=login');
        }

       if(password_verify($_POST['password'], $user->password)){
           $_SESSION['user'] = $user;
           $_SESSION['exten'] = $_POST['exten'];
           $userMenu = parent::validateMenu($user->role);
           $_SESSION['userMenu'] = $userMenu;
           return header('location:?controller=index');
       }

        $_SESSION['flash']['message'] = 'Contraseña incorrecta.';
        return header('location:?method=login');
    }

    public function logout(){
        unset($_SESSION['user']);
        session_destroy();
        header('location:?method=login');
    }

}