<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/script.js"];?>
<?php $title = "Example";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    ["name" => "Home",
        "link" => "/daw/index.php?ctl=calendar",
        "active" => false,
    ],
    ["name" => "Example",
        "link" => "/daw/index.php?ctl=admin",
        "active" => false,
    ],
];
?>

<?php ob_start()?>

<div class="container-fluid my-3">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card card-cascade narrower">
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Edit Photo</h5>
                    </div>
                    <div class="card-body card-body-cascade text-center mt-3">
                        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-5.jpg" alt="User Photo"
                            class="z-depth-1 mb-3 mx-auto">
                        <div class="row flex-center">
                            <button class="btn btn-primary btn-rounded btn-sm waves-effect waves-light">Upload New
                                Photo</button><br>
                            <button class="btn btn-danger btn-rounded btn-sm waves-effect waves-light">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="card card-cascade narrower">
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Edit Account</h5>
                    </div>
                    <div class="card-body card-body-cascade text-center mt-3">
                        <form class="AVAST_PAM_nonloginform">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form1" class="form-control validate" value="Company, inc"
                                            disabled="">
                                        <label for="form1" data-error="wrong" data-success="right"
                                            class="active">Company</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form2" class="form-control validate">
                                        <label for="form2" data-error="wrong" data-success="right">Username</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form81" class="form-control validate">
                                        <label for="form81" data-error="wrong" data-success="right">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form82" class="form-control validate">
                                        <label for="form82" data-error="wrong" data-success="right">Last name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="email" id="form76" class="form-control validate">
                                        <label for="form76">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text" id="form77" class="form-control validate">
                                        <label for="form77" data-error="wrong" data-success="right">Website
                                            Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <textarea type="text" id="form78" class="md-textarea form-control"
                                            rows="3"></textarea>
                                        <label for="form78">About me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center my-4">
                                    <span class="waves-input-wrapper waves-effect waves-light"><input type="submit"
                                            value="Update Account" class="btn btn-primary btn-rounded"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>