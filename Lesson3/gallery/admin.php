<?php
include_once("configuration.php"); // подключаем файл конфигурации
// определяем переменные
$thumbDir = "photo";
$thumbPrefix = 'thumb_';
$photoDir = "photo";
$path = $photoDir . "/" . converter2translitAndSpase($_FILES['photo']['name']);
$thumbTempPath = $thumbDir . "/tmp_" . converter2translitAndSpase($_FILES['photo']['name']);
$thumbPath = $thumbDir . "/" . $thumbPrefix . converter2translitAndSpase($_FILES['photo']['name']);
$uploaded = false;
// Проверяем есть ли в массиве ГЕТ параметры и если есть присваиваем их переменным
$action = (isset($_GET['action'])) ? $_GET['action'] : 'none';
$id = (isset($_GET['id'])) ? $_GET['id'] : 'none';

// Выполняем операции с файлом, если он был загружен
//    print_r($thumbsImage);
if ($_FILES['photo']['tmp_name'] != NULL) {
    $mimeType = mime_content_type($_FILES['photo']['tmp_name']);
    if (in_array($mimeType, array('image/jpeg', 'image/gif', 'image/png'))) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
// Делаем копию загруженной фотографии для создания превьюшки
            copy($path, $thumbTempPath);
// Для этого: Определяем размер фотографии — ширину и высоту
            $size = GetImageSize($thumbTempPath);
//            print_r($size);
//Создаём новое изображение из «старого»
            $src = ImageCreateFromJPEG($thumbTempPath);
//Берём числовое значение ширины фотографии, которое мы получили в первой строке и записываем это число в переменную
            $iw = $size[0];
//Проделываем ту же операцию, что и в предыдущей строке, но только уже с высотой.
            $ih = $size[1];
//Ширину фотографии делим на 150 т.к. на выходе мы хотим получить фото шириной в 150 пикселей. В результате
// получаем коэфициент соотношения ширины оригинала с будущей превьюшкой.
            $koe = $iw / 150;
//Делим высоту изображения на коэфициент, полученный в предыдущей строке, и округляем число до целого
// в большую сторону — в результате получаем высоту нового изображения.
            $new_h = ceil($ih / $koe);
//Создаём пустое изображение шириной в 150 пикселей и высотой, которую мы вычислили в предыдущей строке.
            $dst = ImageCreateTrueColor(150, "$new_h");
//Данная функция копирует прямоугольную часть изображения в другое изображение, плавно интерполируя пикселные значения таким образом, что, в частности, уменьшение размера изображения сохранит его чёткость и яркость.
            ImageCopyResampled($dst, $src, 0, 0, 0, 0, 150, $new_h, $iw, $ih);
//Сохраняем полученное изображение в формате JPG
            ImageJPEG($dst, $thumbPath, 100);
            imagedestroy($src);
            unlink($thumbTempPath);
            $uploaded = true;
//            header("Refresh:0");
//            echo $path.'<br>'.$thumbPath.'<br>'."\"INSERT INTO $table (path2large, path2thumb) VALUES ('$path','$thumbPath')\")".'<br>';
            // после загрузки и создания превьюшки заносим информаю о них в БД
            mysqli_query($dbLink, "INSERT INTO $table (path2large, path2thumb) VALUES ('$path','$thumbPath')");

        }
    }
}


include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $loader = new Twig_Loader_Filesystem('templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('gallery_admin.tmpl');

    $imageArray = sqlQueryAndRenderListImage($dbLink, $table); // выводим массив ассоциированных массивов

    echo $template->render(array(
        'images' => $imageArray
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}

// Создаем функцию рендринга галереи
function sqlQueryAndRenderListImage($dbLink, $table)
{
    // Делаем запрос к БД показать всю таблицу с параметрами фото
    $sqlQuery = mysqli_query($dbLink, "SELECT * FROM $table");
    $renderCode = [];
    while ($fromImageDB = mysqli_fetch_array($sqlQuery)) {
        // по каждой строке таблицы генерим блок с картинкой и ее свойствами
        $renderCode [] = $fromImageDB;
    }
    return $renderCode;
}

//function sqlQueryAndRenderListImage($dbLink, $table)
//{
//    // Делаем запрос к БД показать всю таблицу с параметрами фото
//    $sqlQuery = mysqli_query($dbLink, "SELECT * FROM $table");
//    $renderCode = [];
//    while ($fromImageDB = mysqli_fetch_array($sqlQuery)) {
//        // по каждой строке таблицы генерим блок с картинкой и ее свойствами
//        $renderCode []= '<div class="image"><a class="pictures" rel="gallery" href="' . $fromImageDB['path2large'] . '"><img src="' . $fromImageDB['path2thumb'] . '"><br></a><div class="actionButton"><i class="icon icon-eye">' . $fromImageDB['hits'] . '</i> <a class="icon-ccw icon" href="?action=ccw&id=' . $fromImageDB['id'] . '"></a><a class="icon-cw icon" href="?action=cw&id=' . $fromImageDB['id'] . '"></a><a class="icon-trash icon" href="?action=delete&id=' . $fromImageDB['id'] . '"></a></div></div>';
//    }
//    return $renderCode;
//}

// Создаем функцию для редактирования галереи
function actionForFiles($action, $id, $dbLink, $table)
{
    // по id картинки получаем ее путь к большому файлу и превьюшке
    $sqlQuery = mysqli_query($dbLink, "SELECT * FROM $table WHERE id=$id");
    $fromImageDB = mysqli_fetch_array($sqlQuery);
    $filenameLarge = $fromImageDB['path2large'];
    $filenameThumb = $fromImageDB['path2thumb'];

    // Задаем функцию поворота изображения
    function rotate($filePath, $angle)
    {

        $img = imagecreatefromjpeg($filePath);    // Картинка
        //Наклон картинки
        $imgRotated = imagerotate($img, $angle, 0);
        imagejpeg($imgRotated, $filePath, 100);  //  Новая картинка

    }

    // В зависимости от входных параметров выполняем ту или иную операцию над фото
    switch ($action) {
        case 'delete' : // операция удаления
            {
                unlink($filenameLarge);
                unlink($filenameThumb);
                mysqli_query($dbLink, "DELETE FROM $table WHERE id=$id");
            }
            break;
        case 'cw':  // операция поворота по часовй стрелке
            {
                $angle = 270;
                rotate($filenameLarge, $angle);
                rotate($filenameThumb, $angle);
            }
            break;
        case 'ccw': // операция поворота против часовй стрелки
            {
                $angle = 90;
                rotate($filenameLarge, $angle);
                rotate($filenameThumb, $angle);
            }
    }
}

// операции редактирования выполныем, если пришел параметр action
if ($action != 'none') {
    actionForFiles($action, $id, $dbLink, $table);
}


//echo sqlQueryAndRenderListImage($dbLink, $table); // Рендрим галерею

