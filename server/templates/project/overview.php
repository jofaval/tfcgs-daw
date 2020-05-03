<div class="w-100 h-100 tabContent d-block" id="tabContent1">
    <div class="w-100 display-none display-sm-block p-2 text-white d-flex justify-content-start">
        <div class="collaborators mx-2">
            <span id="numberOfCollaborators">24</span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-user"></i></a>
                <span class="d-none d-sm-inline-block">colaborador(s)</span>
            </span>
        </div>
        <div class="dashboards mx-2">
            <span id="numberOfDashboards">24</span>
            <span class="font-weight-bold">
                <a class=""><i class="fa fa-lg fa-columns"></i></a>
                <span class="d-none d-sm-inline-block">tablero(s)</span>
            </span>
        </div>
        <div class="activeTime mx-2">
            <?php echo $projectData["projectCreationDate"]; ?>
        </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="actionsGroup">
                <h4 class="actionsTitle text-white">Tablero</h4>
                <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                    <div class="action cursor-pointer blue m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-plus"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Añadir tablero</div>
                    </div>
                    <div class="action cursor-pointer blue m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-eye"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Ver tablero</div>
                    </div>
                    <div class="action cursor-pointer blue m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-tasks"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Ver tareas asignadas</div>
                    </div>
                </div>
            </div>
            <div class="actionsGroup">
                <h4 class="actionsTitle text-white">Diario</h4>
                <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                    <div class="action cursor-pointer green m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-calendar-check-o"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Ver diario de hoy</div>
                    </div>
                    <div class="action cursor-pointer green m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Ir a selección de fecha</div>
                    </div>
                </div>
            </div>
            <div class="actionsGroup">
                <h4 class="actionsTitle text-white">Proyecto</h4>
                <div class="actionsButton d-flex justify-content-space-between flex-wrap">
                    <div class="action cursor-pointer red m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Añadir colaborador</div>
                    </div>
                    <div class="action cursor-pointer red m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-user-times"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Eliminar colaborador</div>
                    </div>
                    <div class="action cursor-pointer red m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Cambiar rol</div>
                    </div>
                    <div class="action cursor-pointer red m-2">
                        <div class="actionIcon h-75 text-white p-3">
                            <i class="fa fa-times"></i>
                        </div>
                        <div class="actionTitle h-25 text-center text-white bg-dark">Eliminar proyecto</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6 mx-3 mx-sm-0">
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
                <div class="recentlyInvited collaboratorsContainer">
                    <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                        <img class="projectCollaboratorImg my-2 rounded-pill" src="../img/profile-pic.png" alt="">
                        <div class="projectCollaboratorDetails my-auto col">
                            <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                            <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                        </div>
                        <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See
                            profile
                        </div>
                    </div>
                    <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                        <img class="projectCollaboratorImg my-2 rounded-pill" src="../img/profile-pic.png" alt="">
                        <div class="projectCollaboratorDetails my-auto col">
                            <h5 class=".projectCollaboratorName">Pepe Fabra Valverde</h5>
                            <p class="projectCollaboratorRole font-weight-bold">Administrator</p>
                        </div>
                        <div class="projectCollaboratorProfileBtn btn btn-sm btn-primary float-right">See
                            profile
                        </div>
                    </div>
                    <div class="projectCollaboratorCard rounded row col m-2 bg-white">
                        <img class="projectCollaboratorImg my-2 rounded-pill" src="../img/profile-pic.png" alt="">
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