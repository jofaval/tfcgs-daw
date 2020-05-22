<?php if ($viewParams["editable"]): ?>
<?php $breadcrumb[count($breadcrumb) - 1]["active"] = false;?>
<?php $breadcrumb[] = [
    "name" => "Contraseña",
    "link" => Config::$EXECUTION_HOME_PATH . "profile/change-pass/",
    "active" => true,
    "icon" => "key",
];?>
<?php $title .= " - Contraseña";?>
<?php $currentPage = "Perfil";?>
<?php endif;?>

<div class="card-body card-body-cascade text-center mt-3">
<<<<<<< HEAD
    <form class="" action="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/change-pass/" method="POST">
=======
    <form class="" action=<?php echo Config::$EXECUTION_HOME_PATH; ?>"profile/change-pass/" method="POST">
>>>>>>> 3581ba16a411ff959f27583d19bf9007ad75c058
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="md-form mb-0">
                    <input type="password" required name="oldPassword" id="oldPassword" class="form-control validate">
                    <label for="oldPassword" data-error="wrong" data-success="right">Contraseña anterior</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="md-form mb-0">
                    <input type="password" required name="password" id="password" class="form-control validate">
                    <label for="password" data-error="wrong" data-success="right">Contraseña</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="md-form mb-0">
                    <input type="password" required name="repeatPassword" id="repeatPassword"
                        class="form-control validate">
                    <label for="repeatPassword" data-error="wrong" data-success="right">Repetir Contraseña</label>
                </div>
            </div>
        </div>
        <?php if ($viewParams["editable"]): ?>
        <div class="row">
            <div class="col-md-12 text-center my-4">
                <span class="waves-input-wrapper waves-effect waves-light"><input type="submit"
                        value="Cambiar contraseña" name="updatePassword" id="updatePassword"
                        class="btn btn-primary btn-rounded"></span>
            </div>
        </div>
        <?php endif;?>
    </form>
</div>