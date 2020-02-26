<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
    /*Avoid flashing the user with white background*/
    html,
    body {
        background: #1f1f22 !important;
    }
    </style>
    <?php foreach (Config::$mvc_vis_css as $css_link): ?>
    <link rel="stylesheet" type="text/css" href="./styles/<?php echo $css_link ?>" />
    <?php endforeach;?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php foreach ($optionalCSS as $css_link): ?>
    <link rel="stylesheet" type="text/css" href="./styles/<?php echo $css_link ?>" />
    <?php endforeach;?>

</head>

<body class="text-light">

    <?php if ($showHeader): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="transition: all 0.2s ease-in-out 0s;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
            aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation"
            style="transition: all 0.2s ease-in-out 0s;">
            <span class="navbar-toggler-icon" style="transition: all 0.2s ease-in-out 0s;"></span>
        </button>

        <img class="navbar-brand rounded-circle mr-2" width="45" src="<?php echo $sessions->getSession("userImg"); ?>">
        <small class="text-muted"><?php echo $username; ?></small>
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08"
            style="transition: all 0.2s ease-in-out 0s;">
            <ul class="navbar-nav" style="transition: all 0.2s ease-in-out 0s;">
                <li class="nav-item active" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link" href="index.php?ctl=calendar"
                        style="transition: all 0.2s ease-in-out 0s;">Schedules<span class="sr-only"
                            style="transition: all 0.2s ease-in-out 0s;">(current)</span></a>
                </li>
                <li class="nav-item" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link selected" href="index.php?ctl=classrooms"
                        style="transition: all 0.2s ease-in-out 0s;">Classrooms</a>
                </li>
                <?php if ($sessions->getSession("access") >= 2): ?>
                <li class="nav-item" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link selected" href="index.php?ctl=admin"
                        style="transition: all 0.2s ease-in-out 0s;">Admin</a>
                </li>
                <?php endif;?>
                <li class="nav-item" style="transition: all 0.2s ease-in-out 0s;">
                    <a class="nav-link" href="index.php?ctl=signout"
                        style="transition: all 0.2s ease-in-out 0s;">Signout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php endif;?>
    <?php if ($showBreadcrumb): ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <?php foreach ($breadcrumb as $elem): ?>
            <li class="breadcrumb-item"><a href="<?php echo $value; ?>"><?php echo $key; ?></a></li>
            <?php endforeach;?>
        </ol>
    </nav>
    <?php endif;?>
    <main role="main" class="h-100 w-100 d-flex flex-column justify-content-center <?php echo $mainClasses; ?>">
        <!--div class="flex-column row my-auto bg-dark"-->
        <?php echo $contenido ?>
        <!--/div-->
    </main>

    <?php if ($showFooter): ?>
    <footer class="footer fixed-bottom mb-3 d-none d-sm-block">
        <div class="container">
            <span class="text-muted float-right">- Developed by <a href="jofaval@iesabastos.org">Pepe Fabra Valverde</a>
                &copy;
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
<script src="./scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>
<?php foreach ($optionalScripts as $script_link): ?>
<script src="./scripts/<?php echo $script_link ?>"></script>
<?php endforeach;?>

</html>