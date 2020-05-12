<!--Page configuration-->
<?php $optionalCSS = ["about.css"];?>
<?php $optionalScripts = ["js/about.js"];?>
<?php $title = "Example";?>
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
        "name" => "Acerca de ",
        "link" => "/daw/about/",
        "active" => true,
        "icon" => "info",
    ],
];
?>

<?php ob_start()?>

<!--
        Arreglar css
        https://www.w3schools.com/howto/tryhow_css_parallax_demo.htm
        https://codepen.io/Kalyan_Lahkar/pen/wpeaJx
    -->
<div class="navigation">
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#team">Team</a></li>
        <li><a href="#faqs">FAQs</a></li>
        <li><a href="#get_started">Get Started</a></li>
    </ul>
    <input type="checkbox" name="menuDisplay" id="menuDisplay">
</div>
<div id="home" class="parallax_section_1">
    <div class="caption">
        <span class="border">Life organizer</span>
    </div>
</div>


<div id="about">
    <div>
        <h3>What's life organizer?</h3>
        <br>
        <p>Life organizer is a project developed by one person with the idea behind of making life eaiser by
            providing
            tools that help us manage
            the chaos we may live from time to time; life includes work, family and friends, personal projects but
            also
            some bussiness projects. This won't automatically create and do life for you, that's not about it, but
            it
            will be an extra help.</p>
    </div>
</div>


<div id="pricing" class="parallax_section_2">
    <div class="caption">
        <span class="border">PRICING</span>
    </div>
</div>

<div class="content_block">
    <div class="detail_shape"></div>
    <div class="pricings">
        <div class="pricing_card jadeite">
            <div>
                <p>
                    Jadeite
                </p>
                <h3>
                    FREE plan! <br> <strong>0€/month</strong>
                </h3>
                <ul>
                    <li>Access to the to-do list</li>
                    <li>Access to the friends network</li>
                    <li>Access to shared projects</li>
                </ul>
            </div>
            <a href="#0">
                Buy
            </a>
        </div>
        <div class="pricing_card entropy">
            <div>
                <p>
                    Entropy
                </p>
                <h3>
                    PRO plan <br> <strong>9.95€/month</strong>
                </h3>
                <ul>
                    <li>Access to all the <strong class="draconic">draconic</strong> plan's perks</li>
                    <li>Create your own text styles</li>
                    <li>Shareble to everyone you want</li>
                    <li>Create unlimited projects</li>
                    <li>More advanced project manager</li>
                    <li>Customize the app color theme</li>
                </ul>
            </div>
            <a href="#0">
                Buy
            </a>
        </div>
        <div class="pricing_card draconic">
            <div>
                <p>
                    Draconic
                </p>
                <h3>
                    Start plan<br> <strong>4.95€/month</strong>
                </h3>
                <ul>
                    <li>Access to all the <strong class="jadeite">jadeite</strong>'s perks</li>
                    <li>Access to the project manager</li>
                    <li>Create up to 5 projects</li>
                    <li>Shareble up to 3 persons, each project</li>
                </ul>
            </div>
            <a href="#0">
                Buy
            </a>
        </div>
    </div>
</div>

<div id="team" class="parallax_section_3">
    <div class="caption">
        <span class="border">DEVELOPMENT
            TEAM</span>
    </div>
</div>

<div class="content_block">
    <div class="detail_shape"></div>
    <div class="team">
        <div class="row">
            <div class="card">
                <img src="/daw/img/default.png" alt="">
                <h2>Pepe Fabra Valverde</h2>
                <h3>CEO & Founder</h3>
            </div>
            <div class="card">
                <img src="/daw/img/default.png" alt="">
                <h2>Pepe Fabra Valverde</h2>
                <h3>Main Developer</h3>
            </div>
            <div class="card">
                <img src="/daw/img/default.png" alt="">
                <h2>Pepe Fabra Valverde</h2>
                <h3>Graphic Designer</h3>
            </div>
            <div class="card">
                <img src="/daw/img/default.png" alt="">
                <h2>Pepe Fabra Valverde</h2>
                <h3>Marketing Manager</h3>
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
        <button class="accordion" style="border-radius: 0 !important;">Generic question number 1</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                consequuntur delectus voluptate.</p>
        </div>
        <button class="accordion" style="border-radius: 0 !important;">Generic question number 2</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                consequuntur delectus voluptate.</p>
        </div>
        <button class="accordion" style="border-radius: 0 !important;">Generic question number 3</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                consequuntur delectus voluptate.</p>
        </div>
        <button class="accordion" style="border-radius: 0 !important;">Generic question number 4</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                consequuntur delectus voluptate.</p>
        </div>
        <button class="accordion" style="border-radius: 0 !important;">Generic question number 5</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium suscipit placeat soluta quae
                blanditiis nulla iusto aliquid nostrum, hic itaque dicta in non vero. Expedita quos sint
                consequuntur delectus voluptate.</p>
        </div>
    </div>
</div>

<div id="get_started" class="parallax_section_4">
    <div class="caption">
        <span class="border"><a href="">LET'S GET STARTED!</a></span>
    </div>
</div>



<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>