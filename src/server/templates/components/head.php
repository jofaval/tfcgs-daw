<?php header('Content-Type: text/html; charset=utf-8');?>

<head>
    <title>Origen - <?php echo $title; ?></title>
    <link rel="shortcut icon" href="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/branding/favicon-16x16.png"
        type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/branding/favicon-32x32.png"
        type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/branding/favicon-96x96.png"
        type="image/x-icon">
    <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <style>
    /*Avoid flashing the user with white background*/
    html,
    body {
        background: #1f1f22 !important;
    }
    </style>
    <?php foreach (Config::$mvc_vis_css as $css_link): ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo Config::$EXECUTION_HOME_PATH; ?>styles/<?php echo $css_link ?>" />
    <?php endforeach;?>
    <?php if (Config::$allowExternalResources != 0): ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php endif;?>
    <?php foreach ($optionalCSS as $css_link): ?>
    <link rel="stylesheet" type="text/css"
        href="<?php echo Config::$EXECUTION_HOME_PATH; ?>styles/<?php echo $css_link ?>" />
    <?php endforeach;?>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::$EXECUTION_HOME_PATH; ?>styles/grid.php?
        showHeader=<?php echo $showHeader ? "1" : "0"; ?>&showBreadcrumb=<?php echo $showBreadcrumb ? "1" : "0"; ?>
        &showFooter=<?php echo $showFooter ? "1" : "0"; ?>">
</head>