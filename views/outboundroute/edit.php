            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Rutas de Salida</h4>
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
                                    <a href="#" onclick="location.reload();">Rutas de Salida</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Actualizar Ruta de Salida</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=outboundroute&method=update" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" id="id" name="id" value="<?= $outboundroute->id ?>">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="name">Nombre Completo</label>
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre Completo" value="<?= $outboundroute->name ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el nombre completo</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="context">Contexto</label>
                                                    <input type="text" name="context" class="form-control" id="context" placeholder="Identificador de Contexto" value="<?= $outboundroute->context ?>" pattern="[a-zA-Z0-9-_]+"  title="Solo N&uacute;meros y Letras" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el identificador</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="callerid">CallerID</label>
                                                    <input type="text" name="callerid" class="form-control" id="callerid" placeholder="CallerID" value="<?= $outboundroute->callerid ?>">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Host</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="active" class="">Troncal Activa</label>
                                                    <select type="select" id="active" name="active" class="custom-select" required>
                                                        <option value="">Seleccione...</option>
                                                        <option <?php echo ($outboundroute->active==1)?"selected":""; ?> value="1">SI</option>
                                                        <option <?php echo ($outboundroute->active==0)?"selected":""; ?> value="0">NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            <h3>Patrones de Marcación</h3>
                                                <p> 
                                                        <input type="button" class="btn btn-primary btn-sm add-more" value="Agregar Patrón"/> 
                                                        <input type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAyuda" value="Ayuda">
                                                </p>
                                            
                                            <div class="form-row control-group">
                                                <div class="col-md-2 mb-1">
                                                    <label>Anteponer</label>
                                                </div>
                                                <div class="col-md-2 mb-1">
                                                    <label>Prefijo</label>
                                                </div>
                                                <div class="col-md-7 mb-1">
                                                    <label>Patrón</label>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <label>Elim.</label>
                                                </div>
                                            </div>
                                            <?php foreach ($patterns as $keyPattern => $pattern) { ?>
                                            <div class="form-row control-group">
                                                <div class="col-md-2 mb-1">
                                                    <input type="text" class="form-control" id="prepend" name="prepend[]" value="<?= $pattern->prepend ?>" placeholder="Anteponer">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un Valor Válido</div>
                                                </div>
                                                <div class="col-md-2 mb-1">
                                                    <input type="text" class="form-control" id="prefix" name="prefix[]" value="<?= $pattern->prefix ?>" placeholder="Prefijo">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un Valor Válido</div>
                                                </div>
                                                <div class="col-md-7 mb-1">
                                                    <input type="text" class="form-control fieldReq" id="pattern" name="pattern[]" value="<?= $pattern->pattern ?>" placeholder="Patrón" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un Valor Válido</div>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <div class="input-group">
                                                        <div>
                                                            <button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            <div class="copy">
                                            <div class="form-row control-group">
                                                <div class="col-md-2 mb-1">
                                                    <input type="text" class="form-control" id="prepend" name="prepend[]" placeholder="Anteponer">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un Valor Válido</div>
                                                </div>
                                                <div class="col-md-2 mb-1">
                                                    <input type="text" class="form-control" id="prefix" name="prefix[]" placeholder="Prefijo">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un Valor Válido</div>
                                                </div>
                                                <div class="col-md-7 mb-1">
                                                    <input type="text" class="form-control fieldReq" id="pattern" name="pattern[]" placeholder="Patrón" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un Valor Válido</div>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <div class="input-group">
                                                        <div>
                                                            <button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </div> 
				            
                                            <div class="after-add-more"></div>
                                            
                                            <div class="row mb-5"></div>
                                            
                                            <h3>Troncales de Salida</h3>
                                                <p> 
                                                        <input type="button" class="btn btn-primary btn-sm add-more2" value="Agregar Troncal"/>
                                                </p>
                                            
                                            <div class="form-row control-group">
                                                <div class="col-md-11 mb-1">
                                                    <label>Troncal</label>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <label>Elim.</label>
                                                </div>
                                            </div>
                                            
                                            <?php foreach ($trunksRoute as $keyTrunk => $trunkRoute) { ?>
                                                
                                            <div class="form-row control-group">
                                                <div class="col-md-11 mb-1">
                                                    <select type="select" id="trunk" name="trunk[]" class="custom-select" required>
                                                        <option value="">Seleccione...</option>
                                                        <?php 
                                                        foreach ($trunks as $trunk) {
                                                            $selected = ($trunk->id == $trunkRoute->trunk)?"selected":""; 
                                                        ?>
                                                            <option value='<?= $trunk->id ?>' <?= $selected ?>><?= $trunk->fullname ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione un opción</div>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <div class="input-group">
                                                        <div>
                                                            <button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <?php } ?>
                                                
                                            <div class="copy2">
                                            <div class="form-row control-group">
                                                <div class="col-md-11 mb-1">
                                                    <select type="select" id="trunk" name="trunk[]" class="custom-select fieldReq" required>
                                                        <option value="">Seleccione...</option>
                                                        <?php foreach($trunks as $trunk):  ?>
                                                        <option value="<?= $trunk->id ?>"><?= $trunk->fullname ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione un opción</div>
                                                </div>
                                                <div class="col-md-1 mb-1">
                                                    <div class="input-group">
                                                        <div>
                                                            <button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </div> 
				            <div class="after-add-more2"></div>
                                            
                                            <div class="row mb-5"></div>
                                            
                                            <button class="btn btn-primary" type="submit">Actualizar Ruta</button>
                                            <a href="?controller=<?= $_GET['controller'];?>" class="btn btn-warning">Volver</a>

                                            <div style="display: none;" id="invalid-form-alert" class="col-md-6 mbg-3 alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close btn-xs" data-dismiss="alert">
                                                        <i class="ace-icon fa fa-times"></i>
                                                </button>
                                                Error de Validación. Verifique todos los campos y pulse nuevamente el botón!
                                            </div>
                                        </form>
                                        <script>
                                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                                            (function() {
                                                'use strict';
                                                window.addEventListener('load', function() {
                                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                                    var forms = document.getElementsByClassName('needs-validation');
                                                    var alertInvalid = document.getElementById('invalid-form-alert');
                                                    // Loop over them and prevent submission
                                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                                        form.addEventListener('submit', function(event) {
                                                            if (form.checkValidity() === false) {
                                                                event.preventDefault();
                                                                event.stopPropagation();
                                                                alertInvalid.style.display = "block";
                                                            }
                                                            form.classList.add('was-validated');
                                                        }, false);
                                                    });
                                                }, false);
                                            })();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>