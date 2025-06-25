<?php
function connectToDB(): PDO
{
    static $connection = null;

    if (null !== $connection) {
        return $connection;
    }

   // $config = loadConfig('database');
    $hostname = 'localhost';
    $username ='php_user_test'; 
    $password = 'pass';
    $database = 'test_db';

    try { 
        $connection = new PDO(
        "mysql:host=$hostname;dbname=$database",
        $username, 
        $password,
        );
    } catch (PDOException $i) 
    {
        die('Ошибка подключения к базе данных');
    }
    return $connection;
}

function dbErrorCheck($query) 
{
    $errInfo = $query->errorInfo(); //выводит массив, поэтому в строчке ниже обращаемся как к массиву

    if ($errInfo[0] !== PDO::ERR_NONE) { //если ошибка найдена
    echo $errInfo[2]; //сообщение об ошибке
    exit();
    }
    return true;
}
