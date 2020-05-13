<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "signin.css"];?>
<?php $optionalScripts = ["js/signin.js"];?>
<?php $title = "Sign in/up";?>
<?php $mainClasses = "h-100 overflow-x-visible";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php $breadcrumb = [];?>
<?php $loadLogin = Utils::exists("login")?>

<?php ob_start()?>
<div class="h-75 m-auto w-50 shadow d-flex text-dark bg-white" id="signFormsContainer">
    <form action="/daw/signin/" method="POST" id="registerForm"
        class="col-md-6 d-flex align-items-center justify-content-center flex-column pl-5 pr-0 h-100 text-center">
        <h1>¡Nos alegra verte de nuevo!</h1>
        <div class="md-form w-100">
            <input type="text" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off"
                spellcheck="false" id="username" name="username" required
                value="<?php echo $viewParams["signinUsername"]; ?>">
            <label for="username">Usuario</label>
        </div>
        <div class="md-form input-group w-100">
            <input type="password" class="form-control" id="password" name="password" required
                value="<?php echo $viewParams["signinPassword"]; ?>">
            <label for="password">Contraseña</label>
            <div class="input-group-append">
                <a href="" class="btn btn-primary btn-sm input-group-text md-addon shadow-none togglePassword">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
        <div class="form-row">
            <div class="custom-control text-left custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="rememberCredentials">
                <label class="custom-control-label" for="rememberCredentials">Recordar combinación</label>
            </div>
        </div>

        <div class="md-form w-75">
            <input type="submit" class="btn btn-primary w-100" value="Iniciar sesión" id="signin" name="signin"
                required>
        </div>
    </form>
    <form action="/daw/signup/" method="POST" id="loginForm"
        class="col-md-6 d-flex align-items-center justify-content-center flex-column pr-5 pl-0 h-100 text-center">
        <h1>¡Bienvenid@!</h1>
        <div class="form-row w-100">
            <div class="col">
                <!-- Nombre -->
                <div class="md-form">
                    <input type="text" name="firstName" id="firstName" required
                        value="<?php echo $viewParams["signupFirstName"]; ?>" class="form-control">
                    <label for="firstName">Nombre</label>
                </div>
                <?php Utils::ifExistsShowError($viewParams, "firstName");?>
            </div>
            <div class="col">
                <!-- Apellidos -->
                <div class="md-form">
                    <input type="text" name="secondName" id="secondName" required
                        value="<?php echo $viewParams["signupSecondName"]; ?>" class="form-control">
                    <label for="secondName">Apellidos</label>
                </div>
                <?php Utils::ifExistsShowError($viewParams, "secondName");?>
            </div>
        </div>
        <div class="md-form w-100">
            <input type="email" class="form-control" id="email" autocomplete="off" autocorrect="off"
                autocapitalize="off" spellcheck="false" name="email" required
                value="<?php echo $viewParams["signupEmail"]; ?>">
            <label for="email">Correo electrónico</label>
            <?php Utils::ifExistsShowError($viewParams, "email");?>
        </div>
        <div class="md-form w-100">
            <input type="text" class="form-control" autocomplete="off" autocorrect="off" autocapitalize="off"
                spellcheck="false" id="username" name="username" required
                value="<?php echo $viewParams["signupUsername"]; ?>">
            <label for="username">Usuario</label>
            <?php Utils::ifExistsShowError($viewParams, "username");?>
        </div>
        <div class="md-form input-group w-100">
            <input type="password" class="form-control" id="password" name="password" required
                value="<?php echo $viewParams["signupPassword"]; ?>">
            <label for="password">Contraseña</label>
            <div class="input-group-append">
                <a href="" class="btn btn-primary btn-sm input-group-text md-addon shadow-none togglePassword">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
            <?php Utils::ifExistsShowError($viewParams, "password");?>
        </div>
        <div class="md-form w-75">
            <input type="submit" class="btn btn-primary w-100" value="Registrarse" id="signup" name="signup" required>
        </div>
    </form>
    <div class="position-fixed bottom-1 btn btn-primary d-block d-sm-none" id="changeForm">Cambiar
    </div>
    <div id="mainPanel"
        class="aqua-gradient rounded text-white shadow position-relative d-none d-sm-flex z-index-overlap flex-column justify-content-center align-items-center">
        <div class="d-flex <?php echo $loadLogin ? "" : "formToLoad"; ?> togglePanel flex-column justify-content-center align-items-center"
            id="loginPanel">
            <h2 class="font-weight-bold">Formulario de inicio</h2>
            <p>No estoy registrado, llevame al:</p>
            <br>
            <button class="btn rounded">Formulario de registro</button>
        </div>
        <div class="d-flex <?php echo $loadLogin ? "formToLoad" : ""; ?> togglePanel flex-column justify-content-center align-items-center"
            id="registerPanel">
            <h2 class="font-weight-bold">Formulario de registro</h2>
            <br>
            <p>Ya estoy registrado, llevame al:</p>
            <button class="btn rounded">Formulario de inicio</button>
        </div>
    </div>
</div>

<?php echo $viewParams["error"]; ?>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>