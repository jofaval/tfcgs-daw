<!--Page configuration-->
<?php $optionalCSS = ["floating-label.css", "inputs.css", "gantt.css"];?>
<?php $optionalScripts = ["js/gantt.js"];?>
<?php $title = "ProjectName - Gantt";?>
<?php $showFooter = true;?>
<?php $showHeader = true;?>
<?php $showBreadcrumb = true;?>
<?php
$breadcrumb = [
    [
        "name" => "Home",
        "link" => "index.php",
        "active" => false,
    ],
    [
        "name" => "Projects",
        "link" => "./projects/",
        "active" => false,
    ],
    [
        "name" => "ProjectName",
        "link" => "./project/id/name/",
        "active" => false,
    ],
    [
        "name" => "Gantt",
        "link" => "./project/id/name/gantt/",
        "active" => true,
    ],
];
?>

<?php ob_start()?>

<table class="table mb-0 w-100 table-dark table-bordered">
    <thead class="thead-dark">
        <tr class="weekDays">
            <th class="nonRotatedText" colspan="5">Days</th>
            <th>Monday, 1</th>
            <th>Tuesday, 2</th>
            <th>Wednesday, 3</th>
            <th>Thursday, 4</th>
            <th>Friday, 5</th>
            <th>Satday, 6</th>
            <th>Sunday, 7</th>
            <th>Monday, 8</th>
            <th>Tuesday, 9</th>
            <th>Wednesday, 10</th>
            <th>Thursday, 11</th>
            <th>Friday, 12</th>
            <th>Satday, 13</th>
            <th>Sunday, 14</th>
            <th>Monday, 15</th>
            <th>Tuesday, 16</th>
            <th>Wednesday, 17</th>
            <th>Thursday, 18</th>
            <th>Friday, 19</th>
            <th>Satday, 20</th>
            <th>Sunday, 21</th>
            <th>Monday, 22</th>
            <th>Tuesday, 23</th>
            <th>Wednesday, 24</th>
            <th>Thursday, 25</th>
            <th>Friday, 26</th>
            <th>Satday, 27</th>
            <th>Sunday, 28</th>
            <th>Monday, 29</th>
            <th>Tuesday, 30</th>
            <th>Wednesday, 1</th>
            <th>Thursday, 2</th>
            <th>Friday, 3</th>
            <th>Satday, 4</th>
            <th>Sunday, 5</th>
            <th>Monday, 6</th>
            <th>Tuesday, 7</th>
            <th>Wednesday, 8</th>
            <th>Thursday, 9</th>
            <th>Friday, 10</th>
            <th>Satday, 11</th>
            <th>Sunday, 12</th>
            <th>Monday, 13</th>
            <th>Tuesday, 14</th>
            <th>Wednesday, 15</th>
            <th>Thursday, 16</th>
            <th>Friday, 17</th>
            <th>Satday, 18</th>
            <th>Sunday, 19</th>
            <th>Monday, 20</th>
            <th>Tuesday, 21</th>
            <th>Wednesday, 22</th>
            <th>Thursday, 23</th>
            <th>Friday, 24</th>
            <th>Satday, 25</th>
            <th>Sunday, 26</th>
            <th>Monday, 27</th>
            <th>Tuesday, 28</th>
            <th>Wednesday, 29</th>
            <th>Thursday, 30</th>
        </tr>
        <tr>
            <th class="align-middle" id="titles">Task titles</th>
            <th class="align-middle">Starting day</th>
            <th class="align-middle">Ending day</th>
            <th class="align-middle">Progress</th>
            <th class="align-middle">Days span</th>
            <th colspan="30" class="text-center align-middle">March</th>
            <th colspan="30" class="text-center align-middle">April</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<?php $contenido = ob_get_clean()?>

<?php include_once 'layout.php'?>