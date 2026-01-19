            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Usuarios</h4>
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
                                    <a href="#" onclick="location.reload();">Usuarios</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Nuevo Usuario</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=user&method=store" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Nombre Completo</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre Completo" value="" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Nombre Completo</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email">E-Mail</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                        </div>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" aria-describedby="inputGroupPrepend" required>
                                                        <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un correo electrónico válido del usuario</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="password">Contraseña</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" value="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">La contraseña debe contener mínimo 8 Caracteres, Mayúsculas, Minúsculas y Simbolos</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="company">Departamento</label>
                                                    <input type="text" class="form-control" id="company" name="company" placeholder="Nombre del Departamento" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Nombre de la Empresa</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="role" class="">Perfil</label>
                                                    <select type="select" id="role" name="role" class="custom-select" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Ventas</option>
                                                        <option value="3">Servicio</option>
                                                        <option value="4">Laboratorio</option>
                                                        <option value="5">Administración y Compras</option>
                                                        <option value="6">Básico</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="active" class="">Usuario Activo</label>
                                                    <select type="select" id="active" name="active" class="custom-select" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="1">SI</option>
                                                        <option value="0">NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Crear Usuario</button>
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