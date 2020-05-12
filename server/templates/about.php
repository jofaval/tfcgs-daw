<!--Page configuration-->
<?php $optionalCSS = ["about.css"];?>
<?php $optionalScripts = ["js/about.js"];?>
<?php $title = "About";?>
<?php $showFooter = false;?>
<?php $showHeader = false;?>
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
        "name" => "Acerca de ",
        "link" => "/daw/about/",
        "active" => true,
        "icon" => "info",
    ],
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="description" content="Origen">
    <link rel="shortcut icon" href="/daw/img/branding/favicon-16x16.png" type="image/png">
    <link rel="shortcut icon" href="/daw/img/branding/favicon-32x32.png" type="image/png">
    <link rel="shortcut icon" href="/daw/img/branding/favicon-96x96.png" type="image/png">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Acerca de Origen</title>
    <link rel="stylesheet" href="/daw/styles/about.css">
</head>

<body>
    <!--
        Arreglar css
        https://www.w3schools.com/howto/tryhow_css_parallax_demo.htm
        https://codepen.io/Kalyan_Lahkar/pen/wpeaJx
    -->
    <div class="navigation">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">Sobre nosotros</a></li>
            <li><a href="#pricing">Precios</a></li>
            <li><a href="#team">Equipo</a></li>
            <li><a href="#faqs">FAQs</a></li>
            <li><a href="#get_started">Comienza</a></li>
        </ul>
        <input type="checkbox" name="menuDisplay" id="menuDisplay">
    </div>
    <div id="home" class="parallax_section_1">
        <div class="caption">
            <span class="border">Origen</span>
        </div>
    </div>


    <div id="about">
        <div>
            <h3>¿Qué es origen?</h3>
            <br>
            <p>Se pretende proporcionar una gestión básica de cualquier tipo de proyecto con un conjunto de herramientas
                unificadas en una única plataforma de modo que todo sea más intuitivo y práctico.</p>
        </div>
    </div>


    <div id="pricing" class="parallax_section_2">
        <div class="caption">
            <span class="border">PRECIOS</span>
        </div>
    </div>

    <div class="content_block">
        <div class="detail_shape"></div>
        <div class="pricings">
            <div class="pricing_card jadeite">
                <div>
                    <p>
                        Jadeita
                    </p>
                    <h3>
                        Plan gratis! <br> <strong>0€/mes</strong>
                    </h3>
                    <ul>
                        <li>Acceso al tablero</li>
                        <li>Acceso a proyectos compartidos</li>
                    </ul>
                </div>
                <a href="#0">
                    Comprar
                </a>
            </div>
            <div class="pricing_card entropy">
                <div>
                    <p>
                        Entropía
                    </p>
                    <h3>
                        Plan profesional <br> <strong>9.95€/mes</strong>
                    </h3>
                    <ul>
                        <li>Acceso a todas las ventajas del <strong class="draconic">draconic</strong></li>
                        <li>Crea tus propios estilos de texto</li>
                        <li>Compartelo con quien quieras</li>
                        <li>Crea proyectos ilimitados</li>
                        <li>Gestor de proyecto más avanzado</li>
                        <li>Cambia el color de la aplicación a tu gusto</li>
                    </ul>
                </div>
                <a href="#0">
                    Comprar
                </a>
            </div>
            <div class="pricing_card draconic">
                <div>
                    <p>
                        Dracónico
                    </p>
                    <h3>
                        Plan principiante<br> <strong>4.95€/mes</strong>
                    </h3>
                    <ul>
                        <li>Acceso a todas las ventajas de <strong class="jadeite">jadeita</strong></li>
                        <li>Acceso al gestor de proyectos</li>
                        <li>Crea hasta proyectos</li>
                        <li>Comparte cada proyecto con hasta 5 personas</li>
                    </ul>
                </div>
                <a href="#0">
                    Comprar
                </a>
            </div>
        </div>
    </div>

    <div id="team" class="parallax_section_3">
        <div class="caption">
            <span class="border">EQUIPO DE DESARROLLO</span>
        </div>
    </div>

    <div class="content_block">
        <div class="detail_shape"></div>
        <div class="team">
            <div class="row">
                <div class="card">
                    <img src="/daw/img/default.png" alt="">
                    <h2>Pepe Fabra Valverde</h2>
                    <h3>CEO & Fundador</h3>
                </div>
                <div class="card">
                    <img src="/daw/img/default.png" alt="">
                    <h2>Pepe Fabra Valverde</h2>
                    <h3>Jefe de desarrollo</h3>
                </div>
                <div class="card">
                    <img src="/daw/img/default.png" alt="">
                    <h2>Pepe Fabra Valverde</h2>
                    <h3>Diseñador gráfico</h3>
                </div>
                <div class="card">
                    <img src="/daw/img/default.png" alt="">
                    <h2>Pepe Fabra Valverde</h2>
                    <h3>Jefe de marketing</h3>
                </div>
            </div>
        </div>
    </div>

    <div id="faqs" class="parallax_section_2">
        <div class="caption">
            <span class="border">FAQs</span>
        </div>
    </div>
    <div class="content_block">
        <div class="detail_shape"></div>
        <div style="padding: 5rem !important;">
            <button class="accordion" style="border-radius: 0 !important;">Pregunta genérica 1</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                    blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                    consequuntur delectus voluptate.</p>
            </div>
            <button class="accordion" style="border-radius: 0 !important;">Pregunta genérica 2</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                    blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                    consequuntur delectus voluptate.</p>
            </div>
            <button class="accordion" style="border-radius: 0 !important;">Pregunta genérica 3</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                    blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                    consequuntur delectus voluptate.</p>
            </div>
            <button class="accordion" style="border-radius: 0 !important;">Pregunta genérica 4</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                    blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                    consequuntur delectus voluptate.</p>
            </div>
            <button class="accordion" style="border-radius: 0 !important;">Pregunta genérica 5</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                    blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                    consequuntur delectus voluptate.</p>
            </div>
        </div>
    </div>

    <div id="get_started" class="parallax_section_4">
        <div class="caption">
            <span class="border"><a href="/daw/">¡VAMOS A EMPEZAR!</a></span>
        </div>
    </div>
</body>
<script src="/daw/scripts/js/about.js"></script>

</html>