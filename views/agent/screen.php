            <div class="main-panel" style="width: 100%">
                <div class="content">
                    <div class="page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <!-- DIV dinamico de estado de agente y datos de llamada -->
                                    <div class="card-header" style="padding-bottom: 0;">
                                        <div id="estado"></div>
                                    </div>
                                    <!-- DIV dinamico de generacion y cuelgue de llamada -->
                                    <div>
                                        <div id="cuelgue"><iframe name="inferior" id="inferior" src="vendors/auxiliares/vacio.php" style="margin:0; width:100%; height:30px; border:none; overflow:hidden;" scrolling="no"></iframe> </div>
                                    </div>
                                    <!-- DIV con tabs de areas de trabajo -->
                                    <div class="card-body" style="padding-top:0; padding-bottom: 0;">
                                        <iframe name="tipificarFrame" id="tipificarFrame" src="vendors/auxiliares/espera.php" style="margin:0; width:100%; height:150px; border:none; overflow:hidden;" scrolling="no" onload="AdjustIframeHeightOnLoadTipificar()"></iframe>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="floatSet" onclick="switchForm()">
                        <i class="fa fa-phone floatIcon"></i>
                    </a>
                    <div class="dialer-form hiddenBlock" id="dialer">
                        <form class="form-container" name ="llamada_manual" id="llamada_manual" method="post">
                            <div>
                                <label for="numero">
                                    <i class="ace-icon fa fa-phone"></i> Número:
                                </label>

                                <div class="input-group">
                                    <input class="col-md-12" type="text" id="numero" name="numero" />
                                </div>
                            </div>

                            <div class="btn-group col-md-9 small-padding" align="center">
                                <button type="button" class="btn btn-info num">&nbsp;1</button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;2</button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;3</button>
                            </div><br />
                            <div class="btn-group col-md-9 small-padding">
                                <button type="button" class="btn btn-info num">&nbsp;4</button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;5</button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;6</button>
                            </div><br />
                            <div class="btn-group col-md-9 small-padding">
                                <button type="button" class="btn btn-info num">&nbsp;7</button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;8</button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;9</button>
                            </div><br />
                            <div class="btn-group col-md-9">
                                <button type="button" class="btn btn-danger num" style="font-size: 12px;"><p hidden>B</p><i class="fa fa-arrow-left"></i></button>&nbsp;
                                <button type="button" class="btn btn-info num">&nbsp;0</button>&nbsp;
                                <button type="reset" class="btn btn-danger" style="font-size: 12px;"><i class="fa fa-undo"></i></button>
                            </div>
                            <br /><br />
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-success" type="submit">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Llamar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </button>
                                <button class="btn btn-sm btn-danger" type="button" onclick="switchForm()">
                                    &nbsp;&nbsp;Cerrar&nbsp;&nbsp;&nbsp;
                                </button>

                            </div>

                        </form>

                    </div>
                </div>
                
                <script>
                    $(document).ready(function () {

                        //Carga el estado del agente
                        function cargarEstado() {
                            $('#estado').load('vendors/asterisk/estadoAgente.php?agente=<?php echo $_SESSION['user']->agent; ?>');
                            $('#notificaciones').load('vendors/auxiliares/notificaciones.php');
                        }

                        cargarEstado();

                        //Carga Notificaciones
                        function load_unseen_notification(view = ''){
                            $.ajax({
                                url:"vendors/auxiliares/notificaciones.php",
                                method:"POST",
                                data:{view:view},
                                dataType:"json",
                                success:function(data){
                                    $('.dropdown-menu-2').html(data.notification);
                                    if (data.unseen_notification >= 0){
                                        $('.count').html(data.unseen_notification);
                                    }else{
                                        $('.count').html('');
                                    }
                                }
                            });
                        }

                        load_unseen_notification();

                        //Refresva Divs cada 3seg.
                        setInterval(function () {
                            cargarEstado();
                        }, 3000);
                        
                        //Refresva Divs cada 5min.
                        setInterval(function () {
                            load_unseen_notification();
                        }, 300000);

                        //Para el dialpad
                        $('.num').click(function () {
                            var digito = $.trim($(this).text());
                            var numTel = $('#numero');
                            $(numTel).val(numTel.val() + digito);
                            
                            if(digito=='B'){
                                var newNumTel=numTel.val().substr(0, numTel.val().length - 2);
                                //console.log(newNumTel);
                                $(numTel).val(newNumTel);
                            }
                            
                        });

                    });
                    
                    $(function () {
                        $('#llamada_manual').on('submit', function (e) {

                            e.preventDefault();
                            
                            $.ajax({
                                type: 'post',
                                url: 'vendors/asterisk/generarLlamada.php',
                                data: $('#llamada_manual').serialize(),
                                success: function (response) {
                                    console.log(response);
                                    $('#numero').val('');
				},
                                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                    alert("Atención, no se pudo generar la llamada por mensaje de " + textStatus + ". Descripción: " + errorThrown); 
                                } 
                            });

                        });
                    });
                </script>
                
                <script type="text/javascript">
                    function AdjustIframeHeightOnLoadTipificar() {
                        height = (parseInt(document.getElementById("tipificarFrame").contentWindow.document.body.scrollHeight))*1.15;
                        //console.log(height);
                        document.getElementById("tipificarFrame").style.height = height + "px";
                    }
                    function AdjustIframeHeightTipificar(i) {
                        document.getElementById("tipificarFrame").style.height = parseInt(i) + "px";
                    }
                    function AdjustIframeHeightOnLoadVerificar() {
                        document.getElementById("verificarFrame").style.height = document.getElementById("verificarFrame").contentWindow.document.body.scrollHeight + "px";
                    }
                    function AdjustIframeHeightVerificar(i) {
                        document.getElementById("verificarFrame").style.height = parseInt(i) + "px";
                    }
                    function AdjustIframeHeightOnLoadPreview() {
                        document.getElementById("previewFrame").style.height = document.getElementById("previewFrame").contentWindow.document.body.scrollHeight + "px";
                    }
                    function AdjustIframeHeightPreview(i) {
                        document.getElementById("previewFrame").style.height = parseInt(i) + "px";
                    }
                    function CopyToClipboard(containerid){
                        if (document.selection) {
                            var range = document.body.createTextRange();
                            range.moveToElementText(document.getElementById(containerid));
                            range.select().createTextRange();
                            document.execCommand("copy");
                        } else if (window.getSelection) {
                            var range = document.createRange();
                            range.selectNode(document.getElementById(containerid));
                            window.getSelection().addRange(range);
                            document.execCommand("copy");
                            alert("ID de llamada copiado al portapapeles.");
                        }
                    }
                    
                    function switchForm() {
                        $("#dialer").toggleClass("hiddenBlock");
                    }
                </script>