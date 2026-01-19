<?php

class agentController extends Agent{
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

    //Pantalla de Agente
    public function screen(){                
        require_once 'views/layouts/header.php';
        //require_once 'views/layouts/sidemenu.php';
        require_once 'views/agent/screen.php';
        require_once 'views/layouts/footer.php';
    }

    //Mostrar toda la informacion
    public function index(){                
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/agent/index.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar la vista del formulario
    public function create(){
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/agent/create.php';
        require_once 'views/layouts/footer.php';
    }

    // Validaciones e interaccion model
    public function store(){
        if(parent::save($_POST)){
            if(telephonyController::generateAgents()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=agent');
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

    //consultar y luego mostrar la informacion en el formulario
    public function edit(){
        $agent = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/agent/edit.php';
        require_once 'views/layouts/footer.php';
    }

    //Validaciones e interaccion model
    public function update(){
        $_POST['id'] = $_GET['id'];
        if(parent::updateR($_POST)){
            if(telephonyController::generateAgents()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=agent');
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
        echo parent::deleteR($_GET) ? header('location: ?controller=agent') : 'Error en el delete';
    }
    
    //Recarga Configuración
    public function reload(){
        if(telephonyController::generateAgents()){
            $command = "reload";
            if(Telephony::command($command)){
                $_SESSION['flash']['message'] = 'reloaded';
                header('location:?controller=agent');
            }else{
                die('Error al recargar');
            }
        }else{
            die('Error al generar archivo');
        }
    }
}