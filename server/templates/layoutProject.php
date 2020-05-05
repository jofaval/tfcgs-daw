<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php require_once __DIR__ . "/components/head.php"?>

<body class="text-light overflow-hidden">
    <noscript class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center" id="noScript">
        <div class="main m-5 p-5 w-75 h-75 rounded shadow bg-white d-flex justify-content-center align-items-center">
            <h1>Para el correcto funcionamiento de esta aplicación se <span class="font-weight-bold">JavaScript</span>.
                <br>Sentimos las molestias</h1>
        </div>
    </noscript>
    <?php if ($showHeader): ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light flex-wrap" style="transition: all 0.2s ease-in-out 0s;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
            aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation"
            style="transition: all 0.2s ease-in-out 0s;">
            <span class="navbar-toggler-icon" style="transition: all 0.2s ease-in-out 0s;"></span>
        </button>

        <img class="navbar-brand rounded-circle mr-2" width="45"
            src="/daw/img/users/<?php echo $username; ?>/<?php echo $username; ?>.png">
        <small class="text-muted"><span class="font-weight-bold"><?php echo $username ?></span>
            <br>
            <?php echo $sessions->getSession("roleName"); ?>
        </small>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08"
            style="transition: all 0.2s ease-in-out 0s;">
            <h1 class="text-dark"><?php echo $viewParams["title"]; ?></h1>
        </div>
    </nav>
    <?php endif;?>
    <?php if ($showBreadcrumb): require_once __DIR__ . "/components/breadcrum.php";endif;?>
    <main role="main" class="w-100 d-flex flex-column justify-content-start overflow-auto <?php echo $mainClasses; ?>">
        <div id="content" class="w-100 w-100 d-flex">
            <?php echo $contenido ?>
        </div>
        <a href="#content" id="backToTop"
            class="z-index-overlap position-absolute p-3 bg-light rounded cursor-pointer">↑</a>
    </main>

    <?php if ($showFooter): ?>
    <div></div>
    <footer class="footer py-3 bg-light z-index-overlap d-none d-sm-block">
        <div class="container text-align-right">
            <span class="text-dark">Creador por <a href="<?php echo $projectData["projectCreatorUsername"]; ?>"
                    class="projectCreatedBy text-dark font-weight-bold"><?php echo $projectData["projectCreator"]; ?></a>
                el <span
                    class="projectCreationDate text-dark font-weight-bold"><?php echo date("d-m-Y", strtotime($projectData["projectCreationDate"])); ?></span>
        </div>
    </footer>
    <?php endif;?>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
</body>

<?php foreach (Config::$mvc_vis_scripts as $script_link): ?>
<script src="/daw/scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src="/daw/scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>

</html>