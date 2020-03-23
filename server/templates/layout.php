<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<head>
    <title>Origin - <?php echo $title; ?></title>
    <link rel="icon" href="https://www.mclibre.org/consultar/htmlcss/varios/favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <style>
    /*Avoid flashing the user with white background*/
    html,
    body {
        background: #1f1f22 !important;
    }
    </style>
    <?php foreach (Config::$mvc_vis_css as $css_link): ?>
    <link rel="stylesheet" type="text/css" href="/daw/styles/<?php echo $css_link ?>" />
    <?php endforeach;?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php foreach ($optionalCSS as $css_link): ?>
    <link rel="stylesheet" type="text/css" href="/daw/styles/<?php echo $css_link ?>" />
    <?php endforeach;?>
    <link rel="stylesheet" type="text/css" href="/daw/styles/grid.php?
    showHeader=<?php echo $showHeader ? "1" : "0"; ?>&showBreadcrumb=<?php echo $showBreadcrumb ? "1" : "0"; ?>
    &showFooter=<?php echo $showFooter ? "1" : "0"; ?>">
</head>

<body class="text-light">
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

        <img class="navbar-brand rounded-circle mr-2" width="45" src="<?php echo $sessions->getSession("userImg"); ?>">
        <small class="text-muted"><span class="font-weight-bold"><?php echo $sessions->getSession("username"); ?></span>
            <br>
            <?php echo $sessions->getSession("roleName"); ?>
        </small>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08"
            style="transition: all 0.2s ease-in-out 0s;">
            <ul class="navbar-nav" style="transition: all 0.2s ease-in-out 0s;">
                <li class="nav-item active" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link" href="/daw/projects/"
                        style="transition: all 0.2s ease-in-out 0s;">Schedules<span class="sr-only"
                            style="transition: all 0.2s ease-in-out 0s;">(current)</span></a>
                </li>
                <li class="nav-item" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link selected" href="/daw/projects/"
                        style="transition: all 0.2s ease-in-out 0s;">Projects</a>
                </li>
                <li class="nav-item" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link selected" href="/daw/admin/"
                        style="transition: all 0.2s ease-in-out 0s;">Admin</a>
                </li>
                <li class="nav-item" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link" href="/daw/signout/" style="transition: all 0.2s ease-in-out 0s;">Signout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php endif;?>
    <?php if ($showBreadcrumb): ?>
    <section class="w-100 breadcrumbContainer" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 rounded-0">
            <?php foreach ($breadcrumb as $elem): ?>
            <li class="breadcrumb-item"><a class="<?php if ($elem["active"]) {
    echo "text-muted";
}
?>" href="<?php echo $elem["link"]; ?>"><?php echo $elem["name"]; ?></a></li>
            <?php endforeach;?>
        </ol>
    </section>
    <?php endif;?>
    <main role="main" class="w-100 h-100 d-flex flex-column justify-content-start <?php echo $mainClasses; ?>">
        <div id="content" class="w-100 h-100 d-flex">
            <?php echo $contenido ?>
        </div>
    </main>

    <?php if ($showFooter): ?>
    <footer class="footer py-3 bg-light d-none d-sm-block">
        <div class="container text-align-right">
            <span class="text-dark">- Developed by <a class="font-weight-bold text-dark"
                    href="jofaval@iesabastos.org">Pepe
                    Fabra Valverde</a>
                &copy; <span id="currentYear"></span>
                -</span>
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