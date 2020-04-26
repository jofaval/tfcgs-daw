<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
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
<?php $tabName = $viewParams["tabName"];?>
<?php $projectData = $viewParams["projectData"];?>

<?php ob_start()?>

<ul id="projectDiaryNavigationScheme" class="position-absolute d-none z-index-overlap bg-light shadow">

</ul>
<div class="w-100 p-0">
    <div class="row py-5 projectHeader m-0">
        <div class="projectImageContainer">
            <img class="projectImage mx-5" src="/daw/img/profile-pic.png" alt="" width="200">
        </div>
        <div class="display-none display-sm-block projectDetails text-white col">
            <h1 class="projectTitle font-weight-bold"><?php echo $projectData["projectTitle"]; ?></h1>
            <p class="projectCreatedBy mb-2">creado por <a href="<?php echo $projectData["projectCreatorUsername"]; ?>"
                    id="projectCreator"
                    class="font-weight-bold text-white"><?php echo $projectData["projectCreator"]; ?></a></p>
            <p class="description"><?php echo $projectData["projectDescription"]; ?></p>
            <a href="" class="">
                Change project information...<span><i class="fa fa-pencil"></i></span>
            </a>
        </div>
    </div>
    <div class="row tabs shadow w-100 m-0 grey darken-2 text-white">
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/overview/"
            class="tab p-3 text-white <?php echo $tabName == "overview" ? "active" : ""; ?>">General</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/"
            class="tab p-3 text-white <?php echo $tabName == "dashboards" ? "active" : ""; ?>">Tableros</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/diary/"
            class="tab p-3 text-white <?php echo $tabName == "diary" ? "active" : ""; ?>">Diario</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/collaborators/"
            class="tab p-3 text-white <?php echo $tabName == "collaborators" ? "active" : ""; ?>">Colaboradores</a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/details/"
            class="tab p-3 text-white <?php echo $tabName == "details" ? "active" : ""; ?>">Detalles</a>
    </div>
    <div class="row grey darken-3 m-0 px-2">
        <?php
if (in_array($tabName, $tabNames)) {
    require_once __DIR__ . "/project/$tabName.php";
}
switch ($tabName) {
    case "dashboards":
        $optionalScripts[] = "js/ProjectDashboardMvc.js";
        require_once __DIR__ . "/project/$tabName.php";
        break;
    case "diary":
        $optionalScripts[] = "js/ProjectDiaryMvc.js";
        require_once __DIR__ . "/project/$tabName.php";
        break;
    case "collaborators":
        $optionalScripts[] = "js/ProjectCollaboratorsMvc.js";
        require_once __DIR__ . "/project/$tabName.php";
        break;
    case "details":
        break;
    case "overview":
    default:
        $optionalScripts[] = "js/ProjectOverviewMvc.js";
        require_once __DIR__ . "/project/overview.php";
        break;
}
?>
    </div>
</div>
</div>


<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>