<?php

class externalController{

    /**
     * Función que se ejecuta siempre que se crea un objeto.
     * Se puede usar para la seguridad de un controlador.
     */
    public function __construct()
    {
        Security::verifyUser();
    }

    /**
     * Vista principal de los controladores.
     * Principalmente casi siempre se retorna una vista con una tabla para mostrar todos los registros. (Esto depende de la necesidad del cliente)
     */
    public function powerBI(){
        require_once 'views/layouts/header.php';
        require_once 'views/layouts/sidemenu.php';
        require_once 'views/external/powerbi.php';
        require_once 'views/layouts/footer.php';
    }
}