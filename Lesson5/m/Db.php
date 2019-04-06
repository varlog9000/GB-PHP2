<?php
session_start();
define('DB_DRIVER', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'catalog');
define('DB_USER', 'root');
define('DB_PASS', '');
$tableName = 'goods';
define('LIMIT_INCREMENT', 3); // Сколько будем подгружать строк с каждым нажатием кнопки "ЕЩЕ"

// Для отладки
function debug($param)
{
    echo '<pre>';
    print_r($param);
    echo '</pre>';
}