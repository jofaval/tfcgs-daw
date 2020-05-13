<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html class="overflow-hidden w-100 h-100">
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php require_once __DIR__ . "/components/headProject.php"?>

<body class="text-light overflow-hidden">
    <?php require_once __DIR__ . "/components/loader.php";?>
    <?php require_once __DIR__ . "/components/noscript.php";?>
    <?php if ($showHeader):
    require_once __DIR__ . "/components/header.php";
endif;?>
    <?php if ($showBreadcrumb): require_once __DIR__ . "/components/breadcrum.php";endif;?>
    <main role="main"
        class="w-100 d-flex flex-column d-none justify-content-start overflow-auto <?php echo $mainClasses; ?>">
        <div id="content" class="w-100 w-100 d-flex">
            <?php echo $contenido ?>
        </div>
        <?php require_once __DIR__ . "/components/backToTop.php";?>
    </main>
    <?php if ($showFooter): require_once __DIR__ . "/components/footerProject.php";endif;?>
    <?php require_once __DIR__ . "/components/loader.php";?>
</body>

<?php foreach (Config::$mvc_vis_scripts as $script_link): ?>
<script src="/daw/scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src="/daw/scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>

</html>