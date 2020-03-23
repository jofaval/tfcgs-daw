<!--Configuration-->
<?php
require_once __DIR__ . "/../../server/libs/utils.php";
header("Content-type: text/css; charset: UTF-8");
$showHeader = Utils::getCleanedData("showHeader") != "0";
$showBreadcrumb = Utils::getCleanedData("showBreadcrumb") != "0";
$showFooter = Utils::getCleanedData("showFooter") != "0";
?>

<?php if ($showHeader): ?>
body>.navbar {
grid-area: header;
}
<?php endif;?>

<?php if ($showBreadcrumb): ?>
body>.breadcrumbContainer {
grid-area: breadcrumb;
}
<?php endif;?>

<?php if ($showFooter): ?>
body>.footer {
grid-area: footer;
}
<?php endif;?>

body {
display: grid;
grid-template-areas:
<?php if ($showHeader): ?>
"header"
<?php endif;?>
<?php if ($showBreadcrumb): ?>
"breadcrumb"
<?php endif;?>
"main"
<?php if ($showFooter): ?>
"footer";
<?php endif;?>

grid-template-rows:
<?php if ($showHeader): ?>
71px
<?php endif;?>
<?php if ($showBreadcrumb): ?>
48px
<?php endif;?>
auto
<?php if ($showFooter): ?>
56px;
<?php endif;?>
}

body>main {
grid-area: main;
}