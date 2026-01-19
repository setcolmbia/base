            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Horarios</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="?controller=index">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Setcrm</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#" onclick="location.reload();">Horarios</a>
                                </li>
                            </ul>
                        </div>
                        <?php 
                        if (isset($_POST['name']) ) {
                            $name=$_POST['name'];
                            /*$lastName=$_POST['lastName'];
                            $fullName=$_POST['fullName'];
                            $identificationNumber=$_POST['identificationNumber'];
                            $email=$_POST['email'];*/
                        }else{
                            die("SIN DATOS PARA BUSCAR Horarios 1");
                        }
                        if($_POST['name'] == '' ){
                            die("SIN DATOS PARA BUSCAR Horarios 2");
                        }
                        ?>
                        <?php if (isset($_SESSION['flash']['message'])) { ?>
                        <?php
                                if ($_SESSION['flash']['message']=='created'||$_SESSION['flash']['message']=='updated'||$_SESSION['flash']['message']=='deleted'||$_SESSION['flash']['message']=='imported'||$_SESSION['flash']['message']=='createrange'||$_SESSION['flash']['message']=='reloaded') {
                                        $alert="success";	
                                }elseif($_SESSION['flash']['message']=='errorCreate'||$_SESSION['flash']['message']=='errorUpdate'||$_SESSION['flash']['message']=='errorDelete'){
                                        $alert="danger";
                                }
                            ?>
                        <div class="mbg-3 alert alert-<?php echo $alert;?> alert-dismissible fade show" role="alert">
                            <button type="button" class="close btn-xs" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                            </button>
                            <span class="pr-2">
                                <i class="fa fa-check"></i>
                            </span>
                            <?php
                                if ($_SESSION['flash']['message']=='created') {
                                        echo "Registro creado con éxito.";
                                }elseif($_SESSION['flash']['message']=='imported'){
                                        echo "Registros importados con éxito.";
                                }elseif($_SESSION['flash']['message']=='createrange'){
                                        echo "Tarea creada con éxito. <b><a href='?controller=events&method=list'> Ir a Tareas</a></b>"; 
                                }elseif($_SESSION['flash']['message']=='reloaded'){
                                        echo "Configuración cargada con éxito.";   
                                }elseif($_SESSION['flash']['message']=='updated'){
                                        echo "Registro actualizado con éxito."; 
                                }elseif($_SESSION['flash']['message']=='deleted'){
                                        echo "Registro eliminado con éxito.";
                                }elseif($_SESSION['flash']['message']=='errorCreate'){
                                        echo "!ATENCIÓN! Error al crear el registro: ";
                                        echo $_SESSION['flash']['detail'];
                                }elseif($_SESSION['flash']['message']=='errorUpdate'){
                                        echo "!ATENCIÓN! Error al actualizar el registro: ";
                                        echo $_SESSION['flash']['detail'];
                                }elseif($_SESSION['flash']['message']=='errorDelete'){
                                        echo "!ATENCIÓN! Error al eliminar el registro: ";
                                        echo $_SESSION['flash']['detail'];
                                }elseif($_SESSION['flash']['message']=='errorImport'){
                                        echo "!ATENCIÓN! Error al importar los registros: ";
                                        echo $_SESSION['flash']['detail'];
                                }
                                /*echo '<pre>';
                                print_r($_SESSION);
                                echo '</pre>';*/
                                unset($_SESSION['flash']);
                            ?>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="?controller=timerules&method=create" data-toggle="tooltip" title="Agregar Horario" data-placement="bottom" class="btn btn-primary">
                                            <i class="fas fa-user-plus"></i> Agregar Horario
                                        </a>
                                        <a href="?controller=timerules&method=reload" data-toggle="tooltip" title="Recargar Configuración" data-placement="bottom" class="btn btn-primary">
                                            <i class="fas fa-redo-alt"></i>&nbsp;&nbsp; Recargar Configuración
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="loader2"></div>
                                        <div class="table-responsive" style="display: none;">
                                            <table id="tabla-loader-100" class="table table-hover table-striped table-binvoiceed display" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                
                                                <?php foreach(parent::findByAny($name) as $timerules):  ?>
                                                    <tr>
                                                        <td><?= $timerules->id ?></td>
                                                        <td><?= $timerules->name ?></td>
                                                        <td><?= $timerules->description ?></td>
                                                        <td width="200" class="table__options">
                                                            <a href="?controller=timerules&method=edit&id=<?= $timerules->id ?>" data-toggle="tooltip" title="Editar el Horario" data-placement="bottom" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                                            <a href="?controller=timerules&method=delete&id=<?= $timerules->id ?>" data-toggle="tooltip" title="Eliminar el Horario" data-placement="bottom" class="btn btn-danger btn-sm" onclick='return asegurar()'><i class="fa fa-trash"></i> Borrar</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>                                
                                                    <th>Acciones</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>