            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Formularios</h4>
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
                                    <a href="#" onclick="location.reload();">Formularios</a>
                                </li>
                            </ul>
                        </div>
                        <?php if (isset($_SESSION['flash']['message'])) { ?>
                        <?php
                            if ($_SESSION['flash']['message']=='created'||$_SESSION['flash']['message']=='updated'||$_SESSION['flash']['message']=='deleted') {
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
                                        <h3>Diseñador de Formularios Web</h3>
                                    </div>
                                    <div class="card-body">
                                    <?php
                                    $mainTable = 0;
                                    $histTable = 0;
                                    echo "<h2>" . $form->name . "</h2>";
//                                    echo "<pre>";
//                                    print_r($forms);
//                                    echo "</pre>";
                                    foreach ($forms as $value) {
                                        //echo "<p>" . $value->table_name . "</p>";
                                        if("FORM_".$form->name === $value->table_name){
                                            //echo "<p>Tabla principal encontrada</p>";
                                            $mainTable = 1;
                                        }elseif("HIST_".$form->name === $value->table_name){
                                            //echo "<p>Tabla histórica encontrada</p>";
                                            $histTable = 1;
                                        }
                                    }
                                    
                                    if($mainTable==0&&$histTable==0){
                                    ?>
                                    
                                    <div id="formBuilder"></div> 
                                    
                                    <script>
                                        $(function(){
                                            $('#formBuilder').formbuilder({
                                                'save_url': '?controller=form&method=generateForm&id=<?php echo $_GET['id']; ?>',
                                                'load_url': '',
                                                'useJson' : true
                                            });
                                            $(function() {
                                                $("#formBuilder ul").sortable({ opacity: 0.6, cursor: 'move'});
                                            });
                                        });
                                    </script>
                                    <?php }elseif(($mainTable==0&&$histTable==1)OR($mainTable==1&&$histTable==0)){ ?>
                                        <div class="card card-dark bg-danger-gradient">
                                            <div class="card-body curves-shadow">
                                                <h1>Atención</h1>
                                                <h5 class="fw-bold">Se encontraron inconsistencias en las tablas del formulario. Por favor verifique con soporte técnico y NO utilice este formulario, corre el riesgo de perdida o corrupción de datos.</h5>
                                                <div class="pull-right">
                                                    <h3 class="fw-bold op-8"><a href="mailto:soporte@setcolombia.com">soporte@setcolombia.com</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="card card-dark bg-warning-gradient">
                                            <div class="card-body curves-shadow">
                                                <h1>Atención</h1>
                                                <h5 class="fw-bold">Este formulario ya tiene configurados los campos y tablas auxiliares. Si desea modificar dichos valores, deberá eliminar los campos actuales lo que generará perdida irrecuperable de la información registrada en los mismos.</h5>
                                                <h5 class="fw-bold">NO realice ninguna acción a menos que esté completamente seguro de las consecuencias y asegurese de tener copias de respado de los reportes de este formulario.</h5>
                                                <div class="pull-right">
                                                    <h3 class="fw-bold op-8"><a href="mailto:soporte@setcolombia.com">soporte@setcolombia.com</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    <a href="?controller=form&method=deleteForm&id=<?= $form->id ?>" data-toggle="tooltip" title="Eliminar Datos" data-placement="bottom" class="btn btn-danger btn-lg" onclick='return asegurar()'><i class="fa fa-trash"></i> Eliminar Campos y Tablas</a>
                                    <a href="?controller=form" data-toggle="tooltip" title="¡Sacame de aqui!" data-placement="bottom" class="btn btn-primary btn-lg"><i class="fa fa-backward"></i> Volver a la Lista</a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>