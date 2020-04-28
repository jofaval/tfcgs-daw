<style>
#content {
    /* margin-left: .95em; */
}

.z-index-overlap-top {
    z-index: 9999999999 !important;
}

#pushMenuToggleBtn {
    bottom: 2.5em;
}
</style>
<?php $optionalScripts[] = "libs/summernote-bs4.min.js";?>
<?php $optionalScripts[] = "js/agenda.js";?>
<?php $optionalCSS[] = "summernote-bs4.min.css";?>
<?php $optionalCSS[] = "agenda.css";?>

<?php $optionalScripts[] = "js/push-menu.js";?>
<nav class="pushMenu overflow-auto row h-100 col-md-2 position-fixed cursor-pointer z-index-overlap-top">
    <div class="content col m-0 p-0 d-flex h-100 flex-column justify-content-start align-content-start">
        <a class="py-3 ml-3" style="padding-left: 0em" href="#1.">
            1. Test 1656
        </a>
        <a class="py-3 ml-3" style="padding-left: 0em" href="#2.">
            2. Test 552
        </a>
        <a class="py-3 ml-3" style="padding-left: 0.5em" href="#2.1.">
            2.1. subtitle
        </a>
        <a class="py-3 ml-3" style="padding-left: 1em" href="#2.1.1.">
            2.1.1. ewgewhweh
        </a>
    </div>
</nav>

<div id="pushMenuToggleBtn" class="btn btn-primary z-index-overlap-top position-fixed"></div>
<div class="pushMenuOverlap position-absolute z-index-overlap w-100 h-100">
</div>

<div class="w-100 h-100 tabContent d-block" id="tabContent3">
    <div class="mx-auto">
        <div class="form-row d-flex container mx-auto justify-content-center py-4">
            <button class="btn btn-sm m-0 btn-primary" id="navigationSchemeBtn">Generate navigation scheme</button>
            <button class="btn btn-sm m-0 btn-primary diaryBtnSave" id="diaryBtnSave">Save</button>
            <div class="col-sm-3 rounded order-0 order-sm-2 shadow mx-1">
                <!-- value="<-?php echo $viewParams["diaryDate"] ?>" -->
                <div class="md-form m-0">
                    <input placeholder="AAAA/MM/DD" type="datepicker" autofocus="true" id="datepicker"
                        class="form-control datepicker border-0 m-0 text-white">
                    <label for="datepicker">Test</label>
                </div>
            </div>

            <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/diary/date/<?php echo $viewParams["diaryDatePrev"]; ?>/"
                class="btn btn-sm btn-primary projectDiaryBtnPrev order-2 order-sm-1 text-white">&lt;</a>
            <a href="/daw/projects/id/<?php echo $viewParams["id"]; ?>/diary/date/<?php echo $viewParams["diaryDateNext"]; ?>/wqfqwgfqwg"
                class="btn btn-sm btn-primary projectDiaryBtnNext order-3 text-white">&gt;</a>
            <br>
        </div>
        <div class="mx-sm-5 mb-sm-5 summernoteContainer">
            <div id="summernote"></div>
        </div>
    </div>
</div>