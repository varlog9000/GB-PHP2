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
        $varExchange = [];
        $varExchange = $this->good->getGood($id)[0];
        App::debug($varExchange);
        if (isset($_SESSION['user_id'])) {
            $count = Sql::getRow('SELECT * FROM `basket` WHERE `id_good`=?', [$id])['count'];
            if (empty($count)) {
                return Sql::insert('INSERT INTO `basket` (`id_user`,`id_good`,`price`) VALUE (?,?,?)', [$_SESSION['user_id'], $id, $varExchange['price']]);
            } else {
                return Sql::update('UPDATE `basket` SET `count`=? WHERE `id_good`=?', [++$count, $id]);
            }

        } else {
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if ($_SESSION['cart'][$i]['id_good'] == $id) {
                    $_SESSION['cart'][$i]['count']++;
                    return true;
                }
            }
            array_push($_SESSION['cart'], ['id_good' => $id, 'name' => $varExchange['name'], 'price' => $varExchange['price'], 'count' => 1]);
            return true;
        }
    }


    // Удаляем выбранный товар из корзины
    public function deleteGoodFromCart($id)
    {
//        $this->varExchange = $this->good->getGood($id);
        if (isset($_SESSION['user_id'])) {
            return Sql::delete('DELETE FROM `basket` WHERE `id_user`=? AND `id_good`=?', [$_SESSION['user_id'], $id]);
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

    public function transferGoodsFromSessionToDb()
    {
        foreach ($_SESSION['cart'] as $good) {
            Sql::insert('INSERT INTO `basket` (`id_user`,`id_good`,`price`,`count`) VALUE (?,?,?,?)', [$_SESSION['user_id'], $good['id_good'], $good['price'], $good['count']]);
        }
        return true;
    }

    // Переносим все данные корзины из сессии в БД

    public function getParamForCartBlock()
    {
        $count = 0;
        $amount = 0;

        foreach ($this->getGoodsListFromCart() as $good) {
            $amount += $good['price'] * $good['count'];
            $count += $good['count'];
        }
        $return_array = ['count' => $count, 'amount' => $amount];
        if (!isset($_GET['asAjax'])) {
            return $return_array;
        } else {
            return json_encode($return_array);
        }

    }

    // Запрос обновленной информации для отображения корзины вверху страницы.

    public function getGoodsListFromCart()
    {
        if (isset($_SESSION['user_id'])) {
//            return Sql::getRows('SELECT * FROM `basket` WHERE `id_user`=? AND `is_in_order`=0', [$_SESSION['user_id']]);
            return Sql::getRows('SELECT `basket`.`id_basket`, `basket`.`id_user`,`basket`.`id_good`,`basket`.`price`,`basket`.`count`,`basket`.`is_in_order`,`basket`.`id_order`,`goods`.`name`, `goods`.`photo` FROM `basket` INNER JOIN `goods` ON `basket`.`id_good`=`goods`.`id_good` WHERE `id_user`=? AND `is_in_order`=0', [$_SESSION['user_id']]);
        } else {
            return $_SESSION['cart'];
        }
    }
}