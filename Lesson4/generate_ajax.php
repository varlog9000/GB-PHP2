<?php
include_once "config/db.php";

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

if (isset($_GET['more'])) {
//    $startLimit = $_SESSION['limit'] ;
//    $stopLimit = $startLimit + LIMIT_INCREMENT ;
//    echo "$startLimit $stopLimit " . $_SESSION['limit'];
    $SQL_Query = "SELECT nameFull, param, price FROM $tableName LIMIT ".$_SESSION['limit'].','. LIMIT_INCREMENT ;
//    echo $SQL_Query;
    $_SESSION['limit'] += LIMIT_INCREMENT;
//    echo " $SQL_Query";

    try {
        // Подключаем шаблон
        $loader = new Twig_Loader_Filesystem('templates');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('goods_row.tmpl');

        // соединяемся с базой данных
        $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
        $db = new PDO($connect_str, DB_USER, DB_PASS,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // теперь получаем данные из класса PDOStatement
        $goods = [];

        $result = $db->query($SQL_Query);

        while ($row = $result->fetch()) {
            $goods[] = $row;
        }
        // Выводим все в шаблон
        echo $template->render([
            'goods' => $goods,
        ]);
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
//debug($goods);