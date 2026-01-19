<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>SETCRM 5 - Login</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <link rel="shortcut icon" href="./assets/images/favicon.ico">

        <!-- Fonts and icons -->
        <script src="./assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {"families": ["Lato:300,400,700,900"]},
                custom: {"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['./assets/css/fonts.min.css']},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!-- CSS Files -->
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/atlantis.css">
        <link rel="stylesheet" href="./assets/css/login.css">
    </head>
    <body class="login">
        <form action="?controller=security&method=login" method="POST">
            <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
                <div class="card card0 border-0">
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <div class="card1 pb-5">
                                <div class="row"> <img src="./assets/images/logo-inverse.png" class="logo"> </div>
                                <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="./assets/images/login/call1.png" class="image"> </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card2 card border-0 px-4 py-5">
                                <div class="row mb-4 px-3">
                                    <h1 class="mb-0 mr-4 mt-2">Bienvenido a <b><span style="color:#B59B77;">SET</span><span style="color:#0E6CFF;">CRM</span> v5</b></h1>
                                </div>
                                <div class="row mb-4 px-3">
                                    <h6 class="mb-0 mr-4 mt-2">Ingrese los datos de autenticación</h6>
                                </div>
                                <div class="row px-3 mb-4">
                                    <div class="line"></div> <small class="or text-center"></small>
                                    <div class="line"></div>
                                </div>
                                <?php if (isset($_SESSION['flash']['message'])) { ?>
                                <div class="mbg-3 alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close btn-xs" data-dismiss="alert">
                                            <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    <span class="pr-2">
                                        <i class="fa fa-check"></i>
                                    </span>
                                    <?php
                                        echo $_SESSION['flash']['message'];
                                        unset($_SESSION['flash']);
                                    ?>
                                </div>
                                <?php } ?>
                                <div class="row px-3">
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Email o Usuario</h6>
                                    </label>
                                    <input type="text" id="email" name="email" placeholder="Digite su Email o Usuario" required> 
                                </div>
                                <div class="row px-3"> 
                                    <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Password</h6>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" placeholder="Digite su contraseña" required> 
                                        <div class="input-group-append show-password">
                                                <i class="icon-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row px-3"> <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Extensión</h6>
                                    </label> <input type="text" id="exten" name="exten" placeholder="Digite su Extensión telefónica" required> 
                                </div>
                                <div class="row px-3 mb-4">
                                    <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Recordarme</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Recuperar Contraseña</a>
                                </div>
                                <div class="row mb-3 px-3"><input type="submit" value="Ingresar" class="btn btn-primary col-md-5 float-right mt-3 mt-sm-0 fw-bold"></div>

                            </div>
                        </div>
                    </div>
                    <div class="bg-blue py-4">
                        <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; <?= date('Y'); ?>. <a class="link" href="https://www.setcolombia.com" target="_blank">SETCOLOMBIA SAS</a></small>
                            <div class="social-contact ml-4 ml-sm-auto"> <span class="mr-4 text-sm"><a class="link" href="https://www.setcolombia.com" target="_blank"><i class="fas fa-home"></i></a></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script src="./assets/js/core/jquery.3.2.1.min.js"></script>
        <script src="./assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="./assets/js/core/popper.min.js"></script>
        <script src="./assets/js/core/bootstrap.min.js"></script>
        <script src="./assets/js/atlantis.min.js"></script>
    </body>
</html>