<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html scroll="no" class="overflow-hidden w-100 h-100" style="max-width: 100% !important; max-height: 100% !important;">
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php require_once __DIR__ . "/../components/headProject.php"?>

<body scroll="no" class="text-light position-fixed w-100 h-100 overflow-hidden"
    style="max-width: 100% !important; max-height: 100% !important;">
    <?php require_once __DIR__ . "/../components/loader.php";?>
    <?php require_once __DIR__ . "/../components/noscript.php";?>
    <?php if ($showHeader):
    require_once __DIR__ . "/../components/header.php";
endif;?>
    <?php if ($showBreadcrumb): require_once __DIR__ . "/../components/breadcrum.php";endif;?>
    <main role="main"
        class="w-100 d-flex flex-column d-none justify-content-start overflow-auto <?php echo $mainClasses; ?>">
        <div id="content" class="w-100 w-100 d-flex">
            <?php echo $contenido ?>
        </div>
        <?php require_once __DIR__ . "/../components/backToTop.php";?>
    </main>
    <?php if ($showFooter): require_once __DIR__ . "/../components/footerProject.php";endif;?>
    <?php require_once __DIR__ . "/../components/loader.php";?>
</body>

<?php foreach (Config::$mvc_vis_scripts as $script_link): ?>
<<<<<<< HEAD
<script src="<?php echo Config::$EXECUTION_HOME_PATH; ?>scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src="<?php echo Config::$EXECUTION_HOME_PATH; ?>scripts/<?php echo $script_link ?>"></script>
=======
<script src=<?php echo Config::$EXECUTION_HOME_PATH; ?>"scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src=<?php echo Config::$EXECUTION_HOME_PATH; ?>"scripts/<?php echo $script_link ?>"></script>
>>>>>>> 3581ba16a411ff959f27583d19bf9007ad75c058
<?php endforeach;?>

</html>