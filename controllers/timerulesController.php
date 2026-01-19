<?php

class timerulesController extends Timerules{
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
  
    //Mostrar resultado de busqueda
    public function list(){
        $_POST['name'] = '%';             
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/timerules/list.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar formulario
    public function create(){
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/timerules/create.php';
        require_once 'views/layouts/footer.php';
    }

    // Validaciones e interaccion model
    public function store(){
        if(parent::save($_POST)){
	    header('location: ?controller=timerules&method=list');	
        }else{
            die('Error en el store');            
        }
    }

    //consultar y luego mostrar la informacion en el formulario
    public function edit(){        
        $timerules = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/timerules/edit.php';
        require_once 'views/layouts/footer.php';
    }

    //Validaciones e interaccion model
    public function update(){
        echo $_POST['id'] = $_GET['id'];
        if(parent::updateR($_POST)){
	    header('location:?controller=timerules&method=list');
            /*if(telephonyController::generateRobotimerules()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=timerules&method=list');
                }else{
                    die('Error al recargar');
                }
            }else{
                die('Error al generar archivo');
            }*/
        }else{
            die('Error al actualizar');            
        }
    }

    public function delete(){
        var_dump(parent::delete_register($_GET));
        echo parent::delete_register($_GET) ? header('location: ?controller=timerules&method=list') : 'Error en el delete';
    }

}