<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "summernote-bs4.min.css", "agenda.css"];?>
<?php $optionalScripts = ["libs/summernote-bs4.min.js", "js/agenda.js"];?>
<?php $title = "ProjectName - Agenda";?>
<?php $mainClasses = "h-100";?>
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
        "name" => "Tus proyectos",
        "link" => "/daw/projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => "./project/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
    ],
    [
        "name" => $viewParams["elementName"],
        "link" => "./project/id/name/diary/",
        "active" => true,
        "icon" => "book",
    ],
];
?>

<?php ob_start()?>

<div class="mx-auto container">
    <div class="form-row d-flex my-4">
        <div class="col-sm-3 rounded order-0 mb-2 order-sm-2 bg-white shadow mx-1">
            <div class="md-form m-0">
                <input placeholder="Select a date" type="text" id="datepicker" class="form-control datepicker">
            </div>
        </div>
        <button class="btn btn-sm order-2 order-sm-1 text-white ml-auto">&lt;</button>
        <button class="btn btn-sm order-3 text-white mr-auto">&gt;</button>
    </div>
    <div id="summernote"></div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>