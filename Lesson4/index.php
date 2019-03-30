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
    $template = $twig->loadTemplate('goods.tmpl');


    // соединяемся с базой данных
    $connect_str = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str, DB_USER, DB_PASS);

    // вставляем несколько строк в таблицу
//    $rows = $db->exec("INSERT INTO `testing` VALUES
//		(null, 'Ivan', 'ivan@test.com'),
//		(null, 'Petr', 'petr@test.com'),
//		(null, 'Vasiliy', 'vasiliy@test.com')
//	");

    // в случае ошибки SQL выражения выведем сообщене об ошибке

//    $error_array = $db->errorInfo();
//
//    if($db->errorCode() != 0000)
//
//        echo "SQL ошибка: " . $error_array[2] . '<br />';
//
//    // если запрос был выполнен успешно,
//    // то выведем количество затронутых строк
//
//    if($rows) echo "Количество затронутых строк: " . $rows. "<br />";
//
//    // теперь выберем несколько строчек из базы
//
//    $result = $db->query("SELECT * FROM `testing` LIMIT 2");
//
//    // в случае ошибки SQL выражения выведем сообщене об ошибке
//
//    $error_array = $db->errorInfo();
//
//    if($db->errorCode() != 0000)
//
//        echo "SQL ошибка: " . $error_array[2] . '<br /><br />';

//    isset();

    isset($_GET['more']) ? $limit = (int)$_GET['more'] : $limit = null;
    $limit += LIMIT_INCREMENT;


    // теперь получаем данные из класса PDOStatement
    $goods = [];
    $result = $db->query("SELECT nameFull, param, price FROM $tableName LIMIT $limit");
    while ($row = $result->fetch()) {
        $goods[] = $row;

    }


    // Выводим все в шаблон
    echo $template->render([
        'goods' => $goods,
        'link' => 'index.php?&more='.$limit,
    ]);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}