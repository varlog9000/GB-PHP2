<?php
// Укажите хост БД, ее имя пользователя и пароль.
// Укажите название БД и таблицы, если их нет на хосте БД, они будут созданы при первом запуске!
define('DB_HOST', 'localhost',true);
define('DB_USER','mysql',true);
define('DB_PASSWORD','mysql',true);
define('DB_NAME', 'imagegallery',true);
define('DB_IMAGE_TABLE', 'image', true);

//=============================================================================================

$dbName=DB_NAME;
$table=DB_IMAGE_TABLE;
// Тестовое соединение для проверки наличия БД
$testLinkDB=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) or die('Could not connect: ' . mysqli_error());
// Проверяем наличие БД. Если нет, то создаем.
mysqli_select_db($testLinkDB,$dbName) or mysqli_query($testLinkDB, "CREATE DATABASE $dbName");
mysqli_select_db($testLinkDB,$dbName);
if (!mysqli_query($testLinkDB, "SELECT * FROM $table")) {
    echo "Таблицы нет в базе нет!, создаем<br>";
    mysqli_query($testLinkDB, "CREATE TABLE $table(
id int NOT NULL AUTO_INCREMENT,
path2large varchar(255) NULL DEFAULT '',
path2thumb varchar(255) NULL DEFAULT '',
hits int DEFAULT '0',
datetime  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
PRIMARY KEY (`id`))"
    );
    echo 'Таблица и база данных созданы, переходите в админку и наполните галерею фотографиями';
}
// Отключаем тестовое соединение
mysqli_close($testLinkDB);
// Включаем боевое боевое соединение
$dbLink = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(mysqli_connect_error());

function converter2translitAndSpase($txt)
{
    $patterns = [
        'а' => 'a', 'б' => 'b', 'в' => 'v',
        'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u',
        'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
        'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',
        'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

        'А' => 'A', 'Б' => 'B', 'В' => 'V',
        'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'Y', 'К' => 'K',
        'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U',
        'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
        'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
    ];
    return strtolower(strtr(strtr($txt, $patterns), " ", "_"));
}