<?php

class contactController extends Contact{
    /**
     * Función que se ejecuta siempre que se crea un objeto.
     * Se puede usar para la seguridad de un controlador.
     */
    public function __construct()
    {
        Security::verifyUser();
    }


    //Mostrar toda la informacion
    public function index(){                
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/contact/index.php';
        require_once 'views/layouts/footer.php';
    }

    // Mostar la vista del formulario
    public function create(){
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/contact/create.php';
        require_once 'views/layouts/footer.php';
    }

    // Validaciones e interaccion model
    public function store(){
        echo parent::save($_POST) ? header('location: ?controller=contact') : 'Error en el store';
    }

    //consultar y luego mostrar la informacion en el formulario
    public function edit(){
        $contact = parent::find($_GET['id']);
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/contact/edit.php';
        require_once 'views/layouts/footer.php';
    }

    //Validaciones e interaccion model
    public function update(){
        $_POST['id'] = $_GET['id'];
        if(parent::updateR($_POST)){
            header('location:?controller=contact');
        }else{
            die('Error al actualizar');
        }
    }

    //
    public function delete(){
        var_dump(parent::deleteR($_GET));
        echo parent::deleteR($_GET) ? header('location: ?controller=contact') : 'Error en el delete';
    }
    
    //Busqueda de Cliente
    public function search(){
            echo "<table class='table table-hover'>
                <thead>
                    <tr>
                        <th scope='col'>Identificación</th>
                        <th scope='col'>P. Nombre</th>
                        <th scope='col'>P. Apellido</th>
                        <th scope='col'>Razón Social</th>
                        <th scope='col'>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>";
        foreach (parent::findByName($_POST['contacte']) as $user){
            echo "
                    <tr>
                        <td>".$user->identificationNumber."</td>
                        <td>".$user->firstName."</td>
                        <td>".$user->lastName."</td>
                        <td>".$user->fullName."</td>
                        <td><a href='?controller=invoice&method=create&id=$user->id' data-toggle='tooltip' title='Seleccionar Cliente' data-placement='bottom' class='btn btn-primary btn-sm'><i class='fa fa-check-square'></i> Seleccionar</a></td>
                    </tr>";
        }
                echo  "</tbody>
                </table>";
    }

    //Busqueda de Departamentos
    public function searchState(){
        echo "<option value=''>Seleccione...</option>";
        if($states = parent::findStateByCountry($_POST['pais'])){
            foreach ($states as $value) {
                echo "<option value='".$value->stateCode."'>".$value->stateName."</option>";
            }
        }else{
            echo "<p>Estados no encontrados</p>";
        }
    }

    //Busqueda de Ciudades
    public function searchCity(){
        echo "<option value=''>Seleccione...</option>";
        if($cities = parent::findCityByState($_POST['departamento'],$_POST['pais'])){
            foreach ($cities as $value) {
                echo "<option value='".$value->cityCode."'>".$value->cityName."</option>";
            }
        }else{
            echo "<p>Ciudades no encontradas</p>";
        }
    }

}