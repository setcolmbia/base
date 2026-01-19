                            <div class="card">
                                <div class="card-header">
                                    <h3>Lista de Formularios</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                            <table id="tabla-loader" class="display table table-striped table-hover" >
                                                <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Activo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach(parent::allActive() as $form):  ?>
                                                    <tr>
                                                        <td><?= $form->name ?></td>
                                                        <td><?= $form->description ?></td>
                                                        <td><?php echo ($form->active==1)?"SI":"NO"; ?></td>
                                                        <td width="200" class="table__options">
                                                            <a href="?controller=form&method=showForm&id=<?= $form->id ?>" data-toggle="tooltip" title="Abrir Formulario" data-placement="bottom" class="btn btn-primary btn-sm"><i class="fa fa-file-alt"></i> Tipificar</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Descripción</th>
                                                    <th>Activo</th>
                                                    <th>Acciones</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                </div>
                            </div>