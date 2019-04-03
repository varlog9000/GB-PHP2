<?php include_once "../controllers/Basket.php";

$countGoodsOrder = array(countGoodsOrder($connect));
$sumGoodsOrder = array(sumGoodsOrder($connect));
$countOneGoodsOrder = array(countOneGoodsOrder($connect, $id));
$countOneGoodsOrder = array(sumOneGoodsOrder($connect, $id));

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
        integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
<link rel="stylesheet" href="packages/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link rel="stylesheet" href="packages/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=El+Messiri" rel="stylesheet">
<link rel="stylesheet" href="/public/css/style.css">



<header class="header">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-lightNone">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/public/index.php">Главная <span class="sr-only">(current)</span></a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" href="  /public/guestbook.php">Отзывы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="  /public/promo.php">Акции</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="  /public/contact.php">Контакты</a>
                </li>
                <?php
                if (isset($_SESSION[login]) && isset($_SESSION[pass])) {
                    echo "<li class='nav-item'><a class='nav-link' href='  /public/login.php?action=profile'>Кабинет</a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='  /public/login.php?action=logout'>Выйти ($_SESSION[login])</a></li>";

                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='  /public/login.php'><u>Войти</u></a></li>";
                    echo "<li class='nav-item'><a class='nav-link' href='  /public/reg.php'><u>Регистрация</u></a></li>";
                }
                if (isset($_SESSION[login]) && isset($_SESSION[pass]) && $_SESSION[login] == 'admin') {
                    ?>
                    <li class='nav-item'><a class='nav-link' href='  /admin/admin.php'>Админка</a></li>
                    <li class='nav-item'><a class='nav-link' href='  /admin/manager.php'>Управление заказами</a></li>
                <? } ?>
            </ul>
			
        </div>
		<!-- Button trigger modal -->
        <button class="btn btn-outline-success btn-primary basketInfoOut" type="button" onclick='renderBasketModal()' data-toggle="modal" data-target="#bascketModal">
            <?php
			if ($countGoodsOrder[0]) {			
			echo ('<strong>Корзина</strong>' . '<br>' . '<strong>' . $countGoodsOrder[0].'</strong>');
			} else {
				echo ('<strong>Корзина</strong>'.'<br>'.'<strong>товаров нет(</strong>');
			};		
			?>
        </button>
    </nav>
	<!-- Modal -->
        <div class="modal fade" id="bascketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">КОРЗИНА</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Продолжить покупки</button>
                        <a href="  /public/order.php?id=<?= $good['id'] ?>"><button type="button" class="btn btn-primary">Оформить заказ</button></a>
                    </div>
                </div>
            </div>
        </div>
</header>


