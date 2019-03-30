<?php
include_once("configuration.php");
include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $loader = new Twig_Loader_Filesystem('templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('gallery_public.tmpl');

    $imageArray = sqlQueryAndRenderListImage($dbLink, $table); // выводим массив ассоциированных массивов

    echo $template->render(array(
        'images' => $imageArray
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}

function sqlQueryAndRenderListImage($dbLink, $table)
{
    // Читаем всю таблицу в БД отсортированную по просмотрам по-убыванию и id по-возрастанию
    $sqlQuery = mysqli_query($dbLink, "SELECT * FROM $table ORDER BY hits DESC, id ASC ");
    $galleryArray = [];

    while ($fromImageDB = mysqli_fetch_array($sqlQuery)) {
        $galleryArray[] = $fromImageDB;
    }
    return $galleryArray;
}


//function sqlQueryAndRenderListImage($dbLink, $table)
//{
//    // Читаем всю таблицу в БД отсортированную по просмотрам по-убыванию и id по-возрастанию
//    $sqlQuery = mysqli_query($dbLink, "SELECT * FROM $table ORDER BY hits DESC, id ASC ");
//    $renderCode = '';
//    // Рендрим код вывода картинок
//    while ($fromImageDB = mysqli_fetch_array($sqlQuery)) {
//        $renderCode .= '<div class="image"><a class="pictures" rel="gallery" href="viewimage.php?id=' . $fromImageDB['id'] . '"><img src="' . $fromImageDB['path2thumb'] . '"><br></a><div class="hits"><i class="icon icon-eye">' . $fromImageDB['hits'] . '</i> </div></div>';
//    }
//    return $renderCode;
//}




