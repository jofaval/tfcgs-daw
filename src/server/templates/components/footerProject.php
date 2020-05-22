<footer class="footer py-3 shadow bg-light text-dark z-index-overlap d-none d-sm-block">
    <div class="container text-align-right">
        <span class="">Creado por <a
                href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/<?php echo $projectData["projectCreatorUsername"]; ?>/"
                class="projectCreatedBy text-dark font-weight-bold"><?php echo $projectData["projectCreator"]; ?></a>
            el <span
                class="projectCreationDate font-weight-bold"><?php echo date("d-m-Y", strtotime($projectData["projectCreationDate"])); ?></span>
    </div>
</footer>