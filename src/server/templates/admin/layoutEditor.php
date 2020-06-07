<!--Page configuration-->
<?php $optionalCSS = ["summernote-bs4.min.css"];?>
<?php $optionalScripts = ["libs/summernote-bs4.min.js", "js/admin/layoutEditor.js"];?>
<?php $title = "Editor de templates";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Admin",
        "link" => Config::$EXECUTION_HOME_PATH . "admin/",
        "active" => true,
        "icon" => "cogs",
    ],
    [
        "name" => "Editor de templates",
        "link" => Config::$EXECUTION_HOME_PATH . "admin/layoutEditor/",
        "active" => true,
        "icon" => "edit",
    ],
];
?>
<?php $currentPage = "Admin";?>

<?php ob_start()?>

<div class="mx-auto bg-dark grey overflow-y-auto row m-0 p-0 darken-3 p-5 w-100 pb-5">
    <div class="col-sm-4 col-md-3 optionPanel mb-3">
        <div class="optionalCSS">
            <h3 class="text-white">optionalCSS</h3>
            <table class="table  table-responsive-md table-dark btn-table">
                <thead>
                    <th colspan="2">Nombre archivo</th>
                    <th>Acciones</th>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="2">libs/summernote-bs4.min.js</td>
                        <td class="center-elements btn-group">
                            <button type="button" class="btn btn-warning btn-sm m-0">Modificar</button>
                            <button type="button" class="btn btn-danger btn-sm m-0">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="addInputContainer">
                <div class="md-form m-0 mt-4 mb-3">
                    <input type="text" name="name" id="name" class="form-control">
                    <label for="name">Nombre</label>
                </div>
                <div class="w-100 center-elements">
                    <div class="btn btn-sm btn-success text-dark">Añadir</div>
                </div>
            </div>
        </div>
        <div class="optionalJS">
            <h3 class="text-white">optionalJS</h3>
            <table class="table  table-responsive-md table-dark btn-table">
                <thead>
                    <th colspan="2">Nombre archivo</th>
                    <th>Acciones</th>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="2">Larry</td>
                        <td class="center-elements btn-group">
                            <button type="button" class="btn btn-warning btn-sm m-0">Modificar</button>
                            <button type="button" class="btn btn-danger btn-sm m-0">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="addInputContainer">
                <div class="md-form m-0 mt-4 mb-3">
                    <input type="text" name="name" id="name" class="form-control">
                    <label for="name">Nombre</label>
                </div>
                <div class="w-100 center-elements">
                    <div class="btn btn-sm btn-success text-dark">Añadir</div>
                </div>
            </div>
        </div>
        <div class="toggleVisbilityOptions col-12 mb-3 p-0">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="showFooter">
                <label class="custom-control-label text-white" for="showFooter">showFooter</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="showHeader">
                <label class="custom-control-label text-white" for="showHeader">showHeader</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="showBreadcrumb">
                <label class="custom-control-label text-white" for="showBreadcrumb">showBreadcrumb</label>
            </div>
        </div>
        <div class="breadcrumbForm">
            <h3 class="text-white">Breadcrumb</h3>
            <div>
                <div class="col-12 p-0">
                    <div class="md-form m-0 mb-3">
                        <input type="text" name="name" id="name" class="form-control">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="md-form m-0 mb-3">
                        <input type="text" name="link" id="link" class="form-control">
                        <label for="link">Enlace</label>
                    </div>
                    <div class="custom-control custom-switch m-0 mb-3">
                        <input type="checkbox" class="custom-control-input" id="active">
                        <label class="custom-control-label text-white" for="active">Activo</label>
                    </div>
                    <div class="md-form m-0 mb-3">
                        <input type="text" name="icon" id="icon" class="form-control">
                        <label for="icon">Icono</label>
                    </div>
                    <div class="w-100 center-elements">
                        <div class="btn-group mx-auto p-0">
                            <div class="btn btn-sm m-0 btn-primary">Añadir</div>
                            <div class="btn btn-sm m-0 btn-warning">Modificar</div>
                            <div class="btn btn-sm m-0 btn-danger">Eliminar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col mb-5">
        <form action="" method="POST" class="text-center">
            <select class="browser-default custom-select" name="templateName" id="templateName">
                <?php foreach ($viewParams["files"] as $fileGroupName => $fileGroup): ?>
                <optgroup label="<?php echo $fileGroupName ?>">
                    <?php foreach ($fileGroup as $fileName): ?>
                    <?php $startPos = strrpos($fileName, "\\")?>
                    <?php $parsedFileName = substr($fileName, $startPos !== false ? $startPos + 1 : 0)?>
                    <option value="<?php echo $fileName; ?>"><?php echo $parsedFileName; ?></option>
                    <?php endforeach;?>
                </optgroup>
                <?php endforeach;?>
            </select>
            <input type="submit" class="btn btn-primary m-3" value="Cargar contenido del fichero" name="loadFileContent"
                id="loadFileContent">
        </form>
        <div class="fileContent"></div>
        <div id="summernote"><?php echo $viewParams["fileContent"] ?></div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once SystemPaths::SERVER_TEMPLATES_PATH . '/layout.php'?>