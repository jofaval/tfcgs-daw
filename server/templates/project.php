<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
<?php $optionalScripts = ["js/ProjectManagementMvc.js"];?>
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
    ],
    [
        "name" => "Your projects",
        "link" => "/daw/projects/",
        "active" => false,
    ],
    [
        "name" => $viewParams["title"],
        "link" => "./project/id/" . $viewParams["id"] . "/",
        "active" => true,
    ],
];
?>
<?php $tabNames = [
    "overview",
    "dashboards",
    "diary",
    "collaborators",
    "details",
];?>

<?php ob_start()?>

<ul id="projectDiaryNavigationScheme" class="position-absolute d-none z-index-overlap bg-light shadow">

</ul>
<div class="container p-0">
    <div class="row py-5 projectHeader m-0">
        <div class="projectImageContainer col-3">
            <img class="projectImage mx-5" src="../img/profile-pic.png" alt="" width="200">
        </div>
        <div class="display-none display-sm-block projectDetails text-white col">
            <h1 class="projectTitle font-weight-bold">Origen</h1>
            <p class="projectCreatedBy mb-2">creado por <a id="projectCreator" class="font-weight-bold">Pepe Fabra
                    Valverde</a></p>
            <p class="description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Odio laudantium ipsum
                sed iusto voluptas est ratione nam sint fugiat, in dolorum adipisci, veritatis aliquam magnam
                repellendus dolorem, accusamus consequuntur corporis?</p>
            <a href="" class="">
                Change project information...<span><i class="fa fa-pencil"></i></span>
            </a>
        </div>
    </div>
    <div class="row tabs shadow w-100 m-0 grey darken-2 text-white">
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/overview/" class="tab p-3 active">General</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/" class="tab p-3">Tableros</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/diary/" class="tab p-3">Diario</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/collaborators/" class="tab p-3">Colaboradores</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/details/" class="tab p-3">Detalles</a>
    </div>
    <div class="row grey darken-3 m-0 px-2">
        <?php
$tabName = $viewParams["tabName"];
switch ($tabName) {
    case "dashboards":
    case "diary":
    case "collaborators":
    case "details":
        require_once __DIR__ . "/project/$tabName.php";
        break;
    case "overview":
    default:
        require_once __DIR__ . "/project/overview.php";
        break;
}
?>





    </div>
</div>
</div>


<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>