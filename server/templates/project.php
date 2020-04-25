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
switch ($viewParams["tabName"]) {
    case "dashboards":
        ?>
        <div class="w-100 h-100 tabContent d-block" id="tabContent2">
            <div
                class="row d-flex text-white justify-content-center justify-items-center align-content-center align-items-center shadow w-100 m-0">
                <div class="projectsCount ml-3">
                    <span class="numberOfProjects">15</span>&nbsp;
                    <span class="font-weight-bold">dashboard(s)</span>
                </div>
                <div class="btn-group">
                    <div class="projectsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>
                    <div class="projectsBtnCreated btn btn-sm btn-success">Created</div>
                </div>
                <div class="row w-auto mx-2">
                    Show&nbsp;
                    <select class="custom-select custom-select-sm w-auto">
                        <option value="2">2</option>
                        <option value="4">4</option>
                        <option selected value="6">6</option>
                        <option value="8">8</option>
                        <option value="10">10</option>
                    </select>
                    &nbsp;entries.
                </div>
                <div class="btn btn-success btn-sm projectBtnAdd">+ Add</div>
                <div class="md-form input-group col my-2">
                    <input type="search" class="form-control pl-0 rounded-0" name="search" id="search"
                        placeholder="Search...">
                    <div class="input-group-append">
                        <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">Search</span>
                    </div>
                </div>
            </div>
            <div class="grey darken-3 m-0 px-2 pt-2">
                <div class="row projectCardRow d-flex justify-content-center m-0">
                    <div class="projectCard row col m-2 bg-white">
                        <div
                            class="row projectCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
                            <h5 class="projectCardTitle m-0 font-weight-bold">Dashboard title</h5>
                            <div class="btn btn-sm btn-primary">Go to dashboard</div>
                            <div class="btn btn-sm btn-danger">Delete dashboard</div>
                            <img src="" alt="" class="projectCardBookmarkedIcon">
                            <div class="projectCardFlags float-right btn-group">
                                <div class="projectsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>
                                <div class="projectsBtnCreated btn btn-sm btn-success">Created</div>
                            </div>
                        </div>
                        <div class="projectCardDescription text-justify my-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam repellendus voluptatem,
                            dolorum
                            nostrum sit iure qui amet maxime.
                        </div>
                    </div>
                </div>
                <div class="row projectCardRow d-flex justify-content-center m-0">
                    <div class="projectCard row col m-2 bg-white">
                        <div
                            class="row projectCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
                            <h5 class="projectCardTitle m-0 font-weight-bold">Dashboard title</h5>
                            <div class="btn btn-sm btn-primary">Go to dashboard</div>
                            <div class="btn btn-sm btn-danger">Delete dashboard</div>
                            <img src="" alt="" class="projectCardBookmarkedIcon">
                            <div class="projectCardFlags float-right btn-group">
                                <div class="projectsBtnCreated btn btn-sm btn-success">Created</div>
                            </div>
                        </div>
                        <div class="projectCardDescription text-justify my-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam repellendus voluptatem,
                            dolorum
                            nostrum sit iure qui amet maxime.
                        </div>
                    </div>
                </div>
                <div class="row projectCardRow d-flex justify-content-center m-0">
                    <div class="projectCard row col m-2 bg-white">
                        <div
                            class="row projectCardDetails flex-wrap d-flex justify-content-start justify-items-center align-content-center align-items-center w-100 m-0 pt-2">
                            <h5 class="projectCardTitle m-0 font-weight-bold">Dashboard title</h5>
                            <div class="btn btn-sm btn-primary">Go to dashboard</div>
                            <div class="btn btn-sm btn-danger">Delete dashboard</div>
                            <img src="" alt="" class="projectCardBookmarkedIcon">
                            <div class="projectCardFlags float-right btn-group">
                            </div>
                        </div>
                        <div class="projectCardDescription text-justify my-2">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam repellendus voluptatem,
                            dolorum
                            nostrum sit iure qui amet maxime.
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center py-3">
                    <nav aria-label="Page navigation example" class="bg-transparent">
                        <ul class="pagination pg-blue mb-0">
                            <li class="page-item ">
                                <a class="page-link" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link">1</a></li>
                            <li class="page-item active">
                                <a class="page-link">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link">3</a></li>
                            <li class="page-item ">
                                <a class="page-link">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <?php
break;
    case "diary":
        ?>
        <div class="w-100 h-100 tabContent d-block" id="tabContent3">
            <div class="mx-auto">
                <button class="btn m-3 btn-primary" id="navigationSchemeBtn">Generate navigation scheme</button>
                <div class="form-row d-flex py-4">
                    <div class="col-sm-3 rounded order-0 order-sm-2 bg-white shadow mx-1">
                        <div class="md-form m-0">
                            <input placeholder="Select a date" type="text" id="datepicker"
                                class="form-control datepicker">
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary order-2 order-sm-1 text-white ml-auto">&lt;</button>
                    <button class="btn btn-sm btn-primary order-3 text-white mr-auto">&gt;</button>
                    <br>
                </div>
                <div class="mx-sm-5 mb-sm-5">
                    <div id="summernote"></div>
                </div>
            </div>
        </div>
        <?php
break;
    case "collaborators":
        ?>
        <div class="w-100 h-100 tabContent d-block" id="tabContent4">
            <div class="md-form input-group col my-2">
                <input type="text" class="form-control pl-0 rounded-0" name="searchCollaborator" id="searchCollaborator"
                    placeholder="Collaborator's username">
                <div class="input-group-append">
                    <span class="btn btn-sm btn-success m-0 input-group-text md-addon">Invite</span>
                    <span class="btn btn-sm btn-warning m-0 input-group-text md-addon">Search</span>
                </div>
            </div>
            <div class="grey darken-3 m-0 px-2 pt-2">
                <?php
for ($i = 0; $i < 4; $i++):
        ?>
                <div class="row projectCardRow d-flex justify-content-center m-0">
                    <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                        <img class="projectCollaboratorImg my-2 rounded-pill" src="/daw/img/profile-pic.png" alt="">
                        <div class="projectCollaboratorDetails my-auto col">
                            <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                            <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                        </div>
                        <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See profile
                        </div>
                    </div>
                    <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                        <img class="projectCollaboratorImg my-2 rounded-pill" src="/daw/img/profile-pic.png" alt="">
                        <div class="projectCollaboratorDetails my-auto col">
                            <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                            <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                        </div>
                        <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See profile
                        </div>
                    </div>
                </div>
                <?php
endfor;?>
                <div class="row d-flex justify-content-center py-3">
                    <nav aria-label="Page navigation example" class="bg-transparent">
                        <ul class="pagination pg-blue mb-0">
                            <li class="page-item ">
                                <a class="page-link" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link">1</a></li>
                            <li class="page-item active">
                                <a class="page-link">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link">3</a></li>
                            <li class="page-item ">
                                <a class="page-link">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <?php
break;
    case "details":
        ?>
        <div class="w-100 h-100 tabContent d-block" id="tabContent5">
            <div class="content px-5">
                <h5 class="text-white mt-5">Project title</h5>
                <h3 class="text-white font-weight-bold mb-5">Origen</h3>
                <h5 class="text-white">Project description</h5>
                <div class="md-form mb-5 mt-0">
                    <textarea id="form7" class="md-textarea form-control text-white p-0" disabled
                        rows="3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Error facere.</textarea>
                    <label for="form7" class="d-none">Material textarea</label>
                </div>
                <div class="projectCreationDetails mb-5 text-muted">
                    <div class="float-right text-right">
                        Te invitó <a href="" class="projectCreatedBy">Pepe Fabra Valverde</a>
                        <br> el <span class="projectCreationDate">04/04/2020</span> como <span
                            class="projectCreationRole informationText font-weight-bold">colaborador</span>
                        <div class="informationTextQuote text-white p-3 position-absolute rounded">Lorem ipsum dolor
                            sit amet
                            consectetur.
                        </div>
                    </div>
                    <div>Creador por <a href="" class="projectCreatedBy">Pepe Fabra
                            Valverde</a>
                        <br> el <span class="projectCreationDate">04/04/2020</span>
                    </div>
                </div>
            </div>
        </div>
        <?php
break;
    case "overview":
    default:
        ?>
        <div class="w-100 h-100 tabContent d-block" id="tabContent1">
            <div class="w-100 display-none display-sm-block p-2 text-white d-flex justify-content-start">
                <div class="collaborators mx-2">
                    <span id="numberOfCollaborators">24</span>
                    <span class="font-weight-bold">colaborador(s)</span>
                </div>
                <div class="dashboards mx-2">
                    <span id="numberOfDashboards">24</span>
                    <span class="font-weight-bold">tablero(s)</span>
                </div>
                <div class="activeTime mx-2">
                    <span id="numberOfDashboards">5</span>
                    <span class="font-weight-bold">año(s)</span>,&nbsp;
                    <span id="numberOfDashboards">2</span>
                    <span class="font-weight-bold">mes(es)</span>&nbsp;y&nbsp;
                    <span id="numberOfDashboards">15</span>
                    <span class="font-weight-bold">día(s)</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="actionsGroup">
                        <h4 class="actionsTitle text-white">Tablero</h4>
                        <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                            <div class="action blue m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                            <div class="action blue m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                            <div class="action blue m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                        </div>
                    </div>
                    <div class="actionsGroup">
                        <h4 class="actionsTitle text-white">Diario</h4>
                        <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                            <div class="action green m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                            <div class="action green m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                        </div>
                    </div>
                    <div class="actionsGroup">
                        <h4 class="actionsTitle text-white">Proyecto</h4>
                        <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                            <div class="action red m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                            <div class="action red m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                            <div class="action red m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>
                            <div class="action red m-2">
                                <div class="actionIcon h-75 text-white p-3">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="actionTitle h-25 text-center text-white bg-dark">Test</div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <h4 class="h4 text-white">Creado recientemente</h4>
                        <div class="recentlyCreated">
                            <div class="card w-100">
                                <div class="card-body p-0">
                                    <p class="card-text my-auto d-inline">Test</p>
                                    <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                                </div>
                            </div>
                            <div class="card w-100">
                                <div class="card-body p-0">
                                    <p class="card-text my-auto d-inline">Test</p>
                                    <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                                </div>
                            </div>
                            <div class="card w-100">
                                <div class="card-body p-0">
                                    <p class="card-text my-auto d-inline">Test</p>
                                    <a href="#" class="btn btn-primary float-right">Go somewhere</a>
                                </div>
                            </div>
                            <span class="btn btn-primary w-100">Ver todos</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <h4 class="h4 text-white">Invitados recientemente</h4>
                        <div class="recentlyInvited">
                            <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                                <img class="projectCollaboratorImg my-2 rounded-pill" src="../img/profile-pic.png"
                                    alt="">
                                <div class="projectCollaboratorDetails my-auto col">
                                    <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                                    <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                                </div>
                                <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See
                                    profile
                                </div>
                            </div>
                            <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                                <img class="projectCollaboratorImg my-2 rounded-pill" src="../img/profile-pic.png"
                                    alt="">
                                <div class="projectCollaboratorDetails my-auto col">
                                    <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                                    <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                                </div>
                                <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See
                                    profile
                                </div>
                            </div>
                            <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                                <img class="projectCollaboratorImg my-2 rounded-pill" src="../img/profile-pic.png"
                                    alt="">
                                <div class="projectCollaboratorDetails my-auto col">
                                    <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                                    <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                                </div>
                                <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See
                                    profile
                                </div>
                            </div>
                            <span class="btn btn-primary w-100">Ver todos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
break;
}
?>





    </div>
</div>
</div>


<?php $contenido = ob_get_clean()?>

<?php include_once 'layoutProject.php'?>