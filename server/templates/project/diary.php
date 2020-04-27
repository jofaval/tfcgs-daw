<style>
#content {
    margin-left: .95em;
}

.z-index-overlap-top {
    z-index: 9999999999 !important;
}
</style>
<?php $optionalScripts[] = "libs/summernote-bs4.min.js";?>
<?php $optionalScripts[] = "js/agenda.js";?>
<?php $optionalCSS[] = "summernote-bs4.min.css";?>
<?php $optionalCSS[] = "agenda.css";?>

<?php $optionalScripts[] = "js/push-menu.js";?>
<nav class="pushMenu overflow-auto row h-100 col-md-2 cursor-pointer">
    <div class="content col d-flex h-100 flex-column justify-content-start align-content-start">
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
<div class="pushMenuOverlap position-absolute z-index-overlap w-100 h-100"></div>

<div class="w-100 h-100 tabContent d-block" id="tabContent3">
    <div class="mx-auto">
        <div class="form-row d-flex py-4">
            <button class="btn btn-sm m-3 btn-primary" id="navigationSchemeBtn">Generate navigation scheme</button>
            <button class="btn btn-sm m-3 btn-primary diaryBtnSave" id="diaryBtnSave">Save</button>
            <div class="col-sm-3 rounded order-0 order-sm-2 bg-white shadow mx-1">
                <div class="md-form m-0">
                    <input placeholder="Select a date" type="text" id="datepicker" class="form-control datepicker">
                </div>
            </div>
            <button class="btn btn-sm btn-primary order-2 order-sm-1 text-white">&lt;</button>
            <button class="btn btn-sm btn-primary order-3 text-white">&gt;</button>
            <br>
        </div>
        <div class="mx-sm-5 mb-sm-5 summernoteContainer">
            <div id="summernote"></div>
        </div>
    </div>
</div>