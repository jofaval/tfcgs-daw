<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "tasks.css"];?>
<?php $optionalScripts = ["js/tasks.js"];?>
<?php $title = "ProjectName - TaskName - Task";?>
<?php $mainClasses = "h-100";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>

<?php ob_start()?>

<div class="d-flex justify-content-start mx-2 mx-sm-4 listContainer">
    <div class="taskContainer mx-2">
        <div class="taskList shadow bg-light rounded">
            <section class="listTitle rounded grey lighten-3 text-left p-2">
                <p class="mb-0 ml-3">Titulo 1</p>
            </section>
            <div class="px-3 pt-2 mb-3 taskItemContainer" ondrop="console.log('hola');"
                ondragover="event.preventDefault()">
                <div class="taskItem card mb-2" draggable="true" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="col d-flex">
                    <div class="input-group md-form my-0">
                        <input type="text" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <button class="btn addTask btn-sm btn-primary m-0">+</button>
                        </div>
                    </div>
                    <!-- Default input -->
                </div>
            </div>
        </div>
    </div>
    <div class="taskContainer mx-2">
        <div class="taskList shadow bg-light rounded">
            <section class="listTitle rounded grey lighten-3 text-left p-2">
                <p class="mb-0 ml-3">Titulo 2</p>
            </section>
            <div class="px-3 pt-2 mb-3 taskItemContainer" ondrop="console.log('hola');"
                ondragover="event.preventDefault()" ondragover="event.preventDefault()"
                ondragover="event.preventDefault()">
                <div class="taskItem card mb-2" draggable="true" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project asfsafsafsafsafsafsafasfsafsafasfsafsafsafsafsdghsdhwshge.</p>
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="col d-flex">
                    <div class="input-group md-form my-0">
                        <input type="text" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <button class="btn addTask btn-sm btn-primary m-0">+</button>
                        </div>
                    </div>
                    <!-- Default input -->
                </div>
            </div>
        </div>
    </div>
    <div class="taskContainer mx-2">
        <div class="taskList shadow bg-light rounded">
            <section class="listTitle rounded grey lighten-3 text-left p-2">
                <p class="mb-0 ml-3">Titulo 1</p>
            </section>
            <div class="px-3 pt-2 mb-3 taskItemContainer" ondrop="console.log('hola');"
                ondragover="event.preventDefault()">
                <div class="taskItem card mb-2" draggable="true" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="col d-flex">
                    <div class="input-group md-form my-0">
                        <input type="text" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <button class="btn addTask btn-sm btn-primary m-0">+</button>
                        </div>
                    </div>
                    <!-- Default input -->
                </div>
            </div>
        </div>
    </div>
    <div class="taskContainer mx-2">
        <div class="taskList shadow bg-light rounded">
            <section class="listTitle rounded grey lighten-3 text-left p-2">
                <p class="mb-0 ml-3">Titulo 1</p>
            </section>
            <div class="px-3 pt-2 mb-3 taskItemContainer" ondrop="console.log('hola');"
                ondragover="event.preventDefault()">
                <div class="taskItem card mb-2" draggable="true" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="col d-flex">
                    <div class="input-group md-form my-0">
                        <input type="text" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <button class="btn addTask btn-sm btn-primary m-0">+</button>
                        </div>
                    </div>
                    <!-- Default input -->
                </div>
            </div>
        </div>
    </div>
    <div class="taskContainer mx-2">
        <div class="taskList shadow bg-light rounded">
            <section class="listTitle rounded grey lighten-3 text-left p-2">
                <p class="mb-0 ml-3">Titulo 1</p>
            </section>
            <div class="px-3 pt-2 mb-3 taskItemContainer" ondrop="console.log('hola');"
                ondragover="event.preventDefault()">
                <div class="taskItem card mb-2" draggable="true" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
                <div class="taskItem card mb-2" draggable="true">
                    <div class="card-body px-2 py-1">
                        <p class="card-text">project description.</p>
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="col d-flex">
                    <div class="input-group md-form my-0">
                        <input type="text" class="form-control" placeholder="First name">
                        <div class="input-group-append">
                            <button class="btn addTask btn-sm btn-primary m-0">+</button>
                        </div>
                    </div>
                    <!-- Default input -->
                </div>
            </div>
        </div>
    </div>
    <div class="taskContainer mx-2">
        <div class="taskList shadow bg-light rounded">
            <div class="col d-flex">
                <div class="input-group md-form my-3">
                    <input type="text" class="form-control" placeholder="First name">
                    <div class="input-group-append">
                        <button class="btn addList btn-sm btn-primary m-0">+</button>
                    </div>
                </div>
                <!-- Default input -->
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>