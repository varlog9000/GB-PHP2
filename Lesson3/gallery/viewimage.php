<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>View image</title>
</head>
<body class="body-view">
<div class="container-media">
    <div class="photo">

        <?php
        include_once("configuration.php");
        $id = (isset($_GET['id'])) ? $_GET['id'] : 'none';
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

            // начинаем рендрить код
            $renderCode = '';
            $renderCode .= '<img src="' . $fromImageDB['path2large'] . '" class="img" >'; // подгружаем картинку
            $renderCode .= '<div class="container-button"><div class="button button__left">'; // контейнер с кнопкой выхода и количеством просмотров
            $renderCode .= '<i class="icon icon-eye">' . $hits . '</i></div>'; // поле с количеством просмотров
            $renderCode .= '<div class="button button__right"><a href="index.php"> <i class="icon  icon-cancel-circled "></i> </a> </div> </div>'; // кнопка выхода в галерею
            $renderCode .= '<div class="container-prev-next">'; // контейнер со ссылками на следующую и предыдущую картинку
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





            $renderCode .= '<a class="prev" href="viewimage.php?id=' . $prevLink . '"><i class="icon icon-left-open-big"></i></a>';
            $renderCode .= '<a class="next" href="viewimage.php?id=' . $nextLink . '"><i class="icon icon-right-open-big"></i></a>';

            $renderCode .= '</div>';
            $renderCode .= '</div>';

            ++$hits;
            //Загружаем количество хитов из таблицы и делаем инкремент
            mysqli_query($dbLink, "UPDATE $table SET hits='$hits' WHERE id='$id'"); // обновляем информацию в БД о просмотрах

            return $renderCode; // выводим результат
        }


        echo sqlQueryViewPhotoAndIncrementHits($dbLink, $table, $id); // вызываем функцию генерации кода?>


    </div>

</div>

</body>
</html>

