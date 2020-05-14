<div class="w-100 h-100 tabContent d-block" id="tabContent4">

    <div class="md-form input-group col my-2">
        <div class="input-group-prepend">
            <div class="dashboardsCount align-self-center mx-2 text-white">
                <span class="numberOfCollaborators">0</span>&nbsp;
                <span class="font-weight-bold">colaborador(es)</span>
            </div>
        </div>
        <div class="row w-auto mx-2">
            <p class="m-0 align-self-center text-white">Mostrar&nbsp;</p>
            <select class="custom-select bg-dark border-0 custom-select-sm align-self-center w-auto"
                id="selectNumberOfRows">
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
            <p class="m-0 align-self-center text-white">&nbsp;fila(s).</p>
        </div>
        <div class="md-form input-group col-12 col-sm my-2">
            <input type="text" class="form-control pl-0 col-12 col-sm text-white rounded-0" name="searchCollaborator"
                id="searchCollaborator" placeholder="Usuario del/a colaborador/a">
            <div class="input-group-append">
                <span class="btn btn-sm collaboratorBtnInvite btn-success m-0 input-group-text md-addon">
                    <span class="d-none d-sm-inline-block">Invitar&nbsp;</span>
                    <span><i class="fa fa-user-plus fa-2x"></i></span>
                </span>
                <span class="btn btn-sm collaboratorBtnSearch btn-warning m-0 input-group-text md-addon">
                    <span class="d-none d-sm-inline-block">Buscar&nbsp;</span>
                    <span><i class="fa fa-search fa-2x"></i></span>
                </span>
            </div>
        </div>
    </div>
    <div class="m-0 px-2 pt-2">
        <div class="collaboratorsContainer"></div>
        <div class="row d-flex justify-content-center py-3">
            <nav aria-label="Page navigation example" class="bg-transparent">
                <ul class="pagination pg-blue mb-0">
                    <li class="page-item nav-previous">
                        <a class="page-link text-white" tabindex="-1">Anterior</a>
                    </li>
                    <li class="page-item nav-next">
                        <a class="page-link text-white">Siguiente</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>