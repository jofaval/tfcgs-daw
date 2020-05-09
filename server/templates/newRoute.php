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
        "name" => "Vuelta a la principal",
        "link" => "/daw/",
        "active" => true,
        "icon" => "home",
    ],
];
?>

<?php ob_start()?>

<!--form>(.md-form>.form-control+label)+input:submit.btn.btn-primary{Añadir ruta}-->
<form action="/daw/index.php?ctl=addNewRoute" method="POST"
    class="p-5 m-auto bg-white d-flex align-items-center justify-content-center flex-column">
    <h1>Añadir ruta</h1>
    <div class="md-form">
        <input class="form-control" type="text" name="routeName" id="routeName">
        <label for="routeName">Nombre de la ruta</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="isView" id="isView">
        <label class="custom-control-label" for="isView">Es una vista</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="friendlyURL" id="friendlyURL">
        <label class="custom-control-label" for="friendlyURL">Añadir enlace amigable</label>
    </div>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="addToModel" id="addToModel">
        <label class="custom-control-label" for="addToModel">Añadir al model</label>
    </div>
    <input type="submit" value="Añadir ruta" name="addRoute" class="btn btn-primary">
</form>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>