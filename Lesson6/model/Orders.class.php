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
        return Sql::getRows('SELECT * FROM `orders` INNER JOIN `order_status` ON `orders`.`id_order_status`= `order_status`.`id_order_status`  WHERE `id_user`=? ORDER BY `id_order` DESC', [$_SESSION['user_id']]);

    }

    public function updateOrder($id_order, $owner_name, $phone, $address, $amount)
    {
        Sql::update('UPDATE `orders` SET `owner_name`=?, `phone`=?, `address`=?, `amount`=? WHERE `id_order`=?', [$owner_name, $phone, $address, $amount, $id_order]);
    }

    public function getOrder($id){
        return Sql::getRows('SELECT * FROM `basket` INNER JOIN `orders` ON `orders`.`id_order`= `basket`.`id_order` INNER JOIN `goods` ON `goods`.`id_good`=`basket`.`id_good` WHERE `orders`.`id_user`=? AND `orders`.`id_order`=?', [$_SESSION['user_id'],$id]);
    }
}