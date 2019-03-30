<?php
define('DB_DRIVER','mysql');
define('DB_HOST','localhost');
define('DB_NAME','test');
define('DB_USER','root');
define('DB_PASS','');
define('TABLE_NAME','goods');

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try
{

    $loader = new Twig_Loader_Filesystem('templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('goods.tmpl');


    // соединяемся с базой данных

    $connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
    $db = new PDO($connect_str,DB_USER,DB_PASS);

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

    // теперь получаем данные из класса PDOStatement

    while($row = $result->fetch())
    {
        // в результате получаем ассоциативный массив
        print_r($row);
    }



    echo $template->render(array (
        'nav' => $nav,
        'updated' => '24 Jan 2011'
    ));
}
catch(PDOException $e)
{
    die("Error: ".$e->getMessage());
}