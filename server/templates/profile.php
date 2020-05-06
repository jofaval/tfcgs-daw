<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/script.js"];?>
<?php $title = "Perfil";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Profile",
        "link" => "/daw/profile/",
        "active" => true,
        "icon" => "user",
    ],
];
?>

<?php ob_start()?>

<?php $tabName = Utils::getCleanedData("tabName");?>

<div class="container-fluid my-3">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card card-cascade narrower shadow-none">
                    <?php if ($viewParams["editable"]): ?>
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Editar Imagen</h5>
                    </div>
                    <?php endif;?>
                    <div class="card-body card-body-cascade text-center">
                        <img src="/daw/img/users/<?php echo $viewParams["profile"]["username"]; ?>/<?php echo $viewParams["profile"]["username"]; ?>.png"
                            width="200" alt="User Photo" class="z-depth-1 mb-3 mx-auto">
                        <?php if ($viewParams["editable"]): ?>
                        <div class="row flex-center">
                            <button class="btn btn-primary btn-rounded btn-sm waves-effect waves-light">Subir
                                foto</button><br>
                            <button class="btn btn-danger btn-rounded btn-sm waves-effect waves-light">Eliminar</button>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <?php if ($viewParams["editable"]): ?>
                <div class="card card-cascade my-3 narrower shadow-none">
                    <div class="row flex-center my-3">
                        <!-- <button class="btn btn-danger btn-rounded waves-effect waves-light">Deshabilitar
                            cuenta</button> -->
                        <a href="/daw/signout/" class="btn btn-danger btn-rounded waves-effect waves-light">Cerrar
                            sesión</a>
                    </div>
                </div>
                <?php endif;?>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card card-cascade narrower shadow-none">
                    <?php if ($viewParams["editable"]): ?>
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Editar Cuenta</h5>
                    </div>
                    <div class="row btn-group m-0 p-0 w-100">
                        <a href="/daw/profile/" class="btn btn-info shadow-none">Cambiar datos generales</a>
                        <a href="/daw/profile/change-pass/" class="btn btn-info shadow-none">Cambiar contraseña</a>
                        <a href="" class="btn btn-info shadow-none">Cambiar imagen</a>
                    </div>
                    <?php endif;?>
                    <?php switch ($tabName) {
    case 'pass':
        require_once __DIR__ . "/profile/pass.php";
        break;

    default:
        require_once __DIR__ . "/profile/general.php";
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

<?php include_once 'layout.php'?>