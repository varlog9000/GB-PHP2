<?
session_start();
define("MYSQL_SERVER","localhost");
define("MYSQL_LOGIN","root");
define("MYSQL_PASSWORD","");
define("MYSQL_DB","catalog");

define("DIR_BIG","img/");
define("DIR_SMALL","imgMini/");

define("COLS",3);

define('LIMIT_INCREMENT', 4); // Сколько будем подгружать строк с каждым нажатием кнопки "ЕЩЕ"

// Для отладки
function debug($param)
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}
