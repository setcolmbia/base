            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Agentes Telefónicos</h4>
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
                                    <a href="#">Administración</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#" onclick="location.reload();">Agentes Telefónicos</a>
                                </li>
                            </ul>
                        </div>
                        <?php if (isset($_SESSION['flash']['message'])) { ?>
                            <?php
                            if ($_SESSION['flash']['message']=='created'||$_SESSION['flash']['message']=='reloaded'||$_SESSION['flash']['message']=='updated'||$_SESSION['flash']['message']=='deleted') {
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
                                        <a href="?controller=agent&method=create" data-toggle="tooltip" title="Agregar Usuario" data-placement="bottom" class="btn btn-primary">
                                            <i class="fas fa-user-plus"></i> Agregar Agente
                                        </a>
                                        <a href="?controller=agent&method=reload" data-toggle="tooltip" title="Recargar Configuración" data-placement="bottom" class="btn btn-primary">
                                            <i class="fas fa-redo-alt"></i>&nbsp;&nbsp; Recargar Configuración
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="loader2"></div>
                                        <div class="table-responsive" style="display: none;">
                                            <table id="tabla-loader-100" class="table table-hover table-striped table-binvoiceed display" width="100%">
                                                <thead>
                                                <tr>
                                                    <th>Número</th>
                                                    <th>Nombre</th>
                                                    <th>Activo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach(parent::all() as $agent):  ?>
                                                    <tr>
                                                        <td><?= $agent->number ?></td>
                                                        <td><?= $agent->name ?></td>
                                                        <td><?php echo ($agent->active==1)?"SI":"NO"; ?></td>
                                                        <td width="200" class="table__options">
                                                            <a href="?controller=agent&method=edit&id=<?= $agent->id ?>" data-toggle="tooltip" title="Editar el Cliente" data-placement="bottom" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                                            <a href="?controller=agent&method=delete&id=<?= $agent->id ?>" data-toggle="tooltip" title="Eliminar el Cliente" data-placement="bottom" class="btn btn-danger btn-sm" onclick='return asegurar()'><i class="fa fa-trash"></i> Borrar</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Número</th>
                                                    <th>Nombre</th>
                                                    <th>Activo</th>
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