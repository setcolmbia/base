            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Extensiones SIP</h4>
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
                                    <a href="#" onclick="location.reload();">Extensiones SIP</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Editar Extensión SIP</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=sip&method=update&id=<?= $sip->id ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="fullname">Nombre Completo</label>
                                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Nombre Completo" value="<?= $sip->fullname ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el nombre completo</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="name">Número de Extensión</label>
                                                    <input type="number" name="name" class="form-control" id="name" placeholder="Extensión" value="<?= $sip->name ?>" pattern="[1-9]{1}[0-9]{2,9}"  title="Solo N&uacute;meros entre 100 y 9999999999" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba  la Extensión</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="context">Grupo/Contexto</label>
                                                    <select  name="context" class="custom-select" id="context" required>
                                                        <option value=''>Seleccione</option>
                                                        <?php foreach ($contexts as $context) { $selected = ($context->context == $sip->context)?"selected":""; ?>
                                                            <option value='<?= $context->context ?>' <?= $selected ?>><?= $context->context ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="name">Codecs</label>
                                                    <input type="text" name="allow" class="form-control" id="allow" value="gsm;ulaw;alaw" placeholder="Codecs" value="<?= $sip->allow ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba los Codecs</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="secret">Clave SIP</label>
                                                    <input type="text" name="secret" class="form-control" id="secret" placeholder="Clave SIP" value="<?= $sip->secret ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba la clave</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="call_limit">Limite de Canales</label>
                                                    <input type="number" step="1" name="call_limit" class="form-control" id="call_limit" placeholder="Limite de Canales" value="<?= $sip->call_limit ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el limite de canales</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="active" class="">Extensión Activa</label>
                                                    <select type="select" id="active" name="active" class="custom-select" required>
                                                        <option value="">Seleccione</option>
                                                        <option <?php echo ($sip->active==1)?"selected":""; ?> value="1">SI</option>
                                                        <option <?php echo ($sip->active==0)?"selected":""; ?> value="0">NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Actualizar Extensión</button>
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