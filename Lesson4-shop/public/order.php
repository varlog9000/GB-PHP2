<?php include_once "../controllers/Admin.php"; ?>
<? include "../templates/menu.php"; ?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Оформление заказа</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/my_shop/public/css/styles.css" type="text/css" media="all">
</head>
<body>
<main>

<div class="orderBody">
 <div class="order">
        <div><h1>Ваш заказ</h1></div>
        <div class="orderTable">
		<script>
$(document).ready(function() {
	dbCreateOrder();
	renderOrder();
});
</script>
		</div>
    </div>
    <div class="formClientInfo">
	<form class="formOrder" id="formOrder" action="/my_shop/public/orderEnd.php"  method="POST">
				<label for="delivery" class="">Способ доставки</label>
				<input type="radio" name="delivery" value="1" onchange="deliveryCheck(1)">Самовывоз</option>
				<input type="radio" name="delivery" value="0" onchange="deliveryCheck(0)">Доставка</option>
				<label for="inputName" class="">Имя</label>
                <input type="text" name="name" id="inputName" placeholder="Введите имя">
				<label for="inputPhone" class="">Телефон</label>
                <div class="inputGroup"><input type="text" name="phone" class="rowGoods nameFull" placeholder="Введите номер телефона"></div>
				<label for="inputDiscountCard" class="">Дисконтная карта</label>
                <input type="text" name="discountCard" id="inputDiscountCard" class="" placeholder="Номер дисконтной карты">
				<label for="inputPersons" class="">Количество персон</label>
                <input type="text" name="persons" id="inputPersons" placeholder="Введите Количество персон">
				<label for="inputtypepay" class="">Способ оплаты</label>
				<select class="form-control input-sm" name="pay" id="inputtypepay">
														<option value="0">Наличные</option>
														<option value="1">Кредитная карта</option>
													</select>
				<label for="inputTime" class="">Заказ на время</label>
                <input type="text" name="desiredTime" id="inputTime" placeholder="Введите желаемое время исполнения заказа">
				<label for="inputMoney" class="">Сдача</label>
                <input type="text" name="money" id="inputMoney" placeholder="С какой купюры приготовить сдачу">
				<label for="inputAddress" class="">Адрес</label>
                <textarea type="text" name="address" id="inputAddress" placeholder="Адрес доставки"></textarea>
				<label for="inputComment" class="">Комментарий</label>
                <textarea type="text" name="comment" id="inputComment" placeholder="Комментарий к заказу"></textarea>
				<input type="hidden"  name="totalCoast" value="123456!">
				<input type="button" class="btn btn-primary" onclick="sendOrder()" value="Заказать!">
               </form>
	</div>
	</div>
    <footer>
        <? include "../templates/footer.php"; ?>
    </footer>

<script src='../js/my.js'></script>
</main>
</body>
</html>