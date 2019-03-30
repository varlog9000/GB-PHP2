

        <?php
        include_once("configuration.php");

        function sqlQueryAndRenderListImage($dbLink, $table) {
            // Читаем всю таблицу в БД отсортированную по просмотрам по-убыванию и id по-возрастанию
            $sqlQuery = mysqli_query($dbLink, "SELECT * FROM $table ORDER BY hits DESC, id ASC ");
            $renderCode = '';
            // Рендрим код вывода картинок
            while ($fromImageDB = mysqli_fetch_array($sqlQuery)) {
                $renderCode .= '<div class="image"><a class="pictures" rel="gallery" href="viewimage.php?id=' . $fromImageDB['id'] . '"><img src="' . $fromImageDB['path2thumb'] . '"><br></a><div class="hits"><i class="icon icon-eye">' . $fromImageDB['hits'] . '</i> </div></div>';
            }
            return $renderCode;
        }

        echo sqlQueryAndRenderListImage($dbLink, $table); ?>


