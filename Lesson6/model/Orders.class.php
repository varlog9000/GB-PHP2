<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 16.04.2019
 * Time: 0:17
 */

class Orders
{
    public function __construct()
    {
//        App::debug($_SESSION);
    }


    public function createOrder()
    {

        return Sql::insert('INSERT INTO `orders` (`id_user`,`id_order_status`) VALUE (?,?)', [$_SESSION['user_id'], 1]);

    }

    public function getOrderList()
    {
        return Sql::getRows('SELECT * FROM `orders` WHERE `id_user`=? ORDER BY `id_order` DESC', [$_SESSION['user_id']]);
    }

    public function updateOrder($id_order, $owner_name, $phone, $address)
    {
        Sql::update('UPDATE `orders` SET `owner_name`=?, `phone`=?, `address`=? WHERE `id_order`=?', [$owner_name, $phone, $address, $id_order]);
    }
}