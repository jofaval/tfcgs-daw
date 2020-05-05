<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css", "project.css"];?>
<?php $optionalScripts = [/* "js/ProjectManagementMvc.js" */];?>
<?php $title = $viewParams["title"];?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Your projects",
        "link" => "/daw/projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => "/daw/projects/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
    ],
];
?>

<?php ob_start()?>

<!--form>(.md-form>.form-control+label)+input:submit.btn.btn-primary{Añadir ruta}-->
<form action="/daw/index.php?ctl=addNewRoute"
    class="p-5 m-auto bg-white d-flex align-items-center justify-content-center flex-column">
    <h1>Añadir ruta</h1>
    <div class="md-form">
        <input class="form-control" type="text" name="routeName" id="routeName">
        <label for="routeName">Nombre de la ruta</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="isView">
        <label class="custom-control-label" for="isView">Es una vista</label>
    </div>
    <input type="submit" value="Añadir ruta" class="btn btn-primary">
</form>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>