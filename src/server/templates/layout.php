<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html scroll="no" class="overflow-hidden w-100 h-100" style="max-width: 100% !important; max-height: 100% !important;">
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php require_once SystemPaths::SERVER_COMPONENTS_PATH . "/head.php"?>

<body scroll="no" class="text-light position-fixed overflow-hidden w-100 h-100"
    style="max-width: 100% !important; max-height: 100% !important;">
    <?php require_once SystemPaths::SERVER_COMPONENTS_PATH . "/loader.php";?>
    <?php require_once SystemPaths::SERVER_COMPONENTS_PATH . "/noscript.php";?>
    <?php if ($showHeader): require_once SystemPaths::SERVER_COMPONENTS_PATH . "/header.php";endif;?>
    <?php if ($showBreadcrumb): require_once SystemPaths::SERVER_COMPONENTS_PATH . "/breadcrum.php";endif;?>
    <main role="main"
        class="w-100 h-100 d-flex flex-column d-none justify-content-start overflow-auto <?php echo $mainClasses; ?>">
        <div id="content" class="w-100 h-100 d-flex">
            <?php echo $contenido ?>
        </div>
        <?php require_once SystemPaths::SERVER_COMPONENTS_PATH . "/backToTop.php";?>
    </main>
    <?php if ($showFooter): require_once SystemPaths::SERVER_COMPONENTS_PATH . "/footer.php";endif;?>
</body>

<?php foreach (Config::$mvc_vis_scripts as $script_link): ?>
<script src="<?php echo Config::$EXECUTION_HOME_PATH; ?>scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src="<?php echo Config::$EXECUTION_HOME_PATH; ?>scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>

</html>