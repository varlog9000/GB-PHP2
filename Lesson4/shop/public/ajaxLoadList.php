<?php include_once "../config/config.php";
include_once "../models/Model.php";

if (isset($_GET['more'])) {

    $goods = getAllLimitOffset($connect, $table, $orderby = 'id');

    $_SESSION['limit'] += LIMIT_INCREMENT;


    if (isset($_GET['more'])) {

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
        <?php endforeach;
    }
} ?>