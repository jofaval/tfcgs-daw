<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/script.js"];?>
<?php $title = "Perfil";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Profile",
        "link" => "/daw/profile/",
        "active" => true,
        "icon" => "user",
    ],
];
?>

<?php ob_start()?>

<div class="container-fluid my-3">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card card-cascade narrower shadow-none">
                    <?php if ($viewParams["editable"]): ?>
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Edit Photo</h5>
                    </div>
                    <?php endif;?>
                    <div class="card-body card-body-cascade text-center">
                        <img src="/daw/img/users/<?php echo $viewParams["profile"]["username"]; ?>/<?php echo $viewParams["profile"]["username"]; ?>.png"
                            width="200" alt="User Photo" class="z-depth-1 mb-3 mx-auto">
                        <?php if ($viewParams["editable"]): ?>
                        <div class="row flex-center">
                            <button class="btn btn-primary btn-rounded btn-sm waves-effect waves-light">Upload New
                                Photo</button><br>
                            <button class="btn btn-danger btn-rounded btn-sm waves-effect waves-light">Delete</button>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <?php if ($viewParams["editable"]): ?>
                <div class="card card-cascade my-3 narrower shadow-none">
                    <div class="row flex-center my-3">
                        <button class="btn btn-danger btn-rounded waves-effect waves-light">Deshabilitar
                            cuenta</button>
                        <button class="btn btn-danger btn-rounded waves-effect waves-light">Cerrar
                            sesión</button>
                    </div>
                </div>
                <?php endif;?>
            </div>
            <div class="col-lg-8 mb-4">
                <div class="card card-cascade narrower shadow-none">
                    <?php if ($viewParams["editable"]): ?>
                    <div class="view view-cascade bg-primary lighten-3 shadow mx-3">
                        <h5 class="mb-0 font-weight-bold text-center p-3 text-white">Edit Account</h5>
                    </div>
                    <?php endif;?>
                    <div class="card-body card-body-cascade text-center mt-3">
                        <form class="" action="/daw/profile/" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text"
                                            <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?>
                                            name="username" id="username" class="form-control validate"
                                            value="<?php echo $viewParams["profile"]["username"]; ?>">
                                        <label for="username" data-error="wrong" data-success="right">Username</label>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="password" name="password" id="password" class="form-control validate" value="<?php /* echo $viewParams["profile"]["password"]; */?>">
                                        <label for="password" data-error="wrong" data-success="right">Password</label>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text"
                                            <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?>
                                            name="website" id="website" class="form-control validate"
                                            value="<?php echo $viewParams["profile"]["website"]; ?>">
                                        <label for="website" data-error="wrong" data-success="right">Website
                                            Address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text"
                                            <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?> name="name"
                                            id="name" class="form-control validate"
                                            value="<?php echo $viewParams["profile"]["name"]; ?>">
                                        <label for="name" data-error="wrong" data-success="right">First name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form mb-0">
                                        <input type="text"
                                            <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?>
                                            name="surname" id="surname" class="form-control validate"
                                            value="<?php echo $viewParams["profile"]["surname"]; ?>">
                                        <label for="surname" data-error="wrong" data-success="right">Last name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <div class="md-form mb-0">
                                        <input type="email"
                                            <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?>
                                            name="email" id="email" class="form-control validate"
                                            value="<?php echo $viewParams["profile"]["email"]; ?>">
                                        <label for="email">Email address</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="md-form mb-0">
                                        <textarea type="text"
                                            <?php echo !$viewParams["editable"] ? "disabled='true'" : ""; ?>
                                            name="biography" id="biography" class="md-textarea form-control"
                                            rows="3"><?php echo $viewParams["profile"]["biography"]; ?></textarea>
                                        <label for="biography">About me</label>
                                    </div>
                                </div>
                            </div>
                            <?php if ($viewParams["editable"]): ?>
                            <div class="row">
                                <div class="col-md-12 text-center my-4">
                                    <span class="waves-input-wrapper waves-effect waves-light"><input type="submit"
                                            value="Update Account" name="updateProfile" id="updateProfile"
                                            class="btn btn-primary btn-rounded"></span>
                                </div>
                            </div>
                            <?php endif;?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>