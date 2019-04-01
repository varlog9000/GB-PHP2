<?php include_once "../controllers/User.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Регистрация на сайте</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all">
</head>
<body>
<div id="container">
    <? include "../templates/header.php"; ?>
    <div class="leftblock">
        <? include "../templates/menu.php"; ?>
    </div>
    <div class="content">
        <h1>Регистрация на сайте</h1>
        <hr>
        <?
        if (isset($_SESSION[login]) && isset($_SESSION[pass])) {
            echo "Вы уже вошли";
        } else {
            echo $message ? $message : ""; ?>
            <form method="post">
                <p>Имя: <input type="text" name="name" maxlength="30" placeholder="Введите Имя" autofocus required></p>
                <p>Логин: <input type="text" name="login" maxlength="30" placeholder="Введите Логин" required></p>
                <p>Email: <input type="email" name="email" maxlength="30" placeholder="Введите Email" required></p>
                <p>Пароль: <input type="password" minlength="2" name="pass" placeholder="Введите Пароль" required></p>
                <input type="submit" name="submit" value="Зарегистрироваться">
            </form>
        <? } ?>
    </div>
    <footer>
        <? include "../templates/footer.php"; ?>
    </footer>
</div>
<script src='../js/my.js' defer></script>;
</body>
</html>