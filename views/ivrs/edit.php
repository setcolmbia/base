            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title">IVRs</h4>
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
                                    <a href="#" onclick="location.reload();">IVRs</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Edición del IVR</h3>
                                    </div>
                                    <div class="card-body">
                                        <form class="needs-validation" novalidate action="?controller=ivrs&method=update&id=<?= $ivrs->id ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Nombre</label>
                                                    <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?= $ivrs->id ?>" readonly required>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?= $ivrs->name ?>" readonly required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba el Nombre</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="description">Descripción</label>
                                                    <textarea id="description" name="description" class="form-control" rows="2" required><?= $ivrs->description ?></textarea>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Escriba la Descripción</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="number">Número</label>
                                                    <input type="number" class="form-control" id="number" name="number" placeholder="Número" value="<?= $ivrs->number ?>" title="Número" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Número</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="timeout">Tiempo Máx. Opción</label>
                                                    <input type="timeout" class="form-control" id="timeout" name="timeout" placeholder="Digite el tiempo máximo de ejecución" value="<?= $ivrs->number ?>" title="Digite el tiempo máximo de ejecución" required>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Digite el tiempo máximo de ejecución</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Grabación</label>
                                                    <select type="select" id="recording" name="recording" class="custom-select" required>
                                                        <?php $recording = parent::recording($ivrs->recording)?>
                                                        <?php foreach(parent::recordings() as $recordings):  ?>
                                                        <option value="<?= $recordings->id ?>" <?php echo ($recording->id==$recordings->id)?"selected":""; ?>><?= $recordings->name ?></option>
                                                    <?php endforeach; ?>    
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="directDial">Marcación Directa</label>
                                                    <select type="select" id="directDial" name="directDial" class="custom-select" required>
                                                        <option <?php echo ($ivrs->directDial=='SI')?"selected":""; ?> value="SI">SI</option>
                                                        <option <?php echo ($ivrs->directDial=='NO')?"selected":""; ?> value="NO">NO</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>
                                            </div>                                            
                                            <?php foreach(parent::findByAnyMenu($ivrs->id) as $options):  ?>
                                                <?php                                                     
                                                    if($options->option == 1){
                                                        $option1 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option1,$idDest);
                                                            $destination1 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination1 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                        
                                                    }
                                                    if($options->option == 2){
                                                        $option2 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option2,$idDest);
                                                            $destination2 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination2 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                        
                                                    }
                                                    if($options->option == 3){
                                                        $option3 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option3,$idDest);
                                                            $destination3 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination3 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 4){
                                                        $option4 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option4,$idDest);
                                                            $destination4 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination4 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 5){
                                                        $option5 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option5,$idDest);
                                                            $destination5 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination5 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 6){
                                                        $option6 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option6,$idDest);
                                                            $destination6 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination6 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 7){
                                                        $option7 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option7,$idDest);
                                                            $destination7 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination7 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 8){
                                                        $option8 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option8,$idDest);
                                                            $destination8 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination8 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 9){
                                                        $option9 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option9,$idDest);
                                                            $destination9 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination9 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 10){
                                                        $option10 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option10,$idDest);
                                                            $destination10 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination10 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 11){
                                                        $option11 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option11,$idDest);
                                                            $destination11 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination11 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    if($options->option == 12){
                                                        $option12 = $options->dest;
                                                        $idDest = $options->idDest;
                                                        if($idDest){
                                                            $dest = parent::findByOptions($option12,$idDest);
                                                            $destination12 = '<option value="'.$dest->id.'">'.$dest->name.'</option>';
                                                        }else{
                                                            $destination12 = '<option value="">Seleccione Destino.</option>';
                                                        }
                                                    }
                                                    
                                                ?>
                                            <?php endforeach; ?>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 1.</label>
                                                    <select type="select" id="option1" name="option1" class="custom-select">
                                                        <?php mostrarOpcion($option1); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination1" name="destination1" class="custom-select">
                                                        <?= $destination1; ?>
                                                        <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 2.</label>
                                                    <select type="select" id="option2" name="option2" class="custom-select">
                                                        <?php mostrarOpcion($option2); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination2" name="destination2" class="custom-select">
                                                        <?= $destination2; ?>
                                                        <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 3.</label>
                                                    <select type="select" id="option3" name="option3" class="custom-select">
                                                        <?php mostrarOpcion($option3); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination3" name="destination3" class="custom-select">
                                                        <?= $destination3; ?>
                                                        <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 4.</label>
                                                    <select type="select" id="option4" name="option4" class="custom-select">
                                                        <?php mostrarOpcion($option4); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination4" name="destination4" class="custom-select">
                                                         <?= $destination4; ?>
                                                         <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 5.</label>
                                                    <select type="select" id="option5" name="option5" class="custom-select">
                                                        <?php mostrarOpcion($option5); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination5" name="destination5" class="custom-select">
                                                          <?= $destination5; ?>
                                                          <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 6.</label>
                                                    <select type="select" id="option6" name="option6" class="custom-select">
                                                        <?php mostrarOpcion($option6); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination6" name="destination6" class="custom-select">
                                                         <?= $destination6; ?>
                                                         <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 7.</label>
                                                    <select type="select" id="option7" name="option7" class="custom-select">
                                                        <?php mostrarOpcion($option7); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination7" name="destination7" class="custom-select">
                                                         <?= $destination7; ?>
                                                         <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 8.</label>
                                                    <select type="select" id="option8" name="option8" class="custom-select">
                                                        <?php mostrarOpcion($option8); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination8" name="destination8" class="custom-select">
                                                          <?= $destination8; ?>
                                                          <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 9.</label>
                                                    <select type="select" id="option9" name="option9" class="custom-select">
                                                        <?php mostrarOpcion($option9); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination9" name="destination9" class="custom-select">
                                                          <?= $destination9; ?>
                                                          <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción 0.</label>
                                                    <select type="select" id="option10" name="option10" class="custom-select">
                                                        <?php mostrarOpcion($option10); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination10" name="destination10" class="custom-select">
                                                         <?= $destination10; ?>
                                                         <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción Errada.</label>
                                                    <select type="select" id="option11" name="option11" class="custom-select">
                                                        <?php mostrarOpcion($option11); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination11" name="destination11" class="custom-select">
                                                          <?= $destination11; ?>
                                                          <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Opción Timeoup.</label>
                                                    <select type="select" id="option12" name="option12" class="custom-select">
                                                        <?php mostrarOpcion($option12); ?>
                                                        <option value="">No Usada</option>
                                                        <option value="sip">Extensiones</option>
                                                        <option value="queues">Colas</option>
                                                        <option value="ivrs">IVRs</option>
                                                        <option value="timerules">Horario</option>
                                                        <option value="shortcodes">Códigos Abreviados</option>
                                                        <option value="voicemails">Buzón</option>
                                                        <option value="hangups">Terminar LLamada</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una opción</div>
                                                </div>                                                
                                                <div class="col-md-6 mb-3">
                                                    <label for="recording">Destino.</label>
                                                    <select type="select" id="destination12" name="destination12" class="custom-select">
                                                         <?= $destination12; ?>
                                                         <option value="">Seleccione Destino.</option>
                                                    </select>
                                                    <div class="valid-feedback">Correcto!</div>
                                                    <div class="invalid-feedback">Seleccione una destino</div>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Actualizar</button>
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
    <?php 
        function mostrarOpcion($idOpcion){
            switch ($idOpcion) {
                case '':
                    echo "<option value=''>No Usada</option>";
                    break;
                case 'sip':
                    echo "<option value='sip'>Extensiones</option>";
                    break;
                case 'queues':
                    echo "<option value='queues'>Colas</option>";
                    break;
                case 'ivrs':
                    echo "<option value='ivrs'>IVRs</option>";
                    break;
                case 'timerules':
                    echo "<option value='timerules'>Horario</option>";
                    break;
                case 'shortcodes':
                    echo "<option value='shortcodes'>Códigos Abreviados</option>";
                    break;
                case 'voicemails':
                    echo "<option value='voicemails'>Buzón</option>";
                    break;
                case 'hangups':
                    echo "<option value='hangups'>Terminar LLamada</option>";
                    break;
                default:
                    
                    break;
            }                                   
        }

     ?>

    <script >
            $('#option1').on('change', function(){            
                if($('#option1').val() == ""){
                    $('#destination1').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination1');
                    //$('#destination1').attr('disabled', 'disabled');
                }else{
                    $('#destination1').removeAttr('disabled', 'disabled');
                    $('#destination1').load('models/dependents.php?option1=' + $('#option1').val());
                }
            }); 
            $('#option2').on('change', function(){            
                if($('#option2').val() == ""){
                    $('#destination2').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination2');
                    //$('#destination2').attr('disabled', 'disabled');
                }else{
                    $('#destination2').removeAttr('disabled', 'disabled');
                    $('#destination2').load('models/dependents.php?option2=' + $('#option2').val());
                }
            });
            $('#option3').on('change', function(){            
                if($('#option3').val() == ""){
                    $('#destination3').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination3');
                    //$('#destination3').attr('disabled', 'disabled');
                }else{
                    $('#destination3').removeAttr('disabled', 'disabled');
                    $('#destination3').load('models/dependents.php?option3=' + $('#option3').val());
                }
            }); 
            $('#option4').on('change', function(){            
                if($('#option4').val() == ""){
                    $('#destination4').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination4');
                    //$('#destination4').attr('disabled', 'disabled');
                }else{
                    $('#destination4').removeAttr('disabled', 'disabled');
                    $('#destination4').load('models/dependents.php?option4=' + $('#option4').val());
                }
            });
            $('#option5').on('change', function(){            
                if($('#option5').val() == ""){
                    $('#destination5').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination5');
                    //$('#destination5').attr('disabled', 'disabled');
                }else{
                    $('#destination5').removeAttr('disabled', 'disabled');
                    $('#destination5').load('models/dependents.php?option5=' + $('#option5').val());
                }
            }); 
            $('#option6').on('change', function(){            
                if($('#option6').val() == ""){
                    $('#destination6').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination6');
                    //$('#destination6').attr('disabled', 'disabled');
                }else{
                    $('#destination6').removeAttr('disabled', 'disabled');
                    $('#destination6').load('models/dependents.php?option6=' + $('#option6').val());
                }
            });
            $('#option7').on('change', function(){            
                if($('#option7').val() == ""){
                    $('#destination7').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination7');
                    //$('#destination7').attr('disabled', 'disabled');
                }else{
                    $('#destination7').removeAttr('disabled', 'disabled');
                    $('#destination7').load('models/dependents.php?option7=' + $('#option7').val());
                }
            }); 
            $('#option8').on('change', function(){            
                if($('#option8').val() == ""){
                    $('#destination8').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination8');
                    //$('#destination8').attr('disabled', 'disabled');
                }else{
                    $('#destination8').removeAttr('disabled', 'disabled');
                    $('#destination8').load('models/dependents.php?option8=' + $('#option8').val());
                }
            });
            $('#option9').on('change', function(){            
                if($('#option9').val() == ""){
                    $('#destination9').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination9');
                    //$('#destination9').attr('disabled', 'disabled');
                }else{
                    $('#destination9').removeAttr('disabled', 'disabled');
                    $('#destination9').load('models/dependents.php?option9=' + $('#option9').val());
                }
            }); 
            $('#option10').on('change', function(){            
                if($('#option10').val() == ""){
                    $('#destination10').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination10');
                    //$('#destination10').attr('disabled', 'disabled');
                }else{
                    $('#destination10').removeAttr('disabled', 'disabled');
                    $('#destination10').load('models/dependents.php?option10=' + $('#option10').val());
                }
            });
            $('#option11').on('change', function(){            
                if($('#option11').val() == ""){
                    $('#destination11').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination11');
                    //$('#destination11').attr('disabled', 'disabled');
                }else{
                    $('#destination11').removeAttr('disabled', 'disabled');
                    $('#destination11').load('models/dependents.php?option11=' + $('#option11').val());
                }
            }); 
            $('#option12').on('change', function(){            
                if($('#option12').val() == ""){
                    $('#destination12').empty();
                    $('<option value = "">Seleccione Destino.</option>').appendTo('#destination12');
                    //$('#destination12').attr('disabled', 'disabled');
                }else{
                    $('#destination12').removeAttr('disabled', 'disabled');
                    $('#destination12').load('models/dependents.php?option12=' + $('#option12').val());
                }
            }); 
    </script>