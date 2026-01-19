<?php

class sipController extends Sip{
    /**
     * Función que se ejecuta siempre que se crea un objeto.
     * Se puede usar para la seguridad de un controlador.
     */
    public function __construct()
    {
        Security::verifyUser();
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
        $method = isset($_GET['method']) ? $_GET['method'] : 'index';
        Security::logEvent($controller,$method);
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
        require_once 'views/sip/index.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar la vista del formulario
    public function create(){
        $contexts = Context::all();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/sip/create.php';
        require_once 'views/layouts/footer.php';
    }

    // Validaciones e interaccion model
    public function store(){
        if(parent::save($_POST)){
            if(telephonyController::generateSip()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=sip');
                }else{
                    die('Error al recargar');
                }
            }else{
                die('Error al generar archivo');
            }
        }else{
            die('Error en el store');            
        }
    }

    //Consultar y luego mostrar la informacion en el formulario
    public function edit(){
        $sip = parent::find($_GET['id']);
        $contexts = Context::all();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/sip/edit.php';
        require_once 'views/layouts/footer.php';
    }
    
    public function editPassword(){
        $sip = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/sip/editPass.php';
        require_once 'views/layouts/footer.php';
    }
    
    // Validaciones e interaccion model
    public function updatePassword(){
        $sip = parent::find($_POST['id']);
        if($_POST['passwordOld']!=$_POST['passwordOld2']){
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = "Las contraseñas anteriores no coinciden. Intente nuevamente.";
            header('location: ?controller=sip&method=editPassword&id='.$_POST['id']);
        }if($_POST['password']!=$_POST['password2']){
            $_SESSION['flash']['message'] = 'errorUpdate';
            $_SESSION['flash']['detail'] = "Las contraseñas nuevas no coinciden. Intente nuevamente.";
            header('location: ?controller=sip&method=editPassword&id='.$_POST['id']);
        }else{
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if(password_verify($_POST['passwordOld'], $sip->password)){
                echo parent::update_password($_POST) ? header('location: ?controller=sip&method=editPassword&id='.$_POST['id']) : 'Error en el Update';
            }else{
                $_SESSION['flash']['message'] = 'errorUpdate';
                $_SESSION['flash']['detail'] = "Contraseña anterior errada. Intente nuevamente.";
                header('location: ?controller=sip&method=editPassword&id='.$_POST['id']);
            }
        }
    }
    
    //Validaciones e interaccion model
    public function update(){
        $_POST['id'] = $_GET['id'];
        if(parent::updateR($_POST)){
            if(telephonyController::generateSip()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=sip');
                }else{
                    die('Error al recargar');
                }
            }else{
                die('Error al generar archivo');
            }
        }else{
            die('Error al actualizar');            
        }
    }

    //Elimina registro
    public function delete(){
        var_dump(parent::deleteR($_GET));
        echo parent::deleteR($_GET) ? header('location: ?controller=sip') : 'Error en el delete';
    }

    //Recarga Configuración
    public function reload(){
        if(telephonyController::generateSip()){
            $command = "reload";
            if(Telephony::command($command)){
                $_SESSION['flash']['message'] = 'reloaded';
                header('location:?controller=sip');
            }else{
                die('Error al recargar');
            }
        }else{
            die('Error al generar archivo');
        }
    }
}