            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Rutas de Entrada</h4>
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
                                    <a href="#" onclick="location.reload();">Rutas de Entrada</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Nueva Ruta de Entrada</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=inboundroutes&method=store" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">DID</label>
                                                    <input type="text" class="form-control" id="did" name="did" placeholder="Escriba el DID de la Ruta de Entrada" value="" title="Escriba el DID de la Ruta de Entrada" pattern="[A-Za-z0-9_ ]+" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el DID de la Ruta de Entrada</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Escriba el nombre de la Ruta de Entrada" value="" title="Escriba el nombre de la Ruta de Entrada" pattern="[A-Za-z0-9_ ]+" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el nombre de la Ruta de Entrada</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción.</label>
                                                    <select type="select" id="dest" name="dest" class="custom-select">
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="inboundroutes">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="idDest" name="idDest" class="custom-select">
                                                        <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Guardar Horario</button>
                                            <a href="?controller=<?= $_GET['controller'];?>&method=list" class="btn btn-warning">Volver</a>

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

        <script >
            $('#dest').on('change', function(){            
                if($('#dest').val() == ""){
                    $('#idDest').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#idDest');
                }else{
                    $('#idDest').removeAttr('disabled', 'disabled');
                    $('#idDest').load('models/dependents.php?option1=' + $('#dest').val());
                }
            }); 
        </script>