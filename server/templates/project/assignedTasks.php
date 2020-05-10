<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css", "project.css"];?>
<?php $optionalScripts = [];?>
<?php $title = "Tareas asginadas";?>
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
        "name" => "Example",
        "link" => "/daw/example/",
        "active" => true,
        "icon" => "home",
    ],
];
?>

<?php ob_start()?>

<?php $projectData = $viewParams["projectData"];?>

<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<div class="w-100 p-0">
    <style>
    .projectHeader {
        background-image: url("/daw/img/projects/<?php echo $viewParams["id"]; ?>/bg.png") !important;
    }
    </style>
    <div class="row py-5 projectHeader m-0 pr-sm-5">
        <div class="projectImageContainer mx-auto mx-sm-0">
            <img class="projectImage mx-sm-5 shadow"
                src="/daw/img/projects/<?php echo $viewParams["id"]; ?>/profile.png" alt="" width="200" height="200">
        </div>
        <div class="d-none d-sm-block projectDetails bg-dark rounded text-white col">
            <h1 class="projectTitle font-weight-bold"><?php echo $projectData["projectTitle"]; ?></h1>
            <p class="projectCreatedBy mb-2">creado por <a
                    href="/daw/profile/<?php echo $projectData["projectCreatorUsername"]; ?>/" id="projectCreator"
                    class="font-weight-bold text-white"><?php echo $projectData["projectCreator"]; ?></a></p>

            <div class="md-form m-0 p-0">
                <textarea id="projectDescription" disabled="true"
                    class="md-textarea text-white form-control m-0 p-0 description"
                    rows="3"><?php echo $projectData["projectDescription"]; ?></textarea>
            </div>

            <a href="/daw/projects/id/<?php echo $viewParams["id"] ?>/details/" class="">
                Change project information...<span><i class="fa fa-pencil"></i></span>
            </a>
        </div>
    </div>
    <div class="row tabs shadow w-100 m-0 text-white">
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/overview/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "overview" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-cogs"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">General</span></a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/dashboards/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "dashboards" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-columns"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Tableros</span></a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/diary/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "diary" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-book"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Diario</span></a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/collaborators/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "collaborators" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-users"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Colaboradores</span></a>
        <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/details/"
            class="tab d-flex justify-content-center align-content-center p-3 text-white <?php echo $tabName == "details" ? "active" : ""; ?>"><span
                class=""><i class="fa fa-2x fa-info-circle"></i></span>&nbsp;<span
                class="align-self-center d-none d-sm-inline-block">Detalles</span></a>
    </div>
    <div class="row tabContentContainer m-0 px-2">

    </div>
</div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once __DIR__ . '/../layout.php'?>