            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Contactos</h4>
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
                                    <a href="#">Ventas</a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#" onclick="location.reload();">Contactos</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Nuevo Contacto</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=contact&method=store" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="firstName">Nombres</label>
                                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Nombre</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="lastName">Apellidos</label>
                                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Apellido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="fullName">Razón Social</label>
                                                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="" value="">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Nombre</div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="identificationType">Tipo de Identificación</label>
                                                    <select type="select" id="identificationType" name="identificationType" class="custom-select" required>
                                                        <option value="">Seleccione...</option>
                                                        <option value="13">Cédula de Ciudadanía</option>
                                                        <option value="31">NIT</option>
                                                        <option value="22">Cédula de Extranjería</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione un opción</div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="identificationNumber">Número de Identificación</label>
                                                    <input type="text" class="form-control" id="identificationNumber" name="identificationNumber" placeholder="" pattern="[0-9]+"  value="" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Número de Identificación sin caracteres especiales ni dígito de verificación.</div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="checkDigit">Dígito de Verificación</label>
                                                    <input type="text" class="form-control" id="checkDigit" name="checkDigit" placeholder="" pattern="[0-9]{1}"  value="">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el dígito de verificación.</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="country">País</label>
                                                    <select type="select" id="country" name="country" class="custom-select" required>
                                                        <option value="">Seleccione...</option>
                                                        <option value="Co">Colombia</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione un opción</div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="state">Departamento/Estado</label>
                                                    <select type="select" id="state" name="state" class="custom-select" required>

                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione un opción</div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="city">Ciudad</label>
                                                    <select type="select" id="city" name="city" class="custom-select" required>

                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione un opción</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="address">Dirección</label>
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Dirección Principal" value="" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba la Dirección</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="address2">Dirección 2</label>
                                                    <input type="text" class="form-control" id="address2" name="address2" placeholder="Dirección Complementaria / Alternativa" value="">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba la Dirección</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="email">E-Mail</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        </div>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="" aria-describedby="inputGroupPrepend" required>
                                                        <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un correo electrónico válido del usuario</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="phone">Número de Teléfono</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono Principal" value="">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Número de Teléfono.</div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="phone2">Número de Teléfono 2</label>
                                                    <input type="text" class="form-control" id="phone2" name="phone2" placeholder="Teléfono Alternativo" value="">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Número de Teléfono.</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="observations">Observaciones</label>
                                                    <textarea class="form-control" id="observations" name="observations" placeholder="Observaciones o Anotaciones"></textarea>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Crear Contacto</button>
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