<footer class="footer py-3 bg-light z-index-overlap d-none d-sm-block">
    <div class="container text-align-right">
        <span class="">Creador por <a href="/daw/profile/<?php echo $projectData["projectCreatorUsername"]; ?>/"
                class="projectCreatedBy text-dark font-weight-bold"><?php echo $projectData["projectCreator"]; ?></a>
            el <span
                class="projectCreationDate text-dark font-weight-bold"><?php echo date("d-m-Y", strtotime($projectData["projectCreationDate"])); ?></span>
    </div>
</footer>