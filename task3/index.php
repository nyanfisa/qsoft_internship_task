<?php 
require_once $_SERVER['DOCUMENT_ROOT'] . "/src/core.php";
$isAuthorised = isAuthorised();
includeTemplate("header.php", ['title' => 'Выборка из таблиц', 'isAuthorised' => $isAuthorised]); 

$companyGoods = [];
$goodsByColorAndCo = [];
$getCoByGoodsColor = [];


if (!empty($_GET) && isset($_GET['getCompanyGoods'])) { 
    $companyId = trim($_GET['companyId1'] ?? '');

    $companyGoods = getGoodsByCompany((int)$companyId); 
}
?>
<!--ПЕРВАЯ ФОРМА-->
            <div class="content">
                <p>Есть Фирмы, Товары и Цвета. Каждая фирма производит свои уникальные товары. При этом любой товар может быть представлен в любых цветах.</p>
                
                <p>Каждая форма работает отдельно друг от друга</p>

                <section class="section box">

                    <p class="subtitle">Форма 1</p>
                    <p>Выберите все товары (названия) указанной фирмы (по id фирмы)</p>
                    <form method="GET">
                        <div class="field">
                            <label class="label">id Фирмы</label>
                            <div class="control">
                                <input name = 'companyId1' class="input" type="text" placeholder="id...">
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button name = 'getCompanyGoods' class="button is-link">Посчитать</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <p class="subtitle">Результат</p>
                    <div>
                        <?php if(!empty($companyGoods)): ?>
                            <p>
                                <?= htmlspecialchars(implode(', ', array_column($companyGoods, 'name'))) ?>
                            </p>
                        <?php else: ?>
                            <p>Нет данных</p>
                        <?php endif; ?>    
                    </div>
                </section>
              
              
<!--Вторая форма-->
<?php 
if (!empty($_GET) && isset($_GET['getGoodsByColorAndCo'])) { 
    $companyId = trim($_GET['companyId2'] ?? '');
    $colorId = trim($_GET['colorId2'] ?? '');

    var_dump($companyId, $colorId);

    $goodsByColorAndCo = getGoodsByColorAndComp((int)$companyId, (int)$colorId); 
    
}
?>
  

                <section class="section box">
                    <p class="subtitle">Форма 2</p>
                    <p>Выберите все товары (названия) определенного цвета у указанной фирмы (по id цвета и id фирмы)</p>
                    <form method="GET">
                        <div class="field">
                            <label class="label">id Фирмы</label>
                            <div class="control">
                                <input name = 'companyId2' class="input" type="text" name="firm" placeholder="id...">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">id цвета</label>
                            <div class="control">
                                <input name = 'colorId2' class="input" type="text" name="color" placeholder="id...">
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button name = 'getGoodsByColorAndCo' class="button is-link">Выбрать</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <p class="subtitle">Результат</p>
                    <div>
                    
                        <?php if(!empty($goodsByColorAndCo)): ?>
                        <p>
                            <?= htmlspecialchars(implode(', ', array_column($goodsByColorAndCo, 'name'))) ?>
                        </p>
                    <?php else: ?>
                        <p>Нет данных</p>
                    <?php endif; ?>    
                    
                    </div>
                </section>

<!--Третья форма-->

<?php
if (!empty($_GET) && isset($_GET['getCoByGoodsColor'])) { 
    $colorId = trim($_GET['colorId3'] ?? '');

    var_dump($colorId);

    $getCoByGoodsColor = getCompanyByGoodsColor((int)$colorId); 
    
}
?>


                <section class="section box">
                    <p class="subtitle">Форма 3</p>
                    <p>Выберите все фирмы (названия), у которых есть товары определенного цвета</p>
                    <form method="GET">
                        <div class="field">
                            <label class="label">id цвета</label>
                            <div class="control">
                                <input name = 'colorId3' class="input" type="text" name="color" placeholder="id...">
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button name = 'getCoByGoodsColor' class="button is-link">Выбрать</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <p class="subtitle">Результат</p>
                    <div>
                        <?php if(!empty($getCoByGoodsColor)): ?>
                            <p>
                                <?= htmlspecialchars(implode(', ', array_column($getCoByGoodsColor, 'name'))) ?>
                            </p>
                        <?php else: ?>
                            <p>Нет данных</p>
                        <?php endif; ?>
                    </div>
                </section>

            </div>
<?php includeTemplate("footer.php"); ?><!--FOOTER INCLUDE--> 
