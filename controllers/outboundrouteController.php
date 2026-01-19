<?php

class outboundrouteController extends Outboundroute{
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
        require_once 'views/outboundroute/index.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar la vista del formulario
    public function create(){
        $trunks = Siptrunk::all();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/outboundroute/create.php';
        require_once 'views/layouts/footer.php';
        require_once 'views/outboundroute/modals.php';
    }

    // Validaciones e interaccion model
    public function store(){
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
//        die();
        if(parent::save($_POST)){
            if(telephonyController::generateOutboundroutes()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=outboundroute');
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
        $outboundroute = parent::find($_GET['id']);
        $trunks = Siptrunk::all();
        $patterns = parent::allPatterns($_GET['id']);
        $trunksRoute = parent::allTrunks($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/outboundroute/edit.php';
        require_once 'views/layouts/footer.php';
    }
    
    //Validaciones e interaccion model
    public function update(){
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
//        die();
        if(parent::updateR($_POST)){
            if(telephonyController::generateOutboundroutes()){
                $command = "reload";
                if(Telephony::command($command)){
                    $_SESSION['flash']['message'] = 'reloaded';
                    header('location:?controller=outboundroute');
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
        echo parent::deleteR($_GET) ? header('location: ?controller=outboundroute') : 'Error en el delete';
    }
    
    //Recarga Configuración
    public function reload(){
        if(telephonyController::generateOutboundroutes()){
            $command = "reload";
            if(Telephony::command($command)){
                $_SESSION['flash']['message'] = 'reloaded';
                header('location:?controller=outboundroute');
            }else{
                die('Error al recargar');
            }
        }else{
            die('Error al generar archivo');
        }
    }
}