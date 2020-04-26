<div class="w-100 h-100 tabContent d-block" id="tabContent4">

    <div class="md-form input-group col my-2">
        <div class="input-group-prepend">
            <div class="dashboardsCount align-self-center mx-2 text-white">
                <span class="numberOfCollaborators">0</span>&nbsp;
                <span class="font-weight-bold">collaborators(s)</span>
            </div>
        </div>
        <div class="row w-auto mx-2">
            <p class="m-0 align-self-center text-white">Show&nbsp;</p>
            <select class="custom-select custom-select-sm align-self-center w-auto" id="selectNumberOfRows">
                <option value="1">1</option>
                <option value="2">2</option>
                <option selected value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <p class="m-0 align-self-center text-white">&nbsp;row(s).</p>
        </div>
        <input type="text" class="form-control pl-0 text-white rounded-0" name="searchCollaborator"
            id="searchCollaborator" placeholder="Collaborator's username">
        <div class="input-group-append">
            <span class="btn btn-sm collaboratorBtnInvite btn-success m-0 input-group-text md-addon">Invite</span>
            <span class="btn btn-sm collaboratorBtnSearch btn-warning m-0 input-group-text md-addon">Search</span>
        </div>
    </div>
    <div class="grey darken-3 m-0 px-2 pt-2">
        <div class="collaboratorsContainer"></div>
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