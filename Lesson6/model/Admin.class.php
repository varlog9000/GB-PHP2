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
 INNER JOIN `users` ON `orders`.`id_user`=`users`.`id_user`', []);
    }

    public function getDropDownList($tableName, $idCol, $nameCol)
    {
        return Sql::getRows('SELECT ?, ? FROM ?', [$idCol, $nameCol, $tableName]);
    }
}