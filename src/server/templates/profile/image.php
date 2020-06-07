<?php if ($viewParams["editable"]): ?>
<?php $breadcrumb[count($breadcrumb) - 1]["active"] = false;?>
<?php $breadcrumb[] = [
    "name" => "Imagen",
    "link" => Config::$EXECUTION_HOME_PATH . "profile/change-image",
    "active" => true,
    "icon" => "image",
];?>
<?php $title .= " - Imagen";?>
<?php $currentPage = "Perfil";?>
<?php endif;?>

<div class="card-body card-body-cascade bg-white text-center mt-3">
    <form class="" action="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/change-image/" method="POST"
        enctype="multipart/form-data">
        <h1 class="text-left">Imagen de perfil</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="profileImage">Elegir una imagen</span>
                    </div>
                    <div class="custom-file text-left">
                        <input type="file" required="" class="custom-file-input" name="profileImage" id="profileImage"
                            aria-describedby="profileImage" accept=".gif,.jpg,.jpeg,.png">
                        <label class="custom-file-label" for="profileImage">image.png</label>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($viewParams["editable"]): ?>
        <div class="row">
            <div class="col-md-12 text-center my-4">
                <span class="waves-input-wrapper waves-effect waves-light"><input type="submit"
                        value="Cambiar imagen de perfil" name="updateProfileImage" id="updateProfileImage"
                        class="btn btn-primary btn-rounded"></span>
            </div>
        </div>
        <?php endif;?>
    </form>
    <form class="" action="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/change-image/" method="POST"
        enctype="multipart/form-data">
        <h1 class="text-left">Imagen de fondo</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="bgImageCaption">Elegir una imagen</span>
                    </div>
                    <div class="custom-file text-left">
                        <input type="file" required="" class="custom-file-input" name="bgImage" id="bgImage"
                            aria-describedby="bgImageCaption" accept=".gif,.jpg,.jpeg,.png">
                        <label class="custom-file-label" for="bgImage">image.png</label>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($viewParams["editable"]): ?>
        <div class="row">
            <div class="col-md-12 text-center my-4">
                <span class="waves-input-wrapper waves-effect waves-light"><input type="submit"
                        value="Cambiar imagen de fondo" name="updateBackgroundImage" id="updateBackgroundImage"
                        class="btn btn-primary btn-rounded"></span>
            </div>
        </div>
        <?php endif;?>
    </form>
</div>