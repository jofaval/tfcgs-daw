<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
<?php $optionalScripts = ["js/ProjectManagementMvc.js"];?>
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

<div class="container">
    <h1>Gantt diagram</h1>
    <div class="w-100 d-flex">
        <div class="btn btn-primary w-75 mx-auto">Go to gantt diagram</div>
    </div>
    <br>
    <h1>Task lists</h1>
    <div class="d-flex flex-wrap flex-row w-100">
        <div class="card mx-2" style="width: 12.5rem !important;">
            <div class="card-body">
                <div class="card-title">Task list</div>
                <div class="card-text"></div>
            </div>
        </div>
        <div class="card mx-2" style="width: 12.5rem !important;">
            <div class="card-body">
                <div class="card-title">Task list</div>
                <div class="card-text"></div>
            </div>
        </div>
        <div class="card mx-2" style="width: 12.5rem !important;">
            <div class="card-body">
                <div class="card-title">Task list</div>
                <div class="card-text"></div>
            </div>
        </div>
        <div class="card mx-2" style="width: 12.5rem !important;">
            <div class="card-body">
                <div class="card-title">Task list</div>
                <div class="card-text"></div>
            </div>
        </div>
        <div class="card mx-2" style="width: 12.5rem !important;">
            <div class="card-body">
                <div class="card-title">Task list</div>
                <div class="card-text"></div>
            </div>
        </div>
    </div>
    <br>
    <h1>Diary</h1>
    <div class="w-100 d-flex">
        <div class="btn btn-primary w-75 mx-auto">Go to agenda</div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>