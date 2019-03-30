<?php
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'catalog');
define('DB_USER', 'root');
define('DB_PASS', '');
$tableName = 'goods';
define('LIMIT_INCREMENT', 3); // Сколько будем подгружать строк с каждым нажатием кнопки "ЕЩЕ"

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

// Для отладки
function debug($param)
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}


try {
    // Подключаем шаблон
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('goods_row.tmpl');


    // соединяемся с базой данных
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);


    isset($_GET['more']) ? $limit = $_SESSION['limit'] : $_SESSION['limit'] = null;
    $startLimit=$_SESSION['limit'] +1;
    $stopLimit=$startLimit+LIMIT_INCREMENT;
    $_SESSION['limit'] += LIMIT_INCREMENT;




    // теперь получаем данные из класса PDOStatement
    $goods = [];
    $result = $db->query("SELECT nameFull, param, price FROM $tableName LIMIT " . $_SESSION['limit']);
    while ($row = $result->fetch()) {
        $goods[] = $row;
    }


    // Выводим все в шаблон
    echo $template->render([
        'goods' => $goods,
        'link' => 'index.php?&more=' . $limit,
    ]);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}