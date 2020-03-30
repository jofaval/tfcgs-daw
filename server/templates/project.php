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

                <div class="col-12 d-flex flex-column">
                    <table class="table mb-0 w-100 table-dark table-bordered ganttTable">
                        <thead class="thead-dark ganttTableHeader">
                            <tr>
                                <th colspan="999999">
                                    <h3 class="mb-0">Gantt tasks</h3>
                                </th>
                            </tr>
                            <tr class="ganttRowMonth">
                                <th id="titles" style="min-width: calc(26px + 3rem);">Task titles</th>
                                <th class="text-center align-middle">Starting day</th>
                                <th class="text-center align-middle">Ending day</th>
                                <th class="text-center align-middle">Progress</th>
                                <th class="text-center align-middle">Days span</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="subTask task">
                                <td draggable="true">Task 1</td>
                                <td class="startingDate" draggable="true">30/03/2020</td>
                                <td class="endingDate" draggable="true">02/04/2020</td>
                                <td class="progressIndicator align-middle" draggable="true">
                                    <div class="progress my-auto bg-dark" title="50%">
                                        <div class="progress-bar text-dark font-weight-bold aqua-gradient"
                                            role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100" title="50%">50%</div>
                                    </div>
                                </td>
                                <td class="daysSpan" draggable="true">3</td>
                            </tr>
                            <tr class="subTask task">
                                <td draggable="true">Tasl 2</td>
                                <td class="startingDate" draggable="true">30/03/2020</td>
                                <td class="endingDate" draggable="true">02/04/2020</td>
                                <td class="progressIndicator align-middle" draggable="true">
                                    <div class="progress my-auto bg-dark" title="50%">
                                        <div class="progress-bar text-dark font-weight-bold aqua-gradient"
                                            role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0"
                                            aria-valuemax="100" title="50%">50%</div>
                                    </div>
                                </td>
                                <td class="daysSpan" draggable="true">3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <div class="row px-3 justify-content-space-around">
                <div class="col flex-column shadow bg-white py-3 rounded my-3">
                    <h3>Gantts</h3>
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
                        + Add Gantt
                    </button>
                </div>
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