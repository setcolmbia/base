<?php

class iaxController extends Iax{
    /**
     * Función que se ejecuta siempre que se crea un objeto.
     * Se puede usar para la seguridad de un controlador.
     */
    public function __construct()
    {
        Security::verifyUser();
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
        $method = isset($_GET['method']) ? $_GET['method'] : 'index';
        $allowed=Security::verifyRole($controller,$method);
        if(!$allowed){
            require_once 'views/errors/403.html';
            exit();
        }
    }


    //Mostrar toda la informacion
    public function index(){                
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/iax/index.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar la vista del formulario
    public function create(){
        $contexts = Context::all();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/iax/create.php';
        require_once 'views/layouts/footer.php';
    }

    // Validaciones e interaccion model
    public function store(){
        echo parent::save($_POST) ? header('location: ?controller=iax') : 'Error en el store';
    }

    //Consultar y luego mostrar la informacion en el formulario
    public function edit(){
        $iax = parent::find($_GET['id']);
        $contexts = Context::all();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/iax/edit.php';
        require_once 'views/layouts/footer.php';
    }
    
    public function editPassword(){
        $iax = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/iax/editPass.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Validaciones e interaccion model
    public function updatePassword(){
        $iax = parent::find($_POST['id']);
        if($_POST['passwordOld']!=$_POST['passwordOld2']){
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = "Las contraseñas anteriores no coinciden. Intente nuevamente.";
            header('location: ?controller=iax&method=editPassword&id='.$_POST['id']);
        }if($_POST['password']!=$_POST['password2']){
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = "Las contraseñas nuevas no coinciden. Intente nuevamente.";
            header('location: ?controller=iax&method=editPassword&id='.$_POST['id']);
        }else{
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if(password_verify($_POST['passwordOld'], $iax->password)){
                echo parent::update_password($_POST) ? header('location: ?controller=iax&method=editPassword&id='.$_POST['id']) : 'Error en el Update';
            }else{
                $_SESSION['flash']['message'] = 'errorUpdate';
                $_SESSION['flash']['detail'] = "Contraseña anterior errada. Intente nuevamente.";
                header('location: ?controller=iax&method=editPassword&id='.$_POST['id']);
            }
        }
    }
    
    //Validaciones e interaccion model
    public function update(){
        $_POST['id'] = $_GET['id'];
        if(parent::updateR($_POST)){
            header('location:?controller=iax');
        }else{
            die('Error al actualizar');
        }
    }


    //
    public function delete(){
        var_dump(parent::deleteR($_GET));
        echo parent::deleteR($_GET) ? header('location: ?controller=iax') : 'Error en el delete';
    }
}