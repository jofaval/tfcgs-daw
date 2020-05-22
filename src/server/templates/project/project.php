<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css", "project.css"];?>
<?php $optionalScripts = [/*"js/ProjectManagementMvc.js"*/"js/tabMenuInteraction.js", "webcomponents/UserSearchInput.js", "webcomponents/TimeFromMoment.js"];?>
<?php $title = $viewParams["title"];?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php $currentPage = "Proyectos";?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => Config::$EXECUTION_HOME_PATH . "",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Tus proyectos",
        "link" => Config::$EXECUTION_HOME_PATH . "projects/",
        "active" => false,
        "icon" => "folder",
    ],
    [
        "name" => $viewParams["title"],
        "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/",
        "active" => false,
        "icon" => "clipboard",
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

<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php ob_start()?>

<ul id="projectDiaryNavigationScheme" class="position-absolute d-none z-index-overlap bg-light shadow">

</ul>
<div class="w-100 p-0">
    <style>
    .projectHeader {
        background-image: url("<?php echo Config::$EXECUTION_HOME_PATH; ?>img/projects/<?php echo $viewParams["id"]; ?>/bg.png") !important;
    }
    </style>
    <div class="row py-5 projectHeader m-0 pr-sm-5">
        <div class="projectImageContainer mx-auto mx-sm-0">
            <img class="projectImage mx-sm-5 shadow"
                src="<?php echo Config::$EXECUTION_HOME_PATH; ?>img/projects/<?php echo $viewParams["id"]; ?>/profile.png"
                alt="" width="200" height="200">
        </div>
        <div class="d-none d-sm-block projectDetails bg-dark rounded text-white col">
            <h1 class="projectTitle font-weight-bold"><?php echo $projectData["projectTitle"]; ?></h1>
            <p class="projectCreatedBy mb-2">creado por <a
                    href="<?php echo Config::$EXECUTION_HOME_PATH; ?>profile/<?php echo $projectData["projectCreatorUsername"]; ?>/"
                    id="projectCreator"
                    class="font-weight-bold text-white"><?php echo $projectData["projectCreator"]; ?></a></p>

            <div class="md-form m-0 p-0">
                <textarea id="projectDescription" disabled="true"
                    class="md-textarea text-white form-control m-0 p-0 description"
                    rows="3"><?php echo $projectData["projectDescription"]; ?></textarea>
            </div>

            <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"] ?>/details/"
                class="">
                Modificar información del proyecto...<span><i class="fa fa-pencil"></i></span>
            </a>
        </div>
    </div>
    <div class="row tabs shadow w-100 m-0 text-white">
        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/overview/"
            id="tabOverview"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "overview" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-cogs"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">General</span></a>
        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/dashboards/"
            id="tabDashboards"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "dashboards" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-columns"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Tableros</span></a>
        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/diary/"
            id="tabDiary"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "diary" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-book"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Diario</span></a>
        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/collaborators/"
            id="tabCollaborators"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "collaborators" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-users"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Colaboradores</span></a>
        <a href="<?php echo Config::$EXECUTION_HOME_PATH; ?>projects/id/<?php echo $viewParams["id"]; ?>/details/"
            id="tabDetails"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "details" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-info-circle"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Detalles</span></a>
    </div>
    <div class="tabActiveIndicator position-sticky pt-1 bg-primary"></div>
    <div class="row tabContentContainer m-0 px-2">
        <?php
$titleName = "General";
$icon = "cogs";
if (in_array($tabName, $tabNames)) {
    require_once "$tabName.php";
}
switch ($tabName) {
    case "dashboards":
        $optionalScripts[] = "js/project/ProjectDashboardMvc.js";
        require_once "$tabName.php";
        $titleName = "Tableros";
        $icon = "columns";
        break;
    case "diary":
        $optionalScripts[] = "js/project/ProjectDiaryMvc.js";
        require_once "$tabName.php";
        $titleName = "Tablón de anuncios";
        $icon = "book";
        break;
    case "collaborators":
        $optionalScripts[] = "js/project/ProjectCollaboratorsMvc.js";
        require_once "$tabName.php";
        $titleName = "Colaboradores";
        $icon = "users";
        break;
    case "details":
        $titleName = "Detalles";
        $optionalScripts[] = "js/project/projectDetails.js";
        $icon = "info-circle";
        break;
    case "overview":
    default:
        $optionalScripts[] = "js/project/ProjectOverviewMvc.js";
        require_once "overview.php";
        break;
}
$title .= " - " . $titleName;
$breadcrumb[] = [
    "name" => mb_strtoupper($titleName[0]) . mb_strtolower(mb_substr($titleName, 1)),
    "link" => Config::$EXECUTION_HOME_PATH . "projects/id/" . $viewParams["id"] . "/$tabName/",
    "active" => true,
    "icon" => $icon,
];
?>
    </div>
</div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>