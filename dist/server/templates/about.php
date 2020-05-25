<!--Page configuration-->
<?php $optionalCSS = ["about.css"];?>
<?php $optionalScripts = ["js/about.js"];?>
<?php $title = "About";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Acerca de ",
        "link" => Config::$EXECUTION_HOME_PATH . "about/",
        "active" => true,
        "icon" => "info",
    ],
];
?>

<?php ob_start()?>

<div class="d-flex w-100 h-100 overflow-auto m-0 p-0 text-white flex-wrap flex-column">
    <div class="topSpace my-5">&nbsp;</div>
    <div id="page1" class="w-100 h-100 col-sm-12 overflow-auto page page1 m-0 center-elements flex-column">
        <div class="container text-center">
            <h1>Te damos la bienvenida a <span class="font-weight-bold">Origen</span></h1>
            <p>Usa las flechas del teclado para navegar</p>
        </div>
    </div>
    <div id="page2" class="w-100 h-100 col-sm-12 overflow-auto page page2 m-0 center-elements flex-column">
        <div class="container text-center">
            <img src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/branding/logo.png" class="mb-3" width="250"
                height="250" alt="">
            <h1>¿Qué es origen?</h1>
            <h4>Se pretende proporcionar una gestión básica de cualquier tipo de proyecto con un conjunto de
                herramientas
                unificadas en una única plataforma de modo que todo sea más intuitivo y práctico.
            </h4>
        </div>
    </div>
    <div id="page3" class="w-100 h-100 col-sm-12 overflow-auto page page3 m-0 center-elements flex-column">
        <div class="container text-center">
            <h2>Nuestros precios</h2>
            <section class="pricing py-5">
                <div class="container">
                    <div class="row text-dark">
                        <!-- Free Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-danger text-uppercase text-center">Gratis</h5>
                                    <h6 class="card-price text-center">€ 0<span class="period">/mes</span></h6>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Página de perfil</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Búsqueda de perfiles
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Creación de proyecto
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Acceso al tablón de
                                            anuncios</li>
                                        <li class="text-left text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Gestión de proyectos</li>
                                        <li class="text-left text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Acceso al tablero</li>
                                        <li class="text-left text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Invita a colaboradores a tu proyecto
                                        </li>
                                        <li class="text-left text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Gestiona a los colaboradores</li>
                                    </ul>
                                    <a href="#" class="btn btn-block btn-danger text-uppercase">Elegir</a>
                                </div>
                            </div>
                        </div>
                        <!-- Plus Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-primary text-uppercase text-center">Intermedio</h5>
                                    <h6 class="card-price text-center">€ 9<span class="period">/mes</span></h6>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Página de
                                            perfil</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Búsqueda de perfiles
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Creación de proyecto
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Acceso al tablón de
                                            anuncios</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Gestión de
                                            proyectos</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Acceso al
                                            tablero</li>
                                        <li class="text-left text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Invita a colaboradores a tu proyecto
                                        </li>
                                        <li class="text-left text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Gestiona a los colaboradores</li>
                                    </ul>
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Elegir</a>
                                </div>
                            </div>
                        </div>
                        <!-- Pro Tier -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-success text-uppercase text-center">Profesional</h5>
                                    <h6 class="card-price text-center">€ 49<span class="period">/mes</span></h6>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Página de perfil</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Búsqueda de perfiles
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Creación de proyecto
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Acceso al tablón de
                                            anuncios</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Gestión de
                                            proyectos</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Acceso al
                                            tablero</li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Invita a
                                            colaboradores a tu proyecto
                                        </li>
                                        <li class="text-left"><span class="fa-li"><i
                                                    class="fa fa-check"></i></span>Gestiona a
                                            los colaboradores</li>
                                    </ul>
                                    <a href="#" class="btn btn-block btn-success text-uppercase">Elegir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div id="page4" class="w-100 h-100 col-sm-12 overflow-auto page page4 m-0 center-elements flex-column">
        <div class="container text-center">
            <h1>Nuestro equipo</h1>
            <div class="row">
                <div class="col-md">
                    <a href="" class="collaboratorCard text-dark px-0 row col-12 m-2 mx-auto bg-white">
                        <img src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/default.png" alt=""
                            class="collaboratorImg object-fit-cover w-100 z-index" height="400">
                        <div
                            class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
                            <h5
                                class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                                Pepe Fabra Valverde</h5>
                        </div>
                        <p
                            class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
                            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
                        </p>
                    </a>
                </div>
                <div class="col-md">
                    <a href="" class="collaboratorCard text-dark px-0 row col-12 m-2 mx-auto bg-white">
                        <img src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/default.png" alt=""
                            class="collaboratorImg object-fit-cover w-100 z-index" height="400">
                        <div
                            class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
                            <h5
                                class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                                Pepe Fabra Valverde</h5>
                        </div>
                        <p
                            class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
                            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
                        </p>
                    </a>
                </div>
                <div class="col-md">
                    <a href="" class="collaboratorCard text-dark px-0 row col-12 m-2 mx-auto bg-white">
                        <img src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/default.png" alt=""
                            class="collaboratorImg object-fit-cover w-100 z-index" height="400">
                        <div
                            class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
                            <h5
                                class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                                Pepe Fabra Valverde</h5>
                        </div>
                        <p
                            class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
                            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="page5" class="w-100 h-100 col-sm-12 overflow-auto page page5 m-0 center-elements flex-column">
        <div class="container text-center">
            <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>" class="btn btn-lg btn-primary">Comenzar</a>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>