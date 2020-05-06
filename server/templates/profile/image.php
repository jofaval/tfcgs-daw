<div class="card-body card-body-cascade text-center mt-3">
    <form class="" action="/daw/profile/change-image/" method="POST">
        <h1 class="text-left">Imagen de perfil</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Elegir una imagen</span>
                    </div>
                    <div class="custom-file text-left">
                        <input type="file" class="custom-file-input" name="image" id="image"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="image">image.png</label>
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
    <form class="" action="/daw/profile/change-image/" method="POST">
        <h1 class="text-left">Imagen de fondo</h1>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Elegir una imagen</span>
                    </div>
                    <div class="custom-file text-left">
                        <input type="file" class="custom-file-input" name="image" id="image"
                            aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="image">image.png</label>
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