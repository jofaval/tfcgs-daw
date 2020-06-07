<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["webcomponents/UserSearchInput.js", "js/profile.js"];?>
<?php $title = "Perfil";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Perfil";?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Profile",
        "link" => Config::$EXECUTION_HOME_PATH . "profile/",
        "active" => true,
        "icon" => "user",
    ],
];
?>

<?php
if (!$viewParams["editable"]) {
    $breadcrumb[count($breadcrumb) - 1]["active"] = false;
    $breadcrumb[] = [
        "name" => $viewParams["profile"]["username"],
        "link" => Config::$EXECUTION_HOME_PATH . "profile/" . $viewParams["profile"]["username"] . "/",
        "active" => true,
        "icon" => "user",
    ];
    $title .= " de " . $viewParams["profile"]["username"];
}
?>

<?php ob_start()?>

<?php $tabName = Utils::getCleanedData("tabName");?>

<div class="container-fluid my-3">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 mb-4 pr-sm-0">
                <!-- col-sm-4 -->
                <div class="searchUserProfileContainer mb-sm-3 ml-auto px-3 py-1 bg-white rounded-0 shadow">
                    <!-- <form action="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/" id="searchUserProfileForm" class="p-3 bg-white rounded shadow">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1" type="text" id="username" name="username"
                                placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="input-group-text btn btn-sm btn-primary m-0" id="basic-text1"><i
                                        class="fa fa-search text-white" aria-hidden="true"></i>&nbsp;Buscar</button>
                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="card card-cascade narrower shadow-none rounded-0">
                    <?php if ($viewParams["editable"]): ?>
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Editar Imagen</h5>
                    </div>
                    <?php endif;?>
                    <div class="card-body card-body-cascade text-center rounded-0">
                        <img src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/users/<?php echo $viewParams["profile"]["username"]; ?>/<?php echo $viewParams["profile"]["username"]; ?>.png"
                            width="200" alt="User Photo" class="z-depth-1 mb-3 mx-auto">
                        <p class="imUsername mb-0 font-weight-bold">
                            <?php echo $viewParams["profile"]["username"]; ?>
                        </p>
                        <?php if ($viewParams["editable"]): ?>
                        <div class="row flex-center">
                            <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/change-image/"
                                class="btn btn-primary btn-sm btn-sm waves-effect waves-light"><span><i
                                        class="fa fa-upload"></i></span> Subir
                                foto</a><br>
                            <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/reset-profile-image/"
                                class="btn btn-danger btn-sm btn-sm waves-effect waves-light"><span><i
                                        class="fa fa-trash"></i></span> Eliminar imagen de perfil</a>
                            <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/reset-background-image/"
                                class="btn btn-danger btn-sm btn-sm waves-effect waves-light"><span><i
                                        class="fa fa-trash"></i></span> Eliminar imagen de fondo</a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <?php if ($viewParams["editable"]): ?>
                <div class="card card-cascade my-3 narrower shadow-none">
                    <div class="row flex-center my-3">
                        <!-- <button class="btn btn-danger btn-sm waves-effect waves-light">Deshabilitar
                            cuenta</button> -->
                        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>signout/"
                            class="btn btn-danger btn-sm waves-effect waves-light">
                            <span><i class="fa fa-sign-out"></i></span> Cerrar sesión</a>
                        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/<?php echo $username ?>/"
                            class="btn btn-primary btn-sm waves-effect waves-light"><span><i
                                    class="fa fa-eye"></i></span> Ver
                            público</a>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="col-lg-8 mb-4">
                <?php if (!$viewParams["editable"]): ?>
                <img class="profileBackgroundImage w-100 d-none d-sm-block" height="300"
                    src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/users/<?php echo $username; ?>/bg-<?php echo $username; ?>.png"
                    alt="">
                <?php endif;?>
                <div class="card card-cascade narrower shadow-none">
                    <?php if ($viewParams["editable"]): ?>
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Editar Cuenta</h5>
                    </div>
                    <div class="btn-group m-0 p-0 w-100">
                        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/"
                            class="btn btn-info shadow-none">Cambiar datos generales</a>
                        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/change-pass/"
                            class="btn btn-info shadow-none">Cambiar contraseña</a>
                        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/change-image/"
                            class="btn btn-info shadow-none">Cambiar imagen</a>
                    </div>
                    <?php endif;?>
                    <?php switch ($tabName) {
    case 'pass':
        require_once SystemPaths::SERVER_PROFILE_PATH . "/pass.php";
        break;
    case 'image':
        require_once SystemPaths::SERVER_PROFILE_PATH . "/image.php";
        break;
    default:
        require_once SystemPaths::SERVER_PROFILE_PATH . "/general.php";
        break;
}?>

                </div>
            </div>
        </div>
    </section>
</div>

<?php if (isset($viewParams["error"])) {
    echo $viewParams["error"];
}?>

<?php $contenido = ob_get_clean()?>
<!-- SystemPaths::SERVER_TEMPLATES_PATH . '/ -->

<?php include_once SystemPaths::SERVER_TEMPLATES_PATH . '/layout.php'?>