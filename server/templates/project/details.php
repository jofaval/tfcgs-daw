<?php $projectData = $viewParams["projectData"];?>
<div class="w-100 h-100 tabContent d-block" id="tabContent5">
    <div class="content px-5">
        <div class="text-white mt-5 h5">Project title</div>
        <div class="text-white font-weight-bold mb-5 h3"><?php echo $projectData["projectTitle"]; ?></div>
        <div class="text-white h5">Project description</div>
        <div class="md-form mb-5 mt-0">
            <textarea id="form7" class="md-textarea form-control text-white p-0" disabled
                rows="3"><?php echo $projectData["projectDescription"]; ?></textarea>
            <label for="form7" class="d-none">Material textarea</label>
        </div>
        <div class="projectCreationDetails mb-5 text-muted">
            <?php if (!is_null($projectData["collaborator"])): ?>
            <div class="float-right text-right">
                Te invitó <a href="/daw/profile/<?php echo $projectData["collaboratorInviteUsername"]; ?>/"
                    class="projectCreatedBy"><?php echo $projectData["collaboratorInviteName"]; ?></a>
                <br> el <span
                    class="projectCreationDate"><?php echo $projectData["collaborationStartingDate"]; ?></span> como
                <span
                    class="projectCreationRole informationText font-weight-bold"><?php echo $projectData["collaborationRole"]; ?></span>
                <div class="informationTextQuote text-white p-3 position-absolute rounded">
                    <?php echo $projectData["collaborationRoleDescription"]; ?>
                </div>
            </div>
            <?php endif;?>
            <div>Creador por <a href="/daw/profile/<?php echo $projectData["projectCreatorUsername"]; ?>/"
                    class="projectCreatedBy"><?php echo $projectData["projectCreator"]; ?></a>
                <br> el <span class="projectCreationDate"><?php echo $projectData["projectCreationDate"]; ?></span>
            </div>
        </div>
    </div>
</div>