<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
<?php $optionalScripts = ["js/projects.js"];?>
<?php $title = "Projects";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "../index.php",
        "active" => false,
    ],
    [
        "name" => "Projects",
        "link" => "",
        "active" => true,
    ],
];
?>

<?php ob_start()?>

<div class="container h-100" id="mainProjectPanel">
    <aside class="col-md-3 p-3 px-4">
        <div class="list-group list-group-flush shadow">
            <a href="#" class="list-group-item active waves-effect">
                <i class="fas fa-chart-pie mr-3"></i>Dashboard
            </a>
            <a href="#" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-user mr-3"></i>Profile</a>
            <a href="#" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-table mr-3"></i>Tables</a>
            <a href="#" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-map mr-3"></i>Maps</a>
            <a href="#" class="list-group-item list-group-item-action waves-effect">
                <i class="fas fa-money-bill-alt mr-3"></i>Orders</a>
        </div>
    </aside>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>