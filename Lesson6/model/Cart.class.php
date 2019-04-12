<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 12.04.2019
 * Time: 23:35
 */

class Cart
{
    public $good;
    public $varExchange = [];


    // Данный механизм позволяет для авторизованных пользователей хнатить корзину в БД, а для неавторизованных в сессии.
    // При авторизации, если корзина была заполнена, то она перебрасывается в БД

    public function __construct()
    {
        $this->good = new Goods();

        if (!isset($_SESSION['cart']) && !isset($_SESSION['user_id'])) {
            $_SESSION['cart'] = [];
        }
    }

// Добавляем товар в корзину. Если товар уже есть в корзине - увеличиваем счетчик количества
    public function addGoodToCart($id)
    {
        $this->varExchange = $this->good->getGood($id);

        if (isset($_SESSION['user_id'])) {
            $count = Sql::getRow('SELECT * FROM `basket` WHERE `id_good`=?', [$id])['count'];
            if (empty($count)) {
                return Sql::insert('INSERT INTO `basket` (`id_user`,`id_good`,`price`) VALUE (?,?,?)', [$_SESSION['user_id'], $id, $this->varExchange['price']]);
            } else {
                return Sql::update('UPDATE `basket` SET `count`=?', [++$count]);
            }

        } else {
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i]['id_good'] == $id) {
                    $_SESSION['cart'][$i]['count']++;
                    return true;
                }
            }
            $_SESSION['cart'] = ['id_good' => $id, 'price' => $this->varExchange['price'], 'count' => 1];
            return true;
        }
    }


    // Удаляем выбранный товар из корзины
    public function deleteGoodFromCart($id)
    {
//        $this->varExchange = $this->good->getGood($id);
        if (isset($_SESSION['user_id'])) {
            return Sql::delete('DELETE FROM `basket` WHERE `id_user`=? AND `id_goods`=?', [$_SESSION['user_id'], $id]);
        } else {
            foreach ($_SESSION['cart'] as $good) {
                if ($_SESSION['cart'][$good]['id_good'] == $id) {
                    unset($_SESSION['cart'][$good]);
                    return true;
                }
            }
        }
    }

    // Запрос всего списка товаров в корзине
    public function getGoodsListFromCart()
    {
        if (isset($_SESSION['user_id'])) {
            return Sql::getRows('SELECT * FROM `basket` WHERE `id_user`=? AND `is_in_order`=0', [$_SESSION['user_id']]);
        } else {
            return $_SESSION['cart'];
        }
    }
    // Переносим все данные корзины из сессии в БД
    public function transferGoodsFromSessionToDb()
    {
        foreach ($_SESSION['cart'] as $good) {
            Sql::insert('INSERT INTO `basket` (`id_user`,`id_good`,`price`,`count`) VALUE (?,?,?,?)', [$_SESSION['user_id'], $good['id_good'], $good['price'], $good['count']]);
        }
        return true;
    }

    // Запрос обновленной информации для отображения корзины вверху страницы.
    public function getParamForCardBlock()
    {
        $count = 0;
        $amount = 0;

        foreach ($this->getGoodsListFromCart() as $good) {
            $amount += $good['price'] * $good['count'];
            $count += $good['count'];
        }
        return ['count' => $count, 'amount' => $amount];
    }
}