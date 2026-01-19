<div class="card">
                                    <div class="card-header">
                                        <h3>PRUEBA_FORM</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=form&method=storeDynamic&id=8" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <div>
                                                        <?= html_entity_decode($form->speech) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="Nombre">Nombre</label>
                                                    <input type="text" class="form-control" id="Nombre" name="Nombre" value="<?= isset($_GET['idLead']) ? $lead->Nombre:'' ?>" required >
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="Cdula">Cédula</label>
                                                    <input type="number" class="form-control" id="Cdula" name="Cdula" value="<?= isset($_GET['idLead']) ? $lead->Cdula:'' ?>" required >
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un número válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="Correo">Correo</label>
                                                    <input type="email" class="form-control" id="Correo" name="Correo" value="<?= isset($_GET['idLead']) ? $lead->Correo:'' ?>" required >
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un email válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3 form-group">
                                                    <label for="Motivo">Motivo</label>
                                                    <select type="select" id="Motivo" name="Motivo" class="custom-select" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="Prueba" >Prueba</option>
                                        <option value="Información" >Información</option>
                                        <option value="PQR" >PQR</option>
                                        </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="Solo_lectura_1">Solo lectura 1</label>
                                                    <input type="text" class="form-control" id="Solo_lectura_1" name="Solo_lectura_1" value="<?= isset($_GET['idLead']) ? $lead->Solo_lectura_1:'' ?>"  readonly>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="Solo_lectura_2">Solo lectura 2</label>
                                                    <input type="text" class="form-control" id="Solo_lectura_2" name="Solo_lectura_2" value="<?= isset($_GET['idLead']) ? $lead->Solo_lectura_2:'' ?>"  readonly>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-1">
                                                    <label for="Observaciones">Observaciones</label>
                                                    <textarea id="Observaciones" name="Observaciones" class="form-control"  ><?= isset($_GET['idLead']) ? $lead->Observaciones:'' ?></textarea>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3 form-check">
                                                    <label>Re-Agendar Llamada</label>
                                                    <br/>
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="checkbox" id="callBack" name="callBack" value="callBack" >
                                                        <span class="form-check-sign">Agendar</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-6 mb-1 cb_datetime form-group" style="display: none;">
                                                    <label for="cb_datetime">Fecha Llamada</label>
                                                    <br/>
                                                    <input type="text" class="datepicker form-control" autocomplete="off"  style="display: inline; width: 150px;"  id="cb_datetime" name="cb_datetime" value="<?= date("Y-m-d", strtotime(date("Y-m-d") . " +1 day")) ?>" required>
                                                    <select id="hora_cb" name="hora_cb" style="width: 80px;" class="custom-select" >
                                                        <option value="00">00</option>
                                                        <option value="01">01</option>
                                                        <option value="02">02</option>
                                                        <option value="03">03</option>
                                                        <option value="04">04</option>
                                                        <option value="05">05</option>
                                                        <option value="06">06</option>
                                                        <option value="07">07</option>
                                                        <option value="08">08</option>
                                                        <option value="09">09</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>								  	
                                                    </select> - <select id="min_cb" name="min_cb" style="width: 80px;" class="custom-select" >
                                                        <option value="00">00</option>
                                                        <option value="05">05</option>
                                                        <option value="10">10</option>
                                                        <option value="15">15</option>
                                                        <option value="20">20</option>
                                                        <option value="25">25</option>
                                                        <option value="30">30</option>
                                                        <option value="35">35</option>
                                                        <option value="40">40</option>
                                                        <option value="45">45</option>
                                                        <option value="50">50</option>
                                                        <option value="55">55</option>								  	
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba un texto válido</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3 form-group">
                                                    <label for="disposition">Resultado de Llamada</label>
                                                    <select type="select" id="disposition" name="disposition" class="custom-select" required>
                                                    <option value="">Seleccione</option>
                                                    <?php
                                                    foreach ($disposForm as $keyForm => $dispositionForm) {
                                                        foreach ($dispositions as $key => $disposition) {
                                                            if($disposition->id == $dispositionForm){
                                                                echo "<option value=\"".$disposition->name."\">".$disposition->name."</option>";
                                                            }   
                                                        }
                                                    }
                                                    ?>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>
                                        <button class="btn btn-primary" type="submit">Guardar</button>
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
                                        $('#callBack').click(function () {
                                            if( $(this).is(':checked') ){
                                                $('.cb_datetime').show();
                                            }
                                            else{
                                                $('.cb_datetime').hide();
                                            }
                                        });
                                    </script>
                                </div>
                            </div>