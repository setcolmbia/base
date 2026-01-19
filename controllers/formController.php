<?php

class formController extends Form{
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
            require_once 'views/errors/403.php';
            exit();
        }
    }


    //Mostrar toda la informacion
    public function index(){                
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/index.php';
        require_once 'views/layouts/footer.php';
        require_once 'views/forms/modals.php';
    }
    
    //Ajustar campos del form
    public function fields(){
        $forms = parent::allForms();
        $form = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/fields.php';
        require_once 'views/layouts/footer.php';
    }
    
    //Crear
    public function create(){
        $dispositions = Disposition::all();
        //$statuses = Status::all();
        //$fieldTypes = parent::allFieldTypes();
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/create.php';
        require_once 'views/layouts/footer.php';
        require_once 'views/forms/modals.php';
    }
    
    // Almacenar formulario
    public function store(){
        echo parent::save($_POST) ? header('location: ?controller=form') : 'Error en el store';
    }
    
    // Almacenar datos formularios dinámicos
    public function storeDynamic(){
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
        $form = parent::find($_GET['id']);
        echo parent::saveDynamic($_POST,$form->name) ? header('location: ?controller=form&method=wait') : 'Error en el store';
        //echo parent::save($_POST) ? header('location: ?controller=form') : 'Error en el store';
    }

    //consultar y luego mostrar la informacion en el formulario
    public function edit(){
        $form = parent::find($_GET['id']);
        $dispositions = Disposition::all();
        $disposForm = json_decode($form->dispositions);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/edit.php';
        require_once 'views/layouts/footer.php';
        require_once 'views/forms/modals.php';
    }
    
    // Actualizo registro.
    public function update(){
        if(parent::updateR($_POST)){
            header('location:?controller=form');
        }else{
            die('Error al actualizar');
        }
    }

    // Eliminar registro
    public function delete(){
        var_dump(parent::deleteR($_GET));
        echo parent::deleteR($_GET) ? header('location: ?controller=form') : 'Error en el delete';
    }
    
    // Eliminar Formulario
    public function deleteForm(){
        $form = parent::find($_GET['id']);
        var_dump(parent::deleteRForm($form->name));
        echo parent::deleteRForm($form->name) ? header('location: ?controller=form&method=fields&id='.$_GET['id']) : 'Error en el delete';
    }
    
    //Generar campos de formulario
    public function generateForm(){
        if(!isset($_POST['frmb'])){
            http_response_code(404);
            die();
        }
        $_POST['form_id'] = $_GET['id'];
        $form = parent::find($_GET['id']);
        $_POST['form_name'] = $form->name;
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
        $response = parent::createForm($_POST);
        echo $response;
        //echo '<br/>'.strcmp($response, "OK");
        if($response === "OK"){
            if($_SESSION['ajax']['message'] === 'created'){
                unset($_SESSION['ajax']);
                //echo $response;
            }elseif($_SESSION['ajax']['message'] === 'errorCreate'){
                unset($_SESSION['ajax']);
                //echo $response;
                http_response_code(500);
            }else{
                unset($_SESSION['ajax']);
                //echo $response;
                http_response_code(500);
            }
        }else{
            unset($_SESSION['ajax']);
            //echo "EROOOOOOORRRRRRRRRRR........";
            http_response_code(500);
        }
    }

    //Mostrar el formulario
    public function showForm(){
        $form = parent::find($_GET['id']);
        $dispositions = Disposition::all();
        $disposForm = json_decode($form->dispositions);
        if(isset($_GET['idLead'])){
            $lead = parent::findLead($form->name, $_GET['idLead']);
        }else{
            $lead = array();
        }
        //require_once 'views/layouts/header.php';
        //require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/headerForm.php';
        require_once 'views/forms/FORM_'.$form->name.'.php';
        require_once 'views/forms/footerForm.php';
        //require_once 'views/layouts/footer.php';
        //require_once 'views/forms/modals.php';
    }
    
    //Mostrar la lista formularios
    public function list(){
        //require_once 'views/layouts/header.php';
        //require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/headerForm.php';
        require_once 'views/forms/list.php';
        require_once 'views/forms/footerForm.php';
        //require_once 'views/layouts/footer.php';
        //require_once 'views/forms/modals.php';
    }
    
    //Mostrar la lista formularios
    public function wait(){
        //require_once 'views/layouts/header.php';
        //require_once 'views/layouts/sidemenu.php';
        require_once 'views/forms/headerForm.php';
        require_once 'vendors/auxiliares/espera.php';
        require_once 'views/forms/footerForm.php';
        //require_once 'views/layouts/footer.php';
        //require_once 'views/forms/modals.php';
    }
}