<!--Page configuration-->
<?php $optionalCSS = [
    "datatables.min.css",
    "datatables-select.min.css",
    "mini-event-calendar.min.css",
    "floating-labels.css",
    "inputs.css",
];?>

<?php $optionalScripts = [
    "libs/popper.min.js",
    "libs/mdb.min.js",
    "libs/datatables.min.js",
    "libs/datatables-select.min.js",
    "libs/mini-event-calendar.js",
    "js/calendar-controls.js",
    "js/MVCAdmin.js",
];?>
<?php $title = "Admin";?>
<?php $mainClasses = "col-12 col-md-10 px-md-0 offset-md-1 h-0 h-75";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<style>
div.col-sm-12 {
    overflow: auto;
}

a.page-link {
    color: #ececec !important;
}

a.page-link:hover {
    color: #ececec !important;
}
</style>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>