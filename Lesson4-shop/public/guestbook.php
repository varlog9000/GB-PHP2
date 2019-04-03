<? include_once "../controllers/Comment.php"; ?>
 <? include "../templates/menu.php"; ?>

 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Гостевая книга - Интернет-магазин ноутбуков</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all">
</head>
<body>

<div id="container">
    
    <div class="leftblock">
       
    </div>
    <div class="content">
        <h1>Гостевая книга</h1>
        <?php
        if ($comments) {
            foreach ($comments as $comment) {
                echo "<div style='border: 1px solid #ccc; margin: 10px; padding: 5px;;'>ФИО: {$comment[fio]}<br>Email: {$comment[email]}<br>Текст: {$comment[text]}<br><i>Дата: {$comment[date]}</i></div>";
            }
        }
        ?>
        <hr>
        <form method="post">
            <p><strong>Оставить отзыв о сайте:</strong></p>
            <p>Введите ФИО: <input type="text" name="fio" maxlength="30" required></p>
            <p>Введите Email: <input type="email" name="email" maxlength="20" required></p>
            <p>Введите Текст: <textarea name="text" rows="10" required></textarea></p>
            <p><input type="submit" name="submit"></p>
        </form>
    </div>
    <footer>
        <? include "../templates/footer.php"; ?>
    </footer>
</div>
<script src='../js/my.js' defer></script>;
</body>
</html>