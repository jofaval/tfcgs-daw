<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css"];?>
<?php $optionalScripts = [];?>
<?php $title = $viewParams["title"] . " | Tablero - " . $viewParams["dashboardTitle"];?>
<?php $mainClasses = "h-100";?>
<?php $showFooter = false;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/client/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Tus proyectos",
        "link" => "/daw/client/projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
    ],
    [
        "name" => "Tableros",
        "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/dashboards/",
        "active" => false,
        "icon" => "columns",
    ],
    [
        "name" => $viewParams["dashboardTitle"],
        "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/dashboards/" . $viewParams["dashboardTitle"] . "/",
        "active" => false,
        "icon" => "columns",
    ],
    [
        "name" => "Fondo",
        "link" => "/daw/client/projects/id/" . $viewParams["id"] . "/dashboards/" . $viewParams["dashboardTitle"] . "/change-image",
        "active" => true,
        "icon" => "image",
    ],
];
?>

<?php ob_start()?>

<div class="container bg-white p-5 my-sm-5 mx-auto">
    <div class="card-body card-body-cascade text-center mt-3">
        <form class=""
            action="/daw/client/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?>/change-image/"
            method="POST" enctype="multipart/form-data">
            <h1 class="text-ceneter">Imagen de fondo</h1>
            <div class="d-none d-sm-flex flex-column my-3">
                <img width="640" height="360" class="mx-auto"
                    src="/daw/client/img/projects/<?php echo $viewParams["id"]; ?>/dashboards/<?php echo $viewParams["dashboardTitle"]; ?>/bg.png"
                    alt="">
                <h4>Imagen actual</h4>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="bgImageCaption">Elegir una imagen</span>
                        </div>
                        <div class="custom-file text-left">
                            <input type="file" required="" class="custom-file-input" name="bgImage" id="bgImage"
                                aria-describedby="bgImageCaption" accept=".gif,.jpg,.jpeg,.png">
                            <label class="custom-file-label" for="bgImage">image.png</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center my-4">
                    <span class="waves-input-wrapper waves-effect waves-light"><input type="submit"
                            value="Cambiar imagen de fondo" name="updateBackgroundImage" id="updateBackgroundImage"
                            class="btn btn-primary btn-rounded"></span>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layoutProject.php'?>