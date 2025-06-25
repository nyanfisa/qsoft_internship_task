<?php
session_start();

include "includeTemplate.php";

function isAuthorised(): bool
{
    return isset($_SESSION['auth']) &&
     ($_SESSION['auth'] === true);
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/src/database.php';

function getMenuItems(bool $isAuthorised){

    $menu = [
        ['title' => 'Главная страница', 'path' => '/'], 
        ['title' => 'Задание 1', 'path' => '/task1'],
        ['title' => 'Задание 2', 'path' => '/task2', 'requires_auth' => true],
        ['title' => 'Задание 3', 'path' => '/task3', 'requires_auth' => true],
    ];
    $activeUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //текущ урл 

    $filteredMenu = [];
    //скрываем Каталог от неаторизованных юзеров
    foreach ($menu as $item) {
        if (! empty($item['requires_auth']) && !$isAuthorised) {//Скрытый от неаторизованных пользователей пункт меню и юзер не авторизован
            continue; // пропускаем его и не выводим в меню
        }
        $item['is_active'] = rtrim($activeUrl, '/') === rtrim($item['path'], '/');
        
        $filteredMenu[] = $item;

    }
    return $filteredMenu;
}

function formatPrice($priceRub, $currency) {
    switch ($currency) {
        case 'usd':
            $price = $priceRub * 0.013;
            return number_format($price, 2, '.', ',') . '$';
        case 'eur':
            $price = $priceRub * 0.011;
            return number_format($price, 2, ',', ' ') . '€'; 
        case 'yen':
            $price = $priceRub * 1.86;
            return number_format($price, 2, ',', '') . '¥'; 
        case 'rub':
        default:
            return number_format($priceRub, 2, '', ' ') . '₽'; 
    }

}


function getGoodsByCompany($companyId) {
    $connection = connectToDB();
    $query = $connection -> prepare('
       SELECT g.name
       FROM goods g
       JOIN company_goods cg ON g.id = cg.good_id
       WHERE cg.company_id = :companyId;
    ');

    $query->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC) ?: [];

}


function getGoodsByColorAndComp($companyId, $colorId) {
    $connection = connectToDB();
    $query = $connection -> prepare('
       SELECT g.name
       FROM goods g
       JOIN good_colors gc ON g.id = gc.good_id
       JOIN company_goods cg ON g.id = cg.good_id
       WHERE cg.company_id = :companyId AND gc.color_id = :colorId;
    ');

    $query->bindParam(':companyId', $companyId, PDO::PARAM_INT);
    $query->bindParam(':colorId', $colorId, PDO::PARAM_INT);

    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC) ?: [];

}

function getCompanyByGoodsColor($colorId) {
    $connection = connectToDB();
    $query = $connection -> prepare('
       SELECT c.name
       FROM companies c
       JOIN company_goods cg ON c.id = cg.company_id
       JOIN good_colors gc ON cg.good_id = gc.good_id
       WHERE gc.color_id = :colorId;
    ');

    $query->bindParam(':colorId', $colorId, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC) ?: [];

}

function logout(): void 
{
    setcookie( //очищаем значение куки
        session_name(), //phpsessid
        '', // очищает id сессионной куки
        time() - 3600, //время истечения в прошлом => удаление
        '/' //путь действия - на весь сайт
    );
    session_destroy(); //удалаяются значения из переменных $_SESSION['auth'], $_SESSION['email'] и тд. НЕ удаляет сессионную куку
}
if(isset($_GET['logout']) && $_GET['logout'] === 'yes'){
    logout();
    header('Location: /');
    exit;
}