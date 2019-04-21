<?php
/**
 * Created by PhpStorm.
 * User: Yana
 * Date: 20.04.2019
 * Time: 22:37
 */

class Admin
{
    public function getAllOrderList()
    {
        return Sql::getRows('SELECT 
`orders`.`id_user` as `user_id`,
`orders`.`amount` as `amount`,
`orders`.`datetime_create` as `datetime_create`,
`orders`.`owner_name` as `owner_name`,
`orders`.`phone` as `phone`,
`orders`.`address` as `address`,
`orders`.`id_order_status` as `id_order_status`,
`order_status`.`order_status_name` as `order_status_name`,
`users`.`user_name` as `user_name`,
`orders`.`id_order` as `id_order`
 FROM `orders` INNER JOIN `order_status` ON `order_status`.`id_order_status`=`orders`.`id_order_status`
 INNER JOIN `users` ON `orders`.`id_user`=`users`.`id_user` ORDER BY `datetime_create` DESC', []);
    }

    public function getOrder($id)
    {
        return Sql::getRow('SELECT 
`orders`.`id_user` as `user_id`,
`orders`.`amount` as `amount`,
`orders`.`datetime_create` as `datetime_create`,
`orders`.`owner_name` as `owner_name`,
`orders`.`phone` as `phone`,
`orders`.`address` as `address`,
`orders`.`id_order_status` as `id_order_status`,
`order_status`.`order_status_name` as `order_status_name`,
`users`.`user_name` as `user_name`,
`orders`.`id_order` as `id_order`
 FROM `orders` INNER JOIN `order_status` ON `order_status`.`id_order_status`=`orders`.`id_order_status`
 INNER JOIN `users` ON `orders`.`id_user`=`users`.`id_user` WHERE `orders`.`id_order`=?', [$id]);
    }

    public function getDropDownList($tableName, $idCol = null, $nameCol = null)
    {

        return Sql::getRows("SELECT $idCol as id ,$nameCol as name FROM $tableName ORDER BY `sort`", []);
    }

    public function getOrderGoods($id)
    {
        return Sql::getRows('SELECT * FROM `basket` INNER JOIN `orders` ON `orders`.`id_order`= `basket`.`id_order` INNER JOIN `goods` ON `goods`.`id_good`=`basket`.`id_good` WHERE `orders`.`id_order`=?', [$id]);
    }

    public function updateOrder($id_order, $owner_name, $phone, $address, $idOrderStatus)
    {
        return Sql::update('UPDATE `orders` SET `owner_name`=?, `phone`=?, `address`=?, `id_order_status`=? WHERE `id_order`=?', [$owner_name, $phone, $address, $idOrderStatus, $id_order]);
    }

}