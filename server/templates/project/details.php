<?php $projectData = $viewParams["projectData"];?>
<?php $canEdit = Sessions::getInstance()->getSession("access") >= Config::$ACCESS_LEVEL_ADMIN;?>
<div class="w-100 h-100 tabContent container p-0 d-block" id="tabContent5">
    <div class="content px-5">
        <form method="POST" action="/daw/projects/id/<?php echo $viewParams["id"] ?>/details/">
            <div class="text-white mt-5 h5">Project title</div>
            <div class="md-form mb-5">
                <input class="form-control text-white font-weight-bold h3" <?php echo !$canEdit ? 'disabled=""' : ''; ?>
                    name="projectTitle" id="projectTitle" value="<?php echo $projectData["projectTitle"]; ?>" />
                <label for="projectTitle"></label>
            </div>
            <div class="text-white h5">Project description</div>
            <div class="md-form mb-5 mt-0">
                <textarea id="projectDescription" name="projectDescription"
                    class="md-textarea form-control text-white p-0" <?php echo !$canEdit ? 'disabled=""' : ''; ?>
                    rows="3"><?php echo $projectData["projectDescription"]; ?></textarea>
                <label for="projectDescription" class="d-none">Material textarea</label>
            </div>
            <?php if ($canEdit): ?>
            <div class="row mx-auto flex-center">
                <button class="btn btn-primary" name="changeProjectDetails" value="true" type="submit">Cambiar
                    detalles</button>
            </div>
            <?php endif;?>
        </form>
        <?php if ($canEdit): ?>
        <form class="" action="/daw/projects/id/<?php echo $viewParams["id"] ?>/details/" method="POST"
            enctype="multipart/form-data">
            <h1 class="text-left text-white">Imagen de perfil</h1>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="profileImageCaption">Elegir una imagen</span>
                        </div>
                        <div class="custom-file text-left">
                            <input type="file" required="" class="custom-file-input" name="profileImage"
                                id="profileImage" aria-describedby="profileImageCaption" accept=".gif,.jpg,.jpeg,.png">
                            <label class="custom-file-label" for="profileImage">image.png</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mx-auto flex-center">
                <button class="btn btn-primary" name="changeProjectProfileImage" type="submit"><span><i
                            class="fa fa-upload"></i></span> Cambiar imagen de
                    perfil</button>
            </div>
        </form>
        <form class="" action="/daw/projects/id/<?php echo $viewParams["id"] ?>/details/" method="POST"
            enctype="multipart/form-data">
            <h1 class="text-left text-white">Imagen de fondo</h1>
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
            <div class="row mx-auto flex-center">
                <button class="btn btn-primary" name="changeProjectBGImage" type="submit"><span><i
                            class="fa fa-upload"></i></span> Cambiar imagen de
                    fondo</button>
            </div>
        </form>
        <?php endif;?>
        <div class="projectCreationDetails mb-5 text-muted">
            <?php if (!is_null($projectData["collaborator"])): ?>
            <div class="float-right text-right">
                Te invitó <a href="/daw/profile/<?php echo $projectData["collaboratorInviteUsername"]; ?>/"
                    class="projectCreatedBy"><?php echo $projectData["collaboratorInviteName"]; ?></a>
                <br> el <span
                    class="projectCreationDate"><?php echo $projectData["collaborationStartingDate"]; ?></span> como
                <span
                    class="projectCreationRole informationText font-weight-bold"><?php echo $projectData["collaborationRole"]; ?></span>
                <div class="informationTextQuote text-left text-white p-3 position-absolute rounded">
                    <?php echo $projectData["collaborationRoleDescription"]; ?>
                </div>
            </div>
            <?php endif;?>
            <div>Creador por <a href="/daw/profile/<?php echo $projectData["projectCreatorUsername"]; ?>/"
                    class="projectCreatedBy"><?php echo $projectData["projectCreator"]; ?></a>
                <br> el <span class="projectCreationDate"><?php echo $projectData["projectCreationDate"]; ?></span>
            </div>
        </div>
        <div class="row mx-auto flex-center">

        </div>
    </div>
</div>