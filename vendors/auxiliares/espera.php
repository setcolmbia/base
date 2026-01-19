<div id="page-container">
    
<?php 
if (isset($_SESSION['flash']['message'])) { 
    if ($_SESSION['flash']['message']=='created'||$_SESSION['flash']['message']=='reloaded'||$_SESSION['flash']['message']=='updated'||$_SESSION['flash']['message']=='deleted') {
        $alert="success";	
    }elseif($_SESSION['flash']['message']=='errorCreate'||$_SESSION['flash']['message']=='errorUpdate'||$_SESSION['flash']['message']=='errorDelete'){
        $alert="danger";
    }
?>
<div class="mbg-3 alert alert-<?php echo $alert;?> alert-dismissible fade show" role="alert">
<!--    <button type="button" class="close btn-xs" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
    </button>-->
    <span class="pr-2">
        <i class="fa fa-check"></i>
    </span>
<?php
    if ($_SESSION['flash']['message']=='created') {
            echo "Registro creado con éxito.";	
    }elseif($_SESSION['flash']['message']=='updated'){
            echo "Registro actualizado con éxito.";   
    }elseif($_SESSION['flash']['message']=='deleted'){
            echo "Registro eliminado con éxito.";   
    }elseif($_SESSION['flash']['message']=='reloaded'){
            echo "Configuración cargada con éxito.";
    }elseif($_SESSION['flash']['message']=='errorCreate'){
            echo "!ATENCIÓN! Error al crear el registro: ";
            echo $_SESSION['flash']['detail'];
    }elseif($_SESSION['flash']['message']=='errorUpdate'){
            echo "!ATENCIÓN! Error al actualizar el registro: ";
            echo $_SESSION['flash']['detail'];
    }elseif($_SESSION['flash']['message']=='errorDelete'){
            echo "!ATENCIÓN! Error al eliminar el registro: ";
            echo $_SESSION['flash']['detail'];
    }
?>
</div>
<?php } ?>


<?php
    if (isset($_SESSION['flash']['message'])) {
            echo "";	
    }else{
        echo '<div style="color:#1572e8"; align=center><h1>¡Bienvenido a SETCRM!.</h1></div>';
    }
    /*echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';*/
    unset($_SESSION['flash']);
?>

</div>

<script type="text/javascript">
parent.AdjustIframeHeightTipificar(document.getElementById("page-container").scrollHeight);
</script>

</body>
</html>

