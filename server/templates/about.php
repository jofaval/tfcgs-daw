<!--Page configuration-->
<?php $optionalCSS = ["about.css"];?>
<?php $optionalScripts = ["js/about.js"];?>
<?php $title = "About";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
<?php $showBreadcrumb = false;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "/daw/",
        "active" => false,
        "icon" => "home",
    ],
    [
        "name" => "Acerca de ",
        "link" => "/daw/about/",
        "active" => true,
        "icon" => "info",
    ],
];
?>

<?php ob_start()?>

<div class="d-flex w-100 h-100 overflow-auto m-0 p-0 text-white flex-wrap flex-column">
    <div class="topSpace my-5">&nbsp;</div>
    <div class="w-100 h-100 col-sm-12 page page1 m-0 center-elements flex-column">
        <div class="container text-center">
            <h1>Te damos la bienvenida a <span class="font-weight-bold">Origen</span></h1>
            <p>Usa las flechas del teclado para navegar</p>
        </div>
    </div>
    <div class="w-100 h-100 col-sm-12 page page2 m-0 center-elements flex-column">
        <div class="container text-center">
            <h1>¿Qué es origen?</h1>
            <h4>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet nulla laborum vitae eaque blanditiis
                cumque
                exercitationem ut aliquid laudantium dicta quo, facere itaque, velit inventore labore temporibus a vero
                at.
            </h4>
        </div>
    </div>
    <div class="w-100 h-100 col-sm-12 page page3 m-0 center-elements flex-column">
        <div class="container text-center">
            <h2>Nuestros precios</h2>
            <section class="pricing py-5">
                <div class="container">
                    <div class="row text-dark">
                        <!-- Free Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                                    <h6 class="card-price text-center">$0<span class="period">/month</span></h6>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Single User</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>5GB Storage</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Public
                                            Projects</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                        <li class="text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Unlimited Private Projects</li>
                                        <li class="text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Dedicated Phone Support</li>
                                        <li class="text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Free Subdomain</li>
                                        <li class="text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Monthly Status Reports</li>
                                    </ul>
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                </div>
                            </div>
                        </div>
                        <!-- Plus Tier -->
                        <div class="col-lg-4">
                            <div class="card mb-5 mb-lg-0">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                                    <h6 class="card-price text-center">$9<span class="period">/month</span></h6>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span><strong>5
                                                Users</strong></li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>50GB Storage</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Public
                                            Projects</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Private
                                            Projects</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Dedicated Phone
                                            Support</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Free Subdomain</li>
                                        <li class="text-muted"><span class="fa-li"><i
                                                    class="fa fa-times"></i></span>Monthly Status Reports</li>
                                    </ul>
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                </div>
                            </div>
                        </div>
                        <!-- Pro Tier -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                                    <h6 class="card-price text-center">$49<span class="period">/month</span></h6>
                                    <hr>
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span><strong>Unlimited
                                                Users</strong></li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>150GB Storage</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Public
                                            Projects</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Community Access</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Unlimited Private
                                            Projects</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Dedicated Phone
                                            Support</li>
                                        <li><span class="fa-li"><i
                                                    class="fa fa-check"></i></span><strong>Unlimited</strong> Free
                                            Subdomains</li>
                                        <li><span class="fa-li"><i class="fa fa-check"></i></span>Monthly Status
                                            Reports</li>
                                    </ul>
                                    <a href="#" class="btn btn-block btn-primary text-uppercase">Button</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="w-100 h-100 col-sm-12 page page4 m-0 center-elements flex-column">
        <div class="container text-center">
            <h1>Nuestro equipo</h1>
            <div class="row">
                <div class="col-md">
                    <a href="" class="collaboratorCard text-dark px-0 row col-12 m-2 mx-auto bg-white">
                        <img src="/daw/img/default.png" alt="" class="collaboratorImg object-fit-cover w-100 z-index"
                            height="400">
                        <div
                            class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
                            <h5
                                class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                                Pepe Fabra Valverde</h5>
                        </div>
                        <p
                            class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
                            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
                        </p>
                    </a>
                </div>
                <div class="col-md">
                    <a href="" class="collaboratorCard text-dark px-0 row col-12 m-2 mx-auto bg-white">
                        <img src="/daw/img/default.png" alt="" class="collaboratorImg object-fit-cover w-100 z-index"
                            height="400">
                        <div
                            class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
                            <h5
                                class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                                Pepe Fabra Valverde</h5>
                        </div>
                        <p
                            class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
                            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
                        </p>
                    </a>
                </div>
                <div class="col-md">
                    <a href="" class="collaboratorCard text-dark px-0 row col-12 m-2 mx-auto bg-white">
                        <img src="/daw/img/default.png" alt="" class="collaboratorImg object-fit-cover w-100 z-index"
                            height="400">
                        <div
                            class="row collaboratorDetails border pl-3 z-index-overlap flex-wrap center-elements m-0 w-100">
                            <h5
                                class="collaboratorName text-dark text-overflow-ellipsis overflow-hidden py-1 m-0 font-weight-normal">
                                Pepe Fabra Valverde</h5>
                        </div>
                        <p
                            class="collaboratorDetails w-100 text-dark text-center pl-3 z-index-overlap-bottom overflow-hidden my-2">
                            <span class="collaboratorRole mt-3 mb-2 text-dark m-0">Administrator</span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 h-100 col-sm-12 page page5 m-0 center-elements flex-column">
        <div class="container text-center">
            <a href="/daw/" class="btn btn-lg btn-primary">Comenzar</a>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>