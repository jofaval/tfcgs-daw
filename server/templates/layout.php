<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php require_once __DIR__ . "/components/head.php"?>

<body class="text-light overflow-hidden">
    <?php require_once __DIR__ . "/components/loader.php";?>
    <?php require_once __DIR__ . "/components/noscript.php";?>
    <?php if ($showHeader): require_once __DIR__ . "/components/header.php";endif;?>
    <?php if ($showBreadcrumb): require_once __DIR__ . "/components/breadcrum.php";endif;?>
    <main role="main"
        class="w-100 h-100 d-flex flex-column justify-content-start overflow-auto <?php echo $mainClasses; ?>">
        <div id="content" class="w-100 h-100 d-flex">
            <?php echo $contenido ?>
        </div>
        <a href="#content" id="backToTop"
            class="z-index-overlap position-absolute p-3 bg-light rounded cursor-pointer">↑</a>
    </main>

    <?php if ($showFooter): ?>
    <footer class="footer py-3 bg-light d-none d-sm-block">
        <div class="container text-align-right">
            <span class="text-dark">- Developed by <a class="font-weight-bold text-dark"
                    href="/daw/profile/jofaval2/">Pepe
                    Fabra Valverde</a>
                &copy; <span id="currentYear"></span>
                -</span>
        </div>
    </footer>
    <?php endif;?>
</body>

<?php foreach (Config::$mvc_vis_scripts as $script_link): ?>
<script src="/daw/scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src="/daw/scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>

</html>