<?php
include_once "../config/config.php";
isset($_GET['more']) ? $_SESSION['limit'] += LIMIT_INCREMENT : $_SESSION['limit'] = LIMIT_INCREMENT;
include_once "../controllers/Product.php"; ?>
<? include "../templates/menu.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Catalog</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

</head>
<body>
<main>
    <div class='goodsTable' id="list">
        <?= $_SESSION['limit']; ?>

        <?php
        if (isset($goods))
            foreach ($goods as $good) : ?>
                <div class='goodsWrap'>
                    <?php if ($good['discount'] > 0) {
                        echo('<div class="sticker"><img class="stickerImg" src="/public/css/star.png"><span class="stickerTextFit">' . $good['discount'] . '%</span></div>');
                    } elseif ($good['stickerFit'] == 1) {
                        echo('<div class="sticker"><img class="stickerImg" src="/public/css/star.png"><span class="stickerTextFit">Fit!</span></div>');
                    } elseif ($good['stickerHit'] == 1) {
                        echo('<div class="sticker"><img class="stickerImg" src="/public/css/star.png"><span class="stickerTextHit">Hit!</span></div>');
                    }; ?>
                    <div class="wrapGoodImg">
                        <a href="item.php?photo=<?= $good['bigPhoto'] ?>&id=<?= $good['id'] ?>"><img class='goodImg'
                                                                                                     src="<?= $good['miniPhoto'] ?>"></a>
                    </div>
                    <div class="wrapGoodInfo">
                        <div class='goodsNameFull'><?= $good['nameFull']; ?></div>
                        <div class='goodsPrice'><?= $good['price'] ?><b>&#8381;</b></div>
                        <div class='goodsParam'><span><b>Состав: </b></span><?= $good['param'] ?></div>
                    </div>
                    <div class="btnWrap">
                        <input type='button' class='addToBasket btn' value='Дoбавить в корзину'
                               onclick="addToBasket(<?= $good[id] ?>)" data-id='<?= $good[id] ?>'>
                        <input type='button' class='deleteToBasket btn' value='Удалить из корзины'
                               onclick="deleteToBasket(<?= $good[id] ?>)" data-id='<?= $good[id] ?>'>
                    </div>
                </div>
            <?php endforeach; ?>
    </div>
    <button onclick="location.href ='index.php?&more'"><< Еще через PHP >></button>
    <button id="more"><< Еще через AJAX >></button>
    <footer>
        <? include "../templates/footer.php"; ?>

    </footer>
    <script src='../js/my.js' defer></script>
    <script src="../js/script.js"></script>
</main>
</body>
</html>