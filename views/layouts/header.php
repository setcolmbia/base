<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="es">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>SETCRM 5 - Calll Center Suite.</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="description" content="Gestor de MarketPlace.">
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="shortcut icon" href="./assets/images/favicon.ico">
    
    <!-- Fonts and icons -->
    <script src="./assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
            WebFont.load({
                    google: {"families":["Lato:300,400,700,900"]},
                    custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['./assets/css/fonts.min.css']},
                    active: function() {
                            sessionStorage.fonts = true;
                    }
            });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/atlantis.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link rel="stylesheet" href="./assets/css/checkboxes.css">
    <link rel="stylesheet" href="./assets/css/datepicker.css">
    <link rel="stylesheet" href="./assets/css/loaders.css">
    <link rel="stylesheet" href="./assets/css/jquery.formbuilder.css">
    <link rel="stylesheet" href="./assets/css/set.css">
    
    <!-- TinyMCE Editor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.1.2/tinymce.min.js" integrity="sha512-cJ2vUNryvHzgNJfmFTtZ2VX5EMT5JOU1i8nm+L1kwoHQ9bSqSYdswxyk++9Gi27p3BG2rXZXLMsTsluY4RZSSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.1.2/icons/default/icons.min.js" integrity="sha512-ognxPTomLSegPdHq1F54G6h6TN9M31vFN/Qb8rmq3tQMnDg0cPQjFpmFf3kBEaLyETVeGyl7jUWfTLlvLQiW/A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./assets/js/plugin/tinymce/langs/es_MX.js"></script>
    
    <!-- Jquery -->
    <script src="./assets/js/core/jquery.3.2.1.min.js"></script>
        
</head>
<body>
    <!-- <div class="wrapper sidebar_minimize"> -->
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="white">

                <a href="#" class="logo">
                    <img src="./assets/images/logo-inverse.png" width="90%" alt="MarketHub" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="white">

                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">0</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">No hay notificaciones</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="fa fa-check"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    El sistema funciona correctamente.
                                                </span>
                                                <span class="time">2020-08-17</span> 
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">Ver todo<i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fas fa-layer-group"></i>
                            </a>
                            <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                                <div class="quick-actions-header">
                                    <span class="title mb-1">Accesos Rápidos</span>
                                    <span class="subtitle op-8">Tareas Frecuentes</span>
                                </div>
                                <div class="quick-actions-scroll scrollbar-outer">
                                    <div class="quick-actions-items">
                                        <div class="row m-0">
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-file-1"></i>
                                                    <span class="text">Ver Analíticas</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-pen"></i>
                                                    <span class="text">Crear Factura</span>
                                                </div>
                                            </a>
                                            <a class="col-6 col-md-4 p-0" href="#">
                                                <div class="quick-actions-item">
                                                    <i class="flaticon-interface-1"></i>
                                                    <span class="text">Crear Producto</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <div class="avatar-sm">
                                    <img src="./assets/images/avatars/10.jpg" alt="..." class="avatar-img rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img src="./assets/images/avatars/10.jpg" alt="" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4><?= $_SESSION['user']->name; ?></h4>
                                                <p class="text-muted"><?= $_SESSION['user']->email; ?></p><!-- <a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a> -->
                                                <p class="text-muted">Extensión: <?= $_SESSION['exten']; ?></p>
                                                <p class="text-muted">Agente: <?= $_SESSION['user']->agent; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i style="color: Dodgerblue;" class="fas fa-user-cog"></i> Perfil</a>
                                        <a class="dropdown-item" href="#"><i style="color: Dodgerblue;" class="fas fas fa-envelope"></i> Mensajes</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i style="color: Dodgerblue;" class="fas fa-cog"></i> Configuración</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="?controller=security&method=logout"><i style="color: Dodgerblue;" class="fas fa-sign-out-alt"></i> Salir</a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>