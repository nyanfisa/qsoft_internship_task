<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/core.php";
includeTemplate("header.php", ['title' => 'Главная страница', 'isAuthorised' => isAuthorised()]); 
?>

            <div class="content">
                <p>Добро пожаловать тестовый сайт</p>
            </div>
<?php includeTemplate("footer.php"); ?><!--FOOTER INCLUDE--> 