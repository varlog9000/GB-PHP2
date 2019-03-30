<?php
include_once("configuration.php");
$id = (isset($_GET['id'])) ? $_GET['id'] : 'none';

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('view_image.tmpl');
    $image = sqlQueryViewPhotoAndIncrementHits($dbLink, $table, $id);; // выводим массив ассоциированных массивов
    echo $template->render(array(
        'image' => $image
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}

// Создаем функцию для генерации кода просмотра фотографии
function sqlQueryViewPhotoAndIncrementHits($dbLink, $table, $id)
{
    //  Делаем запрос, чтобы по id узнать путь к файлу и количество просомтров
    $sqlQuery = mysqli_query($dbLink, "SELECT id,path2large,hits FROM $table WHERE id='$id'");
//
    $fromImageDB = mysqli_fetch_array($sqlQuery); // выводим результат запроса в переменную
    $hits = $fromImageDB['hits'];
    // Для определения предыдущей и следующей ссылки сделаем запросы
    $sqlQueryNext = mysqli_query($dbLink, "SELECT id FROM $table WHERE ((hits='$hits' AND id> '$id') OR hits < '$hits') ORDER BY hits DESC, id ASC LIMIT 1");
    $sqlQueryPrev = mysqli_query($dbLink, "SELECT id FROM $table WHERE ((hits='$hits' AND id< '$id') OR hits > '$hits') ORDER BY hits ASC , id DESC LIMIT 1");
    // теперь каждый результат выборки присваиваем перемсенной и получаем id следующей/предыдущей картинки

    $fromImageDBnext = mysqli_fetch_array($sqlQueryNext);
    $nextLink = $fromImageDBnext['id'];

    $fromImageDBprev = mysqli_fetch_array($sqlQueryPrev);
    $prevLink = $fromImageDBprev['id'];

    // Если переменная не NULL тогда генерируем ссылку. Нужно для скрытия ссылок, когда мы в начале или в конце галереи

    if ($prevLink == NULL) {
        $sqlQueryPrev = mysqli_query($dbLink, "SELECT id FROM $table ORDER BY hits ASC , id DESC limit 1");
        $fromImageDBprev = mysqli_fetch_array($sqlQueryPrev);
        $prevLink = $fromImageDBprev['id'];
    }
    if ($nextLink == NULL) {
        $sqlQueryNext = mysqli_query($dbLink, "SELECT id FROM $table ORDER BY hits DESC , id ASC limit 1");
        $fromImageDBnext = mysqli_fetch_array($sqlQueryNext);
        $nextLink = $fromImageDBnext['id'];
    }


    ++$hits;
    //Загружаем количество хитов из таблицы и делаем инкремент
    mysqli_query($dbLink, "UPDATE $table SET hits='$hits' WHERE id='$id'"); // обновляем информацию в БД о просмотрах

    return ['name' => $fromImageDB['path2large'], 'hits' => $hits, 'prevId' => $prevLink, 'nextId' => $nextLink]; // выводим результат
}


 // вызываем функцию генерации кода




