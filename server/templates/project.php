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

<?php ob_start()?>

<div class="container">
    <div class="row">
        <aside class="col-sm-3">
            <img class="w-100 mt-5" src="/daw/img/profile-pic.png" alt="">
            <button class="btn btn-default w-100 m-0">Test</button>
        </aside>
        <div class="mainContent col">
            <h1 class="text-center text-white">Project title</h1>
            <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi amet libero beatae
                eos! Eligendi, dignissimos suscipit? Adipisci quo distinctio sunt totam, culpa explicabo, aliquid
                quos corrupti quasi, incidunt porro! Cum.</p>
            <div id="diaryForm" class="col-10 mx-auto"></div>
            <section id="project" class="row mt-3">

            </section>
            <div class="row px-3 justify-content-space-around">
                <div class="col flex-column shadow bg-white py-3 rounded my-3">
                    <h3>Dashboards</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text">Test</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-text">Test</div>
                        </div>
                    </div>
                    <button class="btn btn-primary mx-auto w-100">
                        + Add dashboard
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>