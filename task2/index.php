<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/core.php";
includeTemplate("header.php", ['title' => 'Каталог авто', 'isAuthorised' => isAuthorised()]);
require_once $_SERVER['DOCUMENT_ROOT'] . ('/data/cars.php');
require_once $_SERVER['DOCUMENT_ROOT'] . ('/data/currencies.php');

?>

            <div class="content">
                <p class="subtitle">Необходимо интегрировать верстку страницы каталога</p>
                <p>Список элементов каталога указан в файле cars.php</p>
                <p>При клике на соответствующий переключатель происходит перезагрузка страницы и должен быть выведен каталог с форматом цен, соответствующим выбранной валюте</p>
                <p>Если не выбран ни один из переключателей - выводится формат в рублях</p>
                <p>Формат цен для некоторых валют:</p>
                <ol>
                    <li>Рубли - тысячи отделяются пробелом (например, 1 221 900 ₽)</li>
                    <li>Доллары - тысячи - запятой, центы - точкой (например, 19,403.47 $)</li>
                    <li>Евро - тысячи - пробелом, евроценты - запятой (например, 26 831,28 €)</li>
                </ol>
                <i>Учтите, что набор валют (вкладки) и форматы цен в будущем могут меняться. При изменении набора должны меняться и вкладки, и цены элементов.</i>
                <hr>
                
                <div class="tabs is-boxed is-centered">
                    <ul class="ml-0">
                        <?php $selectedCurrency = $_GET['currency'] ?? 'rub'; ?> <!-- рубли по умолчанию-->
                        
                        <?php foreach ($currencies as $currency): ?>
                            <?php includeTemplate('currencies.php', [
                                'currency' => $currency, 
                                'selectedCurrency' => $selectedCurrency
                            ]); ?>
                        <?php endforeach; ?>    
                    </ul>
                </div>
                
                

                <?php foreach ($cars as $car) { ?>
                    <?php includeTemplate('car_item.php', ['car' => $car, 'currency' => $selectedCurrency]); ?>
                <?php } ?>

                <hr>
            </div>
<?php includeTemplate("footer.php"); ?><!--FOOTER INCLUDE--> 