<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "projects.css"];?>
<?php $optionalScripts = ["js/ProjectsCrudMvc.js"];?>
<?php $title = "Projects";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "../index.php",
        "active" => false,
    ],
    [
        "name" => "Projects",
        "link" => "",
        "active" => true,
    ],
];
?>

<?php $sessions = Sessions::getInstance();?>
<?php $username = $sessions->getSession("username");?>

<?php ob_start()?>
<div class=" p-0">
    <div class="row py-5 m-0 projectHeader">
        <div class="projectImageContainer">
            <img class="projectImage mx-5" src="/daw/img/users/<?php echo $username; ?>/<?php echo $username; ?>.png"
                alt="" width="200">
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
    <div
        class="row tabs d-flex justify-content-center justify-items-center align-content-center align-items-center shadow w-100 m-0 grey darken-2">
        <div class="projectsCount ml-3">
            <span class="numberOfProjects">15</span>&nbsp;
            <span class="font-weight-bold">project(s)</span>
        </div>
        <div class="btn-group projectsBtnFilters">
            <div class="projectsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>
            <div class="projectsBtnCreated btn btn-sm btn-success">Created</div>
            <div class="projectsBtnShared btn btn-sm btn-primary">Shared</div>
        </div>
        <div class="row w-auto mx-2">
            <p class="m-0 align-self-center text-white">Show&nbsp;</p>
            <select class="custom-select custom-select-sm align-self-center w-auto" id="selectNumberOfRows">
                <option value="1" class="d-block d-sm-none">2</option>
                <option value="1" class="d-none d-sm-block">1</option>
                <option value="2" class="d-block d-sm-none">4</option>
                <option value="2" class="d-none d-sm-block">2</option>
                <option value="3" class="d-block d-sm-none">6</option>
                <option value="3" class="d-none d-sm-block" selected>3</option>
                <option value="4" class="d-block d-sm-none">8</option>
                <option value="4" class="d-none d-sm-block">4</option>
                <option value="5" class="d-block d-sm-none">10</option>
                <option value="5" class="d-none d-sm-block">5</option>
            </select>
            <p class="m-0 align-self-center text-white">&nbsp;row(s).</p>
        </div>
        <div class="btn btn-success btn-sm projectBtnAdd">+ Add</div>
        <div class="md-form input-group col-12 col-sm my-2">
            <input type="search" class="form-control text-white pl-0 rounded-0" name="projectSearch" id="projectSearch"
                placeholder="Search...">
            <div class="input-group-append">
                <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">
                    <span class="d-none d-sm-inline-block">Search&nbsp;</span>
                    <span><i class="fa fa-search fa-2x"></i></span>
                </span>
            </div>
        </div>
    </div>
    <div class="grey darken-3 m-0 mx-auto px-2 pt-2">
        <div class="projectsContainer text-white text-center col-md-10 m-0 mx-auto">
        </div>
        <div class="row d-flex justify-content-center py-3">
            <nav aria-label="Page navigation example" class="bg-transparent">
                <ul class="pagination pg-blue mb-0">
                    <li class="page-item nav-previous">
                        <a class="page-link text-white" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item nav-next">
                        <a class="page-link text-white">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>