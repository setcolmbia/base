            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">Troncales SIP</h4>
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
                                    <a href="#" onclick="location.reload();">Troncales SIP</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Editar Troncal SIP</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=siptrunk&method=update&id=<?= $siptrunk->id ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="fullname">Nombre Completo</label>
                                                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Nombre Completo" value="<?= $siptrunk->fullname ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el nombre completo</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="name">Identificador/Usuario</label>
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Identificador" value="<?= $siptrunk->name ?>" pattern="[a-zA-Z0-9-_]+"  title="Solo N&uacute;meros y Letras" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el identificador</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="host">Host IP/FQDN</label>
                                                    <input type="text" name="host" class="form-control" id="host" placeholder="Host Remoto" value="<?= $siptrunk->host ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Host</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="port">Puerto UDP</label>
                                                    <input type="number" name="port" class="form-control" id="port" placeholder="Puerto" value="<?= $siptrunk->port ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Puerto</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="context">Grupo/Contexto</label>
                                                    <select  name="context" class="custom-select" id="context" required>
                                                        <option value=''>Seleccione</option>
                                                        <?php foreach ($contexts as $context) { $selected = ($context->context == $siptrunk->context)?"selected":""; ?>
                                                            <option value='<?= $context->context ?>' <?= $selected ?>><?= $context->context ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="call_limit">Limite de Canales</label>
                                                    <input type="number" step="1" name="call_limit" class="form-control" id="call_limit" placeholder="Limite de Canales" value="<?= $siptrunk->call_limit ?>" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el limite de canales</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="allow">Codecs</label>
                                                    <select  name="allow[]" class="custom-select" id="allow" required multiple>
                                                        <option value='alaw' <?= (in_array("alaw", $allow))?"selected":""; ?> >G.711 Alaw</option>
                                                        <option value='ulaw' <?= (in_array("ulaw", $allow))?"selected":""; ?> >G.711 Ulaw</option>
                                                        <option value='gsm' <?= (in_array("gsm", $allow))?"selected":""; ?> >GSM</option>
                                                        <option value='g729' <?= (in_array("g729", $allow))?"selected":""; ?> >G.729</option>
                                                        <option value='g722' <?= (in_array("g722", $allow))?"selected":""; ?> >G.722</option>
                                                        <option value='ilbc' <?= (in_array("ilbc", $allow))?"selected":""; ?> >iLBC</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione los Codecs</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="insecure">Seguridad (Insecure)</label>
                                                    <select  name="insecure[]" class="custom-select" id="insecure" required multiple>
                                                        <option value='port' <?= (in_array("port", $insecure))?"selected":""; ?>>port</option>
                                                        <option value='invite' <?= (in_array("invite", $insecure))?"selected":""; ?>>invite</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="auth" class="">Utiliza Registro</label>
                                                    <select type="select" id="auth" name="auth" class="custom-select" required>
                                                        <option value="">Seleccione</option>
                                                        <option value="1" <?= ($siptrunk->auth=="1")?"selected":""; ?> >SI</option>
                                                        <option value="0" <?= ($siptrunk->auth=="0")?"selected":""; ?> >NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="secret">Clave SIP</label>
                                                    <input type="text" name="secret" class="form-control" id="secret" placeholder="Clave SIP" value="<?= $siptrunk->secret ?>" <?= ($siptrunk->auth=="0")?"disabled":""; ?>>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba la clave</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="fromuser">FromUser</label>
                                                    <input type="text" name="fromuser" class="form-control" id="fromuser" placeholder="FromUser" value="<?= $siptrunk->fromuser ?>">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el valor</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="fromdomain">FromDomain</label>
                                                    <input type="text" name="fromdomain" class="form-control" id="fromdomain" placeholder="FromDomain" value="<?= $siptrunk->fromdomain ?>">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el valor</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="dtmfmode" class="">Modo DTMF</label>
                                                    <select type="select" id="dtmfmode" name="dtmfmode" class="custom-select" required>
                                                        <option value="1" <?= ($siptrunk->auth=="1")?"selected":""; ?> >SI</option>
                                                        <option value="rfc2833" <?= ($siptrunk->dtmfmode=="rfc2833")?"selected":""; ?>>RFC2833</option>
                                                        <option value="inband" <?= ($siptrunk->dtmfmode=="inband")?"selected":""; ?>>Inband</option>
                                                        <option value="info" <?= ($siptrunk->dtmfmode=="info")?"selected":""; ?>>Info</option>
                                                        <option value="auto" <?= ($siptrunk->dtmfmode=="auto")?"selected":""; ?>>Auto</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="active" class="">Troncal Activa</label>
                                                    <select type="select" id="active" name="active" class="custom-select" required>
                                                        <option value="">Seleccione</option>
                                                        <option <?php echo ($siptrunk->active==1)?"selected":""; ?> value="1">SI</option>
                                                        <option <?php echo ($siptrunk->active==0)?"selected":""; ?> value="0">NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
<!--                                                <div class="col-md-6 mb-3">
                                                    <label class="control-label" for="cid_number">CallerID</label>
                                                    <input type="text" name="cid_number" class="form-control" id="cid_number" placeholder="Número de CallerID" value="<?= $siptrunk->cid_number ?>">
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba la clave</div>
                                                </div>-->
                                            </div>
                                            <button class="btn btn-primary" type="submit">Actualizar Troncal</button>
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
                                        <script type="text/javascript">
                                            $(document).ready(function() {
                                                $("#auth").change(function(){
                                                    var opcion = $(this).val();
                                                    if (opcion == "0") {
                                                        $("#secret")
                                                            .val('')
                                                            .attr("disabled", "disabled")
                                                            .siblings().removeAttr("disabled")
                                                            .removeAttr("required");
                                                    } else {
                                                        $("#secret")
                                                            .removeAttr("disabled")
                                                            .attr("required", "required");
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>