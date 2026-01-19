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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Nuevo Formulario</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=form&method=update" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id" value="<?= $form->id ?>">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-1 form-group">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Formulario" pattern="[a-zA-Z0-9-_]+" title="No use espacios ni caracteres especiales" value="<?= $form->name ?>" readonly>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el nombre del formulario</div>
                                                </div>
                                                <div class="col-md-6 mb-3 form-group">
                                                    <label for="active" class="">Activo</label>
                                                    <select type="select" id="active" name="active" class="custom-select" required>
                                                        <option value="">Seleccione</option>
                                                        <option <?php echo ($form->active==1)?"selected":""; ?> value="1">SI</option>
                                                        <option <?php echo ($form->active==0)?"selected":""; ?> value="0">NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3 form-group">
                                                    <label for="description">Descripción</label>
                                                    <textarea id="description" name="description" placeholder="Descripción" class="form-control"><?= $form->description ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3 form-group">
                                                    <label for="speech">Speech/Guión</label>
                                                    <textarea id="speech" name="speech" class="form-control"><?= html_entity_decode($form->speech) ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <h3>Resultados de Llamada</h3>
                                                <p> 
                                                    <input type="button" class="btn btn-primary btn-sm add-more" value="Agregar"/>
                                                </p>
                                            
                                            <div class="form-row control-group">
                                                <div class="col-md-11 mb-1 form-group">
                                                    <label>Resultado</label>
                                                </div>
                                                <div class="col-md-1 mb-1 form-group">
                                                    <label>Elim.</label>
                                                </div>
                                            </div>
                                            <?php foreach ($disposForm as $keyForm => $dispositionForm) { ?>
                                            <div class="form-row control-group">
                                                <div class="col-md-11 mb-1">
                                                    <select type="select" id="disposition" name="disposition[]" class="custom-select" required>
                                                        <option value="">Seleccione...</option>
                                                        <?php 
                                                        foreach ($dispositions as $disposition) {
                                                            $selected = ($disposition->id == $dispositionForm)?"selected":""; 
                                                        ?>
                                                            <option value='<?= $disposition->id ?>' <?= $selected ?>><?= $disposition->name ?></option>
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
                                            <div class="copy">
                                            <div class="form-row control-group">
                                                <div class="col-md-11 mb-1">
                                                    <select type="select" id="disposition" name="disposition[]" class="custom-select fieldReq" required>
                                                        <option value="">Seleccione...</option>
                                                        <?php foreach($dispositions as $disposition):  ?>
                                                        <option value="<?= $disposition->id ?>"><?= $disposition->name ?></option>
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
				            
                                            <div class="after-add-more"></div>
                                            
                                            <div class="row mb-5"></div>
                                            
                                            <button class="btn btn-primary" type="submit">Actualizar Formulario</button>
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
                                        <script>
                                            tinymce.init({
                                                selector : "#speech",
                                                menubar : false,
                                                language_url: 'assets/js/plugin/tinymce/langs/es_MX.js',
                                                language: 'es_MX',
                                                toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | forecolor backcolor'
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>