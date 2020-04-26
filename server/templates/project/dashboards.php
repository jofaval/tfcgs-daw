<div
    class="row dashboardMenu d-flex justify-content-center justify-items-center align-content-center align-items-center shadow w-100 m-0 grey darken-2">
    <div class="projectsCount ml-3">
        <span class="numberOfProjects">15</span>&nbsp;
        <span class="font-weight-bold">dashboard(s)</span>
    </div>
    <div class="btn-group projectsBtnFilters">
        <div class="projectsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>
        <div class="projectsBtnCreated btn btn-sm btn-success">Created</div>
        <div class="projectsBtnShared btn btn-sm btn-primary">Shared</div>
    </div>
    <div class="row w-auto mx-2">
        Show&nbsp;
        <select class="custom-select custom-select-sm w-auto" id="selectNumberOfRows">
            <option value="1">1</option>
            <option value="2">2</option>
            <option selected value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        &nbsp;row(s).
    </div>
    <div class="btn btn-success btn-sm projectBtnAdd">+ Add</div>
    <div class="md-form input-group col my-2">
        <input type="search" class="form-control text-white pl-0 rounded-0" name="projectSearch" id="projectSearch"
            placeholder="Search...">
        <div class="input-group-append">
            <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">Search</span>
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