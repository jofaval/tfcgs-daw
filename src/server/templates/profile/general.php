<?php if ($viewParams["editable"]): ?>
<?php $breadcrumb[count($breadcrumb) - 1]["active"] = false;?>
<?php $breadcrumb[] = [
    "name" => "General",
    "link" => Config::$EXECUTION_HOME_PATH . "profile/",
    "active" => true,
    "icon" => "edit",
];?>
<?php $title .= " - General";?>
<?php $currentPage = "Perfil";?>
<?php endif;?>

<div class="card-body card-body-cascade text-center mt-3 bg-white">
    <form class="" action="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input type="text" <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?> name="username"
                        id="username"
                        class="form-control my-1 text-white <?php echo $viewParams['editable'] ? 'validate' : ''; ?>"
                        value="<?php echo $viewParams["profile"]["username"]; ?>">
                    <label for="username"
                        <?php if ($viewParams["editable"]): echo 'data-error="Erróneo" data-success="Correcto"';endif;?>>Usuario</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input type="text" <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?> name="website"
                        id="website"
                        class="form-control my-1 text-white <?php echo $viewParams['editable'] ? 'validate' : ''; ?>"
                        value="<?php echo $viewParams["profile"]["website"]; ?>">
                    <label for="website"
                        <?php if ($viewParams["editable"]): echo 'data-error="Erróneo" data-success="Correcto"';endif;?>>Sitio
                        web</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input type="text" <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?> name="name"
                        id="name"
                        class="form-control my-1 text-white <?php echo $viewParams['editable'] ? 'validate' : ''; ?>"
                        value="<?php echo $viewParams["profile"]["name"]; ?>">
                    <label for="name"
                        <?php if ($viewParams["editable"]): echo 'data-error="Erróneo" data-success="Correcto"';endif;?>>Nombre</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input type="text" <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?> name="surname"
                        id="surname"
                        class="form-control my-1 text-white <?php echo $viewParams['editable'] ? 'validate' : ''; ?>"
                        value="<?php echo $viewParams["profile"]["surname"]; ?>">
                    <label for="surname"
                        <?php if ($viewParams["editable"]): echo 'data-error="Erróneo" data-success="Correcto"';endif;?>>Apellidos</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="md-form mb-0">
                    <input type="email" <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?> name="email"
                        id="email"
                        class="form-control my-1 text-white <?php echo $viewParams['editable'] ? 'validate' : ''; ?>"
                        value="<?php echo $viewParams["profile"]["email"]; ?>">
                    <label for="email"
                        <?php if ($viewParams["editable"]): echo 'data-error="Erróneo" data-success="Correcto"';endif;?>>Correo
                        electrónico</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="md-form mb-0">
                    <textarea type="text" <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?>
                        name="biography" id="biography"
                        class="md-textarea form-control text-white <?php echo $viewParams['editable'] ? 'validate' : ''; ?>"
                        rows="3"><?php echo $viewParams["profile"]["biography"]; ?></textarea>
                    <label for="biography"
                        <?php if ($viewParams["editable"]): echo 'data-error="Erróneo" data-success="Correcto"';endif;?>>Biografía
                        (corta)</label>
                </div>
            </div>
        </div>
        <?php if ($viewParams["editable"]): ?>
        <div class="row">
            <div class="col-md-12 text-center my-4">
                <span class="waves-input-wrapper waves-effect waves-light"><input type="submit" value="Cambiar datos"
                        name="updateProfile" id="updateProfile" class="btn btn-primary btn-rounded"></span>
            </div>
        </div>
        <?php endif;?>
    </form>
</div>