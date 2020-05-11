<script>
document.querySelector('.tabContentContainer').classList.remove("px-2");
</script>

<div class="w-100 h-100 tabContent p-0" id="tabContent2">
    <div
        class="row dashboardMenu d-flex justify-content-center justify-items-center align-content-center align-items-center shadow w-100 m-0 tabs">
        <div class="dashboardsCount ml-3 text-white">
            <span class="numberOfDashboards">0</span>&nbsp;
            <span class="font-weight-bold">dashboard(s)</span>
        </div>
        <div class="btn-group dashboardsBtnFilters">
            <div class="dashboardsBtnBookmarked btn btn-sm btn-warning">Bookmarked</div>
            <div class="dashboardsBtnCreated btn btn-sm btn-success">Created</div>
        </div>
        <div class="row w-auto mx-2">
            <p class="m-0 align-self-center text-white">Show&nbsp;</p>
            <select class="custom-select custom-select-sm align-self-center w-auto" id="selectNumberOfRows">
                <!--((option[value=$]{$})*2)*5-->
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
        <div class="btn btn-success btn-sm dashboardBtnAdd">+ Add</div>
        <div class="md-form input-group col-12 col-sm my-2">
            <input type="search" class="form-control text-white pl-0 rounded-0" name="dashboardSearch"
                id="dashboardSearch" placeholder="Search...">
            <div class="input-group-append">
                <span class="btn btn-sm btn-primary m-0 input-group-text md-addon">
                    <span class="d-none d-sm-inline-block">Search&nbsp;</span>
                    <span><i class="fa fa-search fa-2x"></i></span>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-10 m-0 mt-2 mx-auto">
        <div class="dashboardsContainer text-white text-center">
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