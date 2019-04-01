<?php include_once "../controllers/Product.php"; ?>
<? include "../templates/menu.php"; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Фотогаллерея</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all">
</head>
<body>
<main>
<div class="promoHeader">Акции</div>
<div id="container">
    <div class="content">
        <div class="promoWrap">
		<i class="fas fa-truck fa-7x"></i>
		<div class="promoText">
		<span>Самовывоз</span><br>
		<span>Скидка 10% если забираете заказ самостоятельно в филиале компании</span>
		</div>
		</div>
		<div class="promoWrap">
		<i class="far fa-clock fa-9x"></i>
		<div class="promoText">
		<span>Акция "Счастливый час!</span><br>
		<span>Скидка 7% при заказе от 0ч 00м до 8ч 00м</span>
		</div>
		</div>
		<div class="promoWrap">
		<i class="far fa-smile fa-9x"></i>
		<div class="promoText">
		<span>Скидка дня!</span><br>
		<span>Скидки до 10% на отдельные роллы и суши. Следите за акциями компании. Новые скидки каждый день!</span>
		</div>
		</div>
        
    </div>
    <footer>
        <? include "../templates/footer.php"; ?>
    </footer>
</div>
</main>
<script src='../js/my.js' defer></script>;
</body>
</html>
