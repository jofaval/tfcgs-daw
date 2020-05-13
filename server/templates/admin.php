<!--Page configuration-->
<?php $optionalCSS = ["style.css"];?>
<?php $optionalScripts = ["js/admin.js"];?>
<?php $title = "Admin";?>
<?php $showFooter = false;?>
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
        "name" => "Admin",
        "link" => "/daw/admin/",
        "active" => true,
        "icon" => "cogs",
    ],
];
?>

<?php ob_start()?>

<div class="w-100 h-100 d-flex">
    <div class=" bg-dark" id="sidebar">
        <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-dark" role="tab" id="headingTwo1">
                    <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                        <h5 class="mb-0">
                            Rutas <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseTwo1" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
                    data-parent="#accordionEx1">
                    <div class="card-body rgba-black-light text-white">
                        <div class="card-header">
                            <a href="/daw/admin/new-route/">
                                <h5 class="mb-0 text-white">
                                    Añadir nueva ruta
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a href="/daw/admin/access-level/">
                                <h5 class="mb-0 text-white">
                                    Cambiar nivel de acceso
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-dark" role="tab" id="headingTwo2">
                    <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseTwo21" aria-expanded="false" aria-controls="collapseTwo21">
                        <h5 class="mb-0">
                            Codificación <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseTwo21" class="collapse" role="tabpanel" aria-labelledby="headingTwo21"
                    data-parent="#accordionEx1">
                    <div class="card-body rgba-black-light text-white">
                        <div class="card-header">
                            <a href="/daw/admin/popo/">
                                <h5 class="mb-0 text-white">
                                    Panel de configuración de POPOs
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a href="/daw/admin/testing/">
                                <h5 class="mb-0 text-white">
                                    Ventana de testing
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a href="/daw/admin/download-database/">
                                <h5 class="mb-0 text-white">
                                    Descargarse script de SQL
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-transparent shadow-none">
                <div class="card-header bg-dark" role="tab" id="headingThree31">
                    <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordionEx1"
                        href="#collapseThree31" aria-expanded="false" aria-controls="collapseThree31">
                        <h5 class="mb-0">
                            Collapsible Group Item #3 <i class="fa fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <div id="collapseThree31" class="collapse" role="tabpanel" aria-labelledby="headingThree31"
                    data-parent="#accordionEx1">
                    <div class="card-body rgba-black-light text-white">
                        <div class="card-header">
                            <a href="#collapseTwo1">
                                <h5 class="mb-0 text-white">
                                    Elemento
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a href="#collapseTwo1">
                                <h5 class="mb-0 text-white">
                                    Elemento
                                </h5>
                            </a>
                        </div>
                        <div class="card-header">
                            <a href="#collapseTwo1">
                                <h5 class="mb-0 text-white">
                                    Elemento
                                </h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>