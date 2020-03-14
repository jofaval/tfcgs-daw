<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "summernote-bs4.min.css", "agenda.css"];?>
<?php $optionalScripts = ["js/agenda.js"];?>
<?php $title = "ProjectName - Agenda";?>
<?php $mainClasses = "h-100";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<div class="mx-auto container">
    <div class="form-row d-flex my-4">
        <button class="btn btn-sm text-white ml-auto">&lt;</button>
        <div class="col-sm-3 rounded bg-white shadow mx-1">
            <div class="md-form m-0">
                <input placeholder="Select a date" type="text" id="datepicker" class="form-control datepicker">
            </div>
        </div>
        <button class="btn btn-sm text-white mr-auto">&gt;</button>
    </div>
    <div id="summernote"></div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>