<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css", "project.css"];?>
<?php $optionalScripts = [/* "js/ProjectManagementMvc.js" */];?>
<?php $title = "Añadir ruta"?>
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
    class="p-5 m-auto bg-white col-sm-6 d-flex align-items-center justify-content-center flex-column">
    <h1>Añadir ruta</h1>
    <div class="md-form col-sm">
        <input class="form-control" autofocus="true" type="text" name="routeName" id="routeName">
        <label for="routeName">Nombre de la ruta</label>
    </div>
    <div class="form-row col-sm text-center">
        <div class="custom-control custom-checkbox col-sm">
            <input type="checkbox" class="custom-control-input" name="isView" id="isView">
            <label class="custom-control-label" for="isView">Es una vista</label>
        </div>
        <div class="custom-control custom-checkbox col-sm">
            <input type="checkbox" class="custom-control-input" name="friendlyURL" id="friendlyURL">
            <label class="custom-control-label" for="friendlyURL">Añadir enlace amigable</label>
        </div>
    </div>
    <div class="form-row col-sm text-center">
        <div class="custom-control custom-checkbox col-sm">
            <input type="checkbox" checked="true" class="custom-control-input" name="addToModel" id="addToModel">
            <label class="custom-control-label" for="addToModel">Añadir al model</label>
        </div>
        <div class="custom-control custom-checkbox col-sm">
            <input type="checkbox" checked="true" class="custom-control-input" name="addToAjax" id="addToAjax">
            <label class="custom-control-label" for="addToAjax">Añadir controlador de Ajax</label>
        </div>
    </div>
    <input type="submit" value="Añadir ruta" name="addRoute" class="btn btn-primary">
</form>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>