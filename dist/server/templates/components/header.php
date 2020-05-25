<?php
$header = [
    /* "Origen" => [
    "link" => Config::$EXECUTION_HOME_PATH . "",
    "active" => $title == "Home",
    "icon" => "home",
    "access" => 0,
    ], */
    "Perfil" => [
        "link" => Config::$EXECUTION_HOME_PATH . "profile/",
        "active" => $currentPage == "Perfil",
        "icon" => "user",
        "access" => 0,
    ],
    "Proyectos" => [
        "link" => Config::$EXECUTION_HOME_PATH . "projects/",
        "active" => $currentPage == "Proyectos",
        "icon" => "folder",
        "access" => 0,
    ],
    "Acerca de" => [
        "link" => Config::$EXECUTION_HOME_PATH . "about/",
        "active" => $currentPage == "About",
        "icon" => "info",
        "access" => 0,
    ],
    "Admin" => [
        "link" => Config::$EXECUTION_HOME_PATH . "admin/",
        "active" => $currentPage == "Admin",
        "icon" => "cogs",
        "access" => Config::$ACCESS_LEVEL_ADMIN,
    ],
]
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light flex-wrap" style="transition: all 0.2s ease-in-out 0s;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
        aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation"
        style="transition: all 0.2s ease-in-out 0s;">
        <span class="navbar-toggler-icon" style="transition: all 0.2s ease-in-out 0s;"></span>
    </button>

    <div class="btn-group">
        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/" class="">
            <img class="navbar-brand order-1 rounded-circle" width="45"
                src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/users/<?php echo $username; ?>/<?php echo $username; ?>.png">
            <small class="text-muted"><span class="font-weight-bold"><?php echo $username ?></span>
                <br>
                <?php echo $sessions->getSession("roleName"); ?>
            </small>
        </a>
        <div class="d-none d-sm-block">
            <button type="button" class="btn btn-sm text-primary shadow-none h-100 my-auto dropdown-toggle px-1"
                data-toggle="dropdown" aria-haspopup="true" id="signinFormBtnDropdown" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu ml-5 tabContentContainer bg-dark">
                <form action="<?php echo Config::$EXECUTION_HOME_PATH; ?>signin/" method="POST" id="registerForm"
                    class="col-md m-0 p-01 rounded d-flex align-items-center justify-content-center flex-column h-100 text-center">
                    <div class="md-form my-3 w-100">
                        <input type="text" class="form-control text-white" autocomplete="off" autocorrect="off"
                            autocapitalize="off" spellcheck="false" id="username" name="username" required>
                        <label class="text-white" for="username">Usuario</label>
                    </div>
                    <div class="md-form my-3 input-group w-100">
                        <input type="password" class="form-control text-white" id="password" name="password" required>
                        <label class="text-white" for="password">Contraseña</label>
                        <div class="input-group-append">
                            <a class="btn btn-primary btn-sm input-group-text md-addon shadow-none togglePassword">
                                <i class="fa fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    <div class="md-form my-3 col-12">
                        <input type="submit" class="btn btn-primary w-100" value="Iniciar sesión" id="signin"
                            name="signin" required>
                    </div>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item btn btn-sm h6 bg-dark text-white shadow-none text-capitalize text-white m-0"
                    href="<?php echo Config::$EXECUTION_HOME_PATH; ?>signout/"
                    style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-sign-out"></i></span>
                    Cerrar
                    sesión</a>
            </div>
        </div>
    </div>
    <div class="collapse navbar-collapse order-3 order-sm-1 justify-content-md-center" id="navbarsExample08"
        style="transition: all 0.2s ease-in-out 0s;">
        <ul class="navbar-nav" style="transition: all 0.2s ease-in-out 0s;">
            <li class="nav-item " style="transition: all 0.2s ease-in-out 0s;">
                <a class="nav-link btn btn-sm h6 btn-primary shadow-none text-capitalize text-white"
                    href="<?php echo Config::$EXECUTION_HOME_PATH; ?>" style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-home"></i></span>
                    Origen</a>
            </li>
            <?php $access = Sessions::getInstance()->getSession("access");?>
            <?php foreach ($header as $headerTitle => $headerParams): ?>
            <?php if ($access >= $headerParams["access"]): ?>
            <li class="nav-item d-flex <?php echo $headerParams["active"] ? "active" : "" ?>"
                style="transition: all 0.2s ease-in-out 0s;">
                <a class="nav-link col-sm align-self-center selected" href="<?php echo $headerParams["link"]; ?>"
                    style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-<?php echo $headerParams["icon"]; ?>"></i></span>
                    <?php echo $headerTitle; ?>
                    <?php if ($headerParams["active"]): ?>
                    <span class="sr-only" style="transition: all 0.2s ease-in-out 0s;">(current)</span>
                    <?php endif;?>
                </a>
            </li>
            <?php endif;?>
            <?php endforeach;?>
            <li class="nav-item " style="transition: all 0.2s ease-in-out 0s;">
                <a class="nav-link btn btn-sm h6 btn-danger shadow-none text-capitalize text-white"
                    href="<?php echo Config::$EXECUTION_HOME_PATH; ?>signout/"
                    style="transition: all 0.2s ease-in-out 0s;">
                    <span><i class="fa fa-sign-out"></i></span>
                    Cerrar
                    sesión</a>
            </li>
        </ul>
    </div>
    <!-- <div class="custom-control mx-2 order-2 order-sm-3 custom-switch cursor-pointer">
        <input type="checkbox" class="custom-control-input cursor-pointer" id="nightMode" checked>
        <label class="custom-control-label text-muted cursor-pointer" for="nightMode">Modo oscuro</label>
    </div> -->
</nav>