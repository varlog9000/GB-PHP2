<?php

include_once "config/db.php";

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

isset($_GET['more']) ? $_SESSION['limit'] += LIMIT_INCREMENT : $_SESSION['limit'] = LIMIT_INCREMENT;
//if (isset($_GET['more'])) {
//
//    $_SESSION['limit'] += LIMIT_INCREMENT;
//} else {
//
//    $_SESSION['limit'] = LIMIT_INCREMENT;
//}
//debug(isset($_GET['more']));
//echo $_SESSION['limit'];
try {
    // Подключаем шаблон
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('goods.tmpl');

    // соединяемся с базой данных
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);


//    $_SESSION['limit'] += LIMIT_INCREMENT;


    // теперь получаем данные из класса PDOStatement
    $goods = [];
    $SQL_Query = "SELECT nameFull, param, price FROM $tableName LIMIT ".$_SESSION['limit'];
    $result = $db->query($SQL_Query);
    while ($row = $result->fetch()) {
        $goods[] = $row;
    }

//    debug(isset($_GET['more']));
//    echo $_SESSION['limit'];

    // Выводим все в шаблон
    echo $template->render([
        'goods' => $goods,
        'link' => 'index.php?&more',
    ]);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}