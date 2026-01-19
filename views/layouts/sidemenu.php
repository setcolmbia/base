        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="./assets/images/avatars/10.jpg" alt="..." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    <?= $_SESSION['user']->name; ?>
                                    <span class="user-level"><?= $_SESSION['user']->company; ?></span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#">
                                            <span class="link-collapse">Perfil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="link-collapse">Mensajes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="link-collapse">Configuración</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item <?php echo ($_GET['controller']=='index' ? 'active submenu' : '');?>">
                            <a href="?controller=index">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Agentes</h4>
                        </li>
                        <li class="nav-item">
                            <a href="?controller=agent&method=screen">
                                <i class="fas fa-headset"></i>
                                <p>Pantalla de Agente</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Gestión</h4>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='contact' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#contact">
                                <i class="fas fa-user-tag"></i>
                                <p>Contactos</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='contact' ? 'show' : '');?>" id="contact">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='contact'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=contact">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='contact'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=contact&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='report' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#report">
                                <i class="fas fa-chart-line"></i>
                                <p>Reportes</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='contact' ? 'report' : '');?>" id="report">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='report'&&$_GET['method']=='inboudStats' ? 'class="active"' : '');?>>
                                        <a href="?controller=report&method=inboudStats">
                                            <span class="sub-item">Estadísticas Entrada</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='report'&&$_GET['method']=='outboudStats' ? 'class="active"' : '');?>>
                                        <a href="?controller=contact&method=outboudStats">
                                            <span class="sub-item">Estadísticas Salida</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='monitor' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#monitor">
                                <i class="fas fa-stopwatch"></i>
                                <p>Monitoreo</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='monitor' ? 'show' : '');?>" id="monitor">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='monitor'&&$_GET['method']=='panel' ? 'class="active"' : '');?>>
                                        <a href="?controller=contact&method=panel">
                                            <span class="sub-item">Panel de Agentes</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='monitor'&&$_GET['method']=='qstate' ? 'class="active"' : '');?>>
                                        <a href="?controller=contact&method=qstate">
                                            <span class="sub-item">Estado de Colas</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Administración</h4>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='sip' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#sipt">
                                <i class="fas fa fa-phone"></i>
                                <p>Extensiones SIP</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='sip' ? 'show' : '');?>" id="sipt">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='sip'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=sip">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='sip'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=sip&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='iax' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#iaxt">
                                <i class="fas fa fa-phone"></i>
                                <p>Extensiones IAX2</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='iax' ? 'show' : '');?>" id="iaxt">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='iax'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=iax">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='iax'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=iax&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul> 
                            </div>       
                        </li>
                         
                        <li class="nav-item <?php echo ($_GET['controller']=='agent' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#agentt">
                                <i class="fas fa-user-circle"></i>
                                <p> Agentes Telefónicos</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='agent' ? 'show' : '');?>" id="agentt">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='agent'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=agent">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='agent'&&($_GET['method']=='create') ? 'class="active"' : '');?>>
                                        <a href="?controller=agent&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='queues' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#queuest">
                                <i class="fas fa-random"></i>
                                <p>  ACD</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='queues' ? 'show' : '');?>" id="queuest">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='queues'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=queues">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='siptrunk' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#siptrunk">
                                <i class="fas fa fa-road"></i>
                                <p>Troncales SIP</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='siptrunk' ? 'show' : '');?>" id="siptrunk">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='siptrunk'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=siptrunk">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='siptrunk'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=siptrunk&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='recordings' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#recordings">
                                <i class="fas fa-music"></i>
                                <p>Audios</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='recordings' ? 'show' : '');?>" id="recordings">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='recordings'&&$_GET['method']=='list' ? 'class="active"' : '');?>>
                                        <a href="?controller=recordings&method=list">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='recordings'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=recordings">
                                            <span class="sub-item">Buscar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='recordings'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=recordings&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>                            
                        </li>

                        <li class="nav-item <?php echo ($_GET['controller']=='shortcodes' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#shortcodest">
                                <i class="fas fa-random"></i>
                                <p> Códigos Abreviados </p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='shortcodes' ? 'show' : '');?>" id="shortcodest">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='shortcodes'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=shortcodes">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='outboundroute' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#outboundroute">
                                <i class="fas fa-route"></i>
                                <p>  Rutas de Salida </p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='outboundroute' ? 'show' : '');?>" id="outboundroute">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='outboundroute'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=outboundroute">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='outboundroute'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=outboundroute&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='inboundroutes' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#inboundroutest">
                                <i class="fas fa-list-alt"></i>
                                <p>  Rutas de Entrada </p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='inboundroutes' ? 'show' : '');?>" id="inboundroutest">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='inboundroutes'&&$_GET['method']=='list' ? 'class="active"' : '');?>>
                                        <a href="?controller=inboundroutes&method=list">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='inboundroutes'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=inboundroutes&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item <?php echo ($_GET['controller']=='timerules' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#timerulest">
                            <i class="far fa-clock"></i>
                                <p>   Horarios </p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='timerules' ? 'show' : '');?>" id="timerulest">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='timerules'&&$_GET['method']=='list' ? 'class="active"' : '');?>>
                                        <a href="?controller=timerules&method=list">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='timerules'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=timerules&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='form' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#form">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Formularios</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='form' ? 'show' : '');?>" id="form">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='form'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=form">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='form'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=form&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='ivrs' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#ivrs">
                            <i class="far fa-list-alt"></i>
                                <p>    Diseño de IVRs </p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='ivrs' ? 'show' : '');?>" id="ivrs">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='ivrs'&&$_GET['method']=='list' ? 'class="active"' : '');?>>
                                        <a href="?controller=ivrs&method=list">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='ivrs'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=ivrs&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>                            
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='preview' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#preview">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Marcador Preview</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='preview' ? 'show' : '');?>" id="preview">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='preview'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=preview">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                    <li <?php echo ($_GET['controller']=='preview'&&$_GET['method']=='create' ? 'class="active"' : '');?>>
                                        <a href="?controller=preview&method=create">
                                            <span class="sub-item">Crear</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item <?php echo ($_GET['controller']=='user' ? 'active submenu' : '');?>">
                            <a data-toggle="collapse" href="#usert">
                                <i class="fas fa-users"></i>
                                <p>Usuarios</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse <?php echo ($_GET['controller']=='user' ? 'show' : '');?>" id="usert">
                                <ul class="nav nav-collapse">
                                    <li <?php echo ($_GET['controller']=='user'&&($_GET['method']=='index'||$_GET['method']=='') ? 'class="active"' : '');?>>
                                        <a href="?controller=user">
                                            <span class="sub-item">Listar</span>
                                        </a>
                                    </li>
                                   
                                </ul>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>